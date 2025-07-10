<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PostModel;
use CodeIgniter\HTTP\ResponseInterface;
use Cocur\Slugify\Slugify;

class Posts extends BaseController
{
    protected $postModel;
    protected $slugify;

    public function __construct()
    {
        $this->postModel = new PostModel();
        $this->slugify = new Slugify([
            'regexp' => '/([^A-Za-z0-9\s\p{Hangul}])/u'
        ]);
    }

    /**
     * 고유한 슬러그 생성
     */
    private function generateUniqueSlug($title, $excludeId = null)
    {
        $baseSlug = $this->slugify->slugify($title);
        if (empty($baseSlug)) {
            $baseSlug = 'post';
        }
        $slug = $baseSlug;
        $counter = 1;
        
        while (true) {
            $query = $this->postModel->where('slug', $slug);
            if ($excludeId) {
                $query->where('id !=', $excludeId);
            }
            
            if (!$query->first()) {
                break;
            }
            
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }
        
        return $slug;
    }

    public function index()
    {
        $data = [
            'posts' => $this->postModel->findAll(),
        ];

        return view('posts/index', $data);
    }

    public function show($slug = null)
    {
        $post = $this->postModel->where('slug', $slug)->first();

        if (! $post) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('게시물을 찾을 수 없습니다: ' . $slug);
        }

        $data = [
            'post' => $post,
        ];

        return view('posts/show', $data);
    }

    public function new()
    {
        return view('posts/new');
    }

    public function create()
    {
        $rules = $this->postModel->getValidationRules();
        $messages = $this->postModel->getValidationMessages();

        if (! $this->validate($rules, $messages)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        try {
            $title = $this->request->getPost('title');
            $inputSlug = $this->request->getPost('slug');
            
            // 슬러그가 입력되지 않았으면 제목으로부터 자동 생성
            $slugSource = !empty($inputSlug) ? $inputSlug : $title;
            $slug = $this->generateUniqueSlug($slugSource);

            $data = [
                'title' => $title,
                'slug'  => $slug,
                'body'  => $this->request->getPost('body'),
            ];

            $thumbnail = $this->request->getFile('thumbnail');

            if ($thumbnail->isValid() && ! $thumbnail->hasMoved()) {
                $newName = $thumbnail->getRandomName();
                $thumbnail->move(WRITEPATH . '../public/uploads', $newName);
                $data['thumbnail'] = $newName;
            }

            if ($this->postModel->save($data) === false) {
                return redirect()->back()->withInput()->with('errors', $this->postModel->errors());
            }

            return redirect()->to('/posts')->with('message', '게시물이 성공적으로 생성되었습니다.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', '게시물 생성 중 오류가 발생했습니다: ' . $e->getMessage());
        }
    }

    public function edit($slug = null)
    {
        $post = $this->postModel->where('slug', $slug)->first();

        if (! $post) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('게시물을 찾을 수 없습니다: ' . $slug);
        }

        $data = [
            'post' => $post,
        ];

        return view('posts/edit', $data);
    }

    public function update($slug = null)
    {
        $post = $this->postModel->where('slug', $slug)->first();

        if (! $post) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('게시물을 찾을 수 없습니다: ' . $slug);
        }

        $rules = $this->postModel->getValidationRules();
        $messages = $this->postModel->getValidationMessages();

        if (! $this->validate($rules, $messages)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        try {
            $title = $this->request->getPost('title');
            $inputSlug = $this->request->getPost('slug');
            
            // 슬러그가 입력되지 않았으면 제목으로부터 자동 생성
            $slugSource = !empty($inputSlug) ? $inputSlug : $title;
            $newSlug = $this->generateUniqueSlug($slugSource, $post['id']);

            $data = [
                'title' => $title,
                'slug'  => $newSlug,
                'body'  => $this->request->getPost('body'),
            ];

            $thumbnail = $this->request->getFile('thumbnail');

            if ($thumbnail->isValid() && ! $thumbnail->hasMoved()) {
                // 기존 파일 삭제
                if (!empty($post['thumbnail']) && file_exists(WRITEPATH . '../public/uploads/' . $post['thumbnail'])) {
                    unlink(WRITEPATH . '../public/uploads/' . $post['thumbnail']);
                }

                $newName = $thumbnail->getRandomName();
                $thumbnail->move(WRITEPATH . '../public/uploads', $newName);
                $data['thumbnail'] = $newName;
            }

            if ($this->postModel->update($post['id'], $data) === false) {
                return redirect()->back()->withInput()->with('errors', $this->postModel->errors());
            }

            return redirect()->to('/posts/' . $newSlug)->with('message', '게시물이 성공적으로 업데이트되었습니다.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', '게시물 업데이트 중 오류가 발생했습니다: ' . $e->getMessage());
        }
    }

    public function delete($slug = null)
    {
        $post = $this->postModel->where('slug', $slug)->first();

        if (! $post) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('게시물을 찾을 수 없습니다: ' . $slug);
        }

        try {
            $this->postModel->delete($post['id']);
            return redirect()->to('/posts')->with('message', '게시물이 성공적으로 삭제되었습니다.');
        } catch (\Exception $e) {
            return redirect()->to('/posts')->with('error', '게시물 삭제 중 오류가 발생했습니다: ' . $e->getMessage());
        }
    }

}

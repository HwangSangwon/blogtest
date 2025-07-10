<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PostModel;
use CodeIgniter\HTTP\ResponseInterface;

class Admin extends BaseController
{
    public function index()
    {
        return view('admin/index');
    }

    public function settings()
    {
        $currentLayout = config('App')->postListLayout ?? 'single';

        $data = [
            'currentLayout' => $currentLayout,
            'layouts'       => [
                'single' => '게시물 1개씩 리스트로 보기',
                'grid'   => '3개씩 이미지와 리스트로 보기',
            ],
        ];

        return view('admin/settings', $data);
    }

    public function saveSettings()
    {
        $newLayout = $this->request->getPost('post_list_layout');

        $appConfigPath = APPPATH . 'Config/App.php';
        $appConfigContent = file_get_contents($appConfigPath);

        // Update the postListLayout property
        $appConfigContent = preg_replace(
            '/public string \$postListLayout = \'.*?\';/',
            'public string $postListLayout = \'' . $newLayout . '\';',
            $appConfigContent
        );

        file_put_contents($appConfigPath, $appConfigContent);

        return redirect()->to('/admin/settings')->with('message', '게시물 목록 레이아웃 설정이 성공적으로 저장되었습니다.');
    }

    public function posts()
    {
        $postModel = new PostModel();
        $data['posts'] = $postModel->findAll();

        return view('admin/posts', $data);
    }

    public function deletePost($id)
    {
        $postModel = new PostModel();
        $postModel->delete($id);

        return redirect()->to('/admin/posts')->with('message', '게시물이 성공적으로 삭제되었습니다.');
    }
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class PostModel extends Model
{
    protected $table            = 'posts';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['title', 'slug', 'body', 'thumbnail'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules = [
        'title' => 'required|min_length[3]|max_length[255]|is_unique[posts.title]',
        'slug'  => 'permit_empty|max_length[255]',
        'body'  => 'required',
    ];
    protected $validationMessages = [
        'title' => [
            'required'   => '제목은 필수입니다.',
            'min_length' => '제목은 최소 3자 이상이어야 합니다.',
            'max_length' => '제목은 최대 255자까지 가능합니다.',
        ],
        'slug' => [
            'max_length' => '슬러그는 최대 255자까지 가능합니다.',
        ],
        'body'  => [
            'required' => '내용은 필수입니다.',
        ],
    ];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class User extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = false; 
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id', 'username', 'email', 'password', 'full_name','phone', 'level',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    // protected $validationRules    = [
    //     'username' => 'required|min_length[3]|is_unique[users.username]',
    //     'email' => 'required|valid_email|is_unique[users.email]',
    //     'password' => 'required|min_length[3]',
    //     'full_name' => 'required|min_length[3]',
    // ];
    protected $validationMessages = [
        'username' => [
            'required'    => 'Username is required',
            'is_unique'   => 'Username already exists'
        ],
        'email' => [
            'required'    => 'Email is required',
            'is_unique'   => 'Email already exists'
        ]
    ];
    protected $skipValidation     = false;

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

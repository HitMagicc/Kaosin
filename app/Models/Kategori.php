<?php

namespace App\Models;

use CodeIgniter\Model;

class Kategori extends Model
{
    protected $table = 'kategori';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id', 'Sex', 'Name'];
    protected $useAutoIncrement = false;

    protected $useTimestamps = false;
}

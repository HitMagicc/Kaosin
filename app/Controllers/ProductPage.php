<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class ProductPage extends BaseController
{
    public function index()
    {
        return view('product-details');
    }
}

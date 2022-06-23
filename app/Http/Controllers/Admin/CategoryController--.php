<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyProductRequest;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Http\Request;
use App\Product;
use App\CustomerData;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{ 
	public function index() {
		echo 'test';
	}
}
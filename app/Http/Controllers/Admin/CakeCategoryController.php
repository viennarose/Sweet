<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CakeCategoryController extends Controller
{
    public function index()
    {
        return view('admin.cakecategory.index');
    }
}

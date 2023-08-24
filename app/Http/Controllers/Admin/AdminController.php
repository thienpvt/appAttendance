<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class AdminController extends Controller
{
    public function __construct()
    {
        View::share('title','Admin');
    }
    public function index()
    {
        return view('admin.index');
    }
}

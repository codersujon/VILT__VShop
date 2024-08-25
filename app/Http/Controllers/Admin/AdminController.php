<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminController extends Controller
{
    /**
     * Index
     */
    public function index(){
        return Inertia::render('Admin/Dashboard');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Foundation\Application;
use App\Models\Product;

class UserController extends Controller
{
    /**
     * Index
     */
    public function index(){
        $products = Product::latest()->with('brand', 'category', 'product_images')->limit(8)->get();
        return Inertia::render('User/Index', [
            'products' => $products,
            'canLogin' => app('router')->has('login'),
            'canRegister' => app('router')->has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
        ]);
    }
}

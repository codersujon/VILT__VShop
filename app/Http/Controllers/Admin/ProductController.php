<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ProductImage;

class ProductController extends Controller
{
    /**
     * Index
     */
    public function index(){
        $products = Product::get();
        $brands = Brand::get();
        $categories = Category::get();
        return Inertia::render('Admin/Product/Index', [
            'products'=> $products, 
            'brands'=> $brands, 
            'categories'=> $categories 
        ]);
    }

    /**
     * Store
     */
    public function store(Request $request){

        $product = new Product();
        $product->title = $request->title;
        $product->quantity = $request->quantity;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->brand_id = $request->brand_id;
        $product->category_id = $request->category_id;
        $product->save();

        // if check product has images upload
        if($request->hasFile('product_images'))
        {
            $productImages = $request->file('product_images');
            foreach($productImages as $image){
                // Generate a unique name for the image using timestamp and random string
                $uniqueName = time(). '-' . Str::random(10) . '.' . $image->getClientOriginalExtension();
                $image->move('product_images', $uniqueName);

                // Create a new product image record with the product_id and unique name
                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => 'product_images/' . $uniqueName
                ]);
            }
        }    
        return redirect()->route('admin.products.index')->with("success", "Product Created Successfully!");
    }
}

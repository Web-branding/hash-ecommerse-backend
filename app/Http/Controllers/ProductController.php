<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Imageproduct;
use App\Models\Category;
use App\Models\Subcategory;
use App\Helpers\Helper;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::get()->all();
        return view('products.products', compact('products'));
    }
    public function add_fn()
    {
        $category = Category::get()->all();
        $subcategory = Subcategory::get()->all();
        return view('products.add_products', compact('category'), compact('subcategory'));
    }
    public function add(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'quantity' => 'required',
            'stock_status' => 'required',
            'description' => 'required',
            'category_name' => 'required',
            'subcategory_name' => 'required',
            'file' => 'required',
            'file.*' => 'required|image|mimes:jpg,png,jpeg,gif,svg',
            'video' => 'required|mimes:mp4',
        ]);

        $files = [];
        if($request->hasfile('file'))
        {
            foreach($request->file('file') as $file)
            {
                $name = $file->getClientOriginalName();
                $file->move(storage_path('app/public/images'), $name);  
                $files[] = $name;  
            }
        }

        $video=$request->video;
        $filename=$video->getClientOriginalName();
        $video->move(storage_path('app/public/videos'), $filename);  

        $pd_id = Helper::IDGenerator(new Product, 'pd_id', 4, 'ID');

        $product = new Product();
        $product->pd_id = $pd_id;
        $product->name = $request->name;
        $product->quantity = $request->quantity;
        $product->stock_status = $request->stock_status;
        $product->description = $request->description;
        $product->category_name = $request->category_name;
        $product->subcategory_name = $request->subcategory_name;
        $product->video = $filename;
        $product->save();

        foreach($files as $file)
        {
            $imgproduct = new Imageproduct();
            $imgproduct->pd_id = $pd_id;
            $imgproduct->name = $request->name;
            $imgproduct->file = $file;
            $imgproduct->save();
        }
        
        return redirect()->route('addproducts')->with('add', 'New product added successfully!');
    }
    public function edit($id)
    {
        $products = Product::find($id);
        $imgproducts = Imageproduct::where('pd_id', $products->pd_id)->get()->all();
        $category = Category::get()->all();
        $subcategory = Subcategory::get()->all();
        $products['products'] = $products;
        $products['imgproducts'] = $imgproducts;
        $products['cat'] = $category;
        $products['subcat'] = $subcategory;
        return view('products.edit_product', $products);
    }
    public function update($id, Request $request, Product $product, Imageproduct $imageproduct)
    {
        $validate = $request->validate([
            'name' => 'required',
            'quantity' => 'required',
            'stock_status' => 'required',
            'description' => 'required',
            'category_name' => 'required',
            'subcategory_name' => 'required',
        ]);
   
        $product->find($id)->update($request->all());
        $imageproduct->where('pd_id', $request->pd)->update(array('name' => $request->name));
        return redirect()->route('products')->with('update', 'Product updated successfully!');     
    }
    public function view($id, Request $request)
    {
        $product = Product::find($id);
        $imgproduct = Imageproduct::where('pd_id', $product->pd_id)->get()->all();
        return view('products.view_product', compact('product'), compact('imgproduct'));
    }
    public function destroy(Request $request, Product $product, Imageproduct $imageproduct) {
        $id = $request->delete_id;
        $product = Product::find($id);
        $product->find($id)->delete();
        $imageproduct->where('pd_id', $product->pd_id)->delete();
        return redirect()->route('products')->with('delete', 'Product deleted successfully.');
    }
}

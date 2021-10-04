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
        $products = Product::latest()->paginate(10);
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
            'price' => 'required',
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
                $name = time().'.'.$file->getClientOriginalName();
                $file->move(public_path('images/products'), $name);  
                $files[] = $name;  
            }
        }

        $video=$request->video;
        $filename=time().'.'.$video->getClientOriginalName();
        $video->move(public_path('videos/products'), $filename);  

        $product = new Product();
        $product->name = $request->name;
        $product->quantity = $request->quantity;
        $product->price = $request->price;
        $product->stock_status = $request->stock_status;
        $product->description = $request->description;
        $product->category_name = $request->category_name;
        if($request->subcategory_name == "---Select---")
        {
            $product->subcategory_name = "";
        }
        else
        {
            $product->subcategory_name = $request->subcategory_name;
        }
        $product->video = $filename;
        $product->save();

        foreach($files as $file)
        {
            $imgproduct = new Imageproduct();
            $imgproduct->pd_id = $product->id;
            $imgproduct->name = $request->name;
            $imgproduct->file = $file;
            $imgproduct->save();
        }
        
        return redirect()->route('addproducts')->with('add', 'New product added successfully!');
    }

    public function edit($id)
    {
        $products = Product::find($id);
        $imgproducts = Imageproduct::where('name', $products->name)->get()->all();
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
            'price' => 'required',
            'stock_status' => 'required',
            'description' => 'required',
            'category_name' => 'required',
            'subcategory_name' => 'required',
        ]);
   
        $product->find($id)->update($request->all());
        if($request->subcategory_name == "---Select---")
        {
            $product->find($id)->update(array('subcategory_name' => ""));
        }
        else
        {
            $product->find($id)->update(array('subcategory_name' => $request->subcategory_name));
        }
        $imageproduct->where('pd_id', $request->id)->update(array('name' => $request->name));
        return redirect()->route('products')->with('update', 'Product updated successfully!');     
    }

    public function view($id, Request $request)
    {
        $product = Product::find($id);
        $imgproduct = Imageproduct::where('name', $product->name)->get()->all();
        return view('products.view_product', compact('product'), compact('imgproduct'));
    }
    public function destroy(Request $request, Product $product, Imageproduct $imageproduct) {
        $id = $request->delete_id;
        $product = Product::find($id);
        $product->find($id)->delete();
        $imageproduct->where('name', $product->name)->delete();
        return redirect()->route('products')->with('delete', 'Product deleted successfully.');
    }

    public function products()
    {
        $products = Product::get()->all();
        $imgproducts = Imageproduct::get()->all();

        foreach($products as $product)
        {
            $img = Imageproduct::where('name',$product->name)->get()->all(); 
            $data = [
                'id' => $product->id,
                
            ];
        }
        $merge = array_merge($products, $img);

        

        return response()->json([
            'status_code' => 200,
            'data' => $products,
        ]);
    }
}

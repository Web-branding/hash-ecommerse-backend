<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;

class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::get()->all();
        return view('category.category', compact('category'));
    }
    public function add_fn()
    {
        return view('category.add_category');
    }
    public function add(Request $request)
    {
        $request->validate([
            'category_name' => 'required'
        ]);
        $category = new Category();
        $category->category_name = $request->category_name;
        $category->save();
        return redirect()->route('addcategory')->with('add', 'New category added successfully!');
    }
    public function edit($id) {
        $category = Category::find($id);
        return view('category.edit_category', compact('category'));
    }
    public function update($id, Request $request) {
        $validate = $request->validate([
            'category_name' => 'required'
        ]);
        Category::where('id', $id)->update(array('category_name' => $request->category_name));
        return redirect()->route('category')->with('update', 'Category updated successfully!');     
    }
    public function destroy(Request $request, Category $category, Subcategory $subcategory) {
        $id = $request->delete_id;
       
        $cat = Category::find($id);
        // echo $cat->category_name;
        $category->find($id)->delete();
        $subcategory->where('category_name', $cat->category_name)->delete();
        return redirect()->route('category')->with('delete', 'Category deleted successfully.');
    }
}

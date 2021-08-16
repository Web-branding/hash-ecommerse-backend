<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;

class SubcategoryController extends Controller
{
    public function index()
    {
        $category = Subcategory::get()->all();
        return view('subcategory.sub_category', compact('category'));
    }
    public function add_fn()
    {
        $category = Category::get()->all();
        return view('subcategory.add_subcategory', compact('category'));
    }
    public function add(Request $request)
    {
        $request->validate([
            'category_name' => 'required',
            'subcategory_name' => 'required'
        ]);
        $subcategory = new Subcategory();
        $subcategory->category_name = $request->category_name;
        $subcategory->subcategory_name = $request->subcategory_name;
        $subcategory->save();
        return redirect()->route('addsubcategory')->with('add', 'Sub-Category added successfully!');
    }
    public function edit($id) {
        $cat = Category::get()->all();
        $subcat = Subcategory::find($id);
        $category['cat'] = $cat;
        $category['subcat'] = $subcat;
        return view('subcategory.edit_subcategory', $category);
    }
    public function update($id, Request $request, Subcategory $subcategory) {
        $request->validate([
            'category_name' => 'required',
            'subcategory_name' => 'required'
        ]);
        $subcategory->find($id)->update($request->all());
        return redirect()->route('sub_category')->with('update', 'Sub-Category updated successfully!');     
    }
    public function destroy(Request $request, Subcategory $subcategory) {
        $id = $request->delete_id;
        $subcategory->find($id)->delete();
        return redirect()->route('sub_category')->with('delete', 'Sub-Category deleted successfully.');
    }
}

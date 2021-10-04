<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Order;
use App\Models\User;
use App\Models\Orderitems;
use App\Models\Shipping;
use App\Models\Transaction;
use Razorpay\Api\Api;
use Session;
use Redirect;

class CategoryController extends Controller
{
    public function index()
    {
        // $category = Category::get()->all();
        $category = Category::latest()->paginate(10);
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

    public function order()
    {
        $order = Order::latest()->paginate(10);
        return view('order.order', compact('order'));
    }

    public function details($id)
    {
        $order = Order::find($id);
        $orderitems = Orderitems::where('order_id', $order->order_id)->get()->all();
        $shipping = Shipping::where('order_id', $order->order_id)->get()->all();

        $order['order'] = $order;
        $order['orderitems'] = $orderitems;
        $order['shipping'] = $shipping;

        return view('order.detail', $order);
    }

    public function status($id, Request $request)
    {
        $delivered = $request->delivered;
        $canceled = $request->canceled;

        if($delivered) {
            Order::where('id', $id)->update(array('status' => 'Delivered'));
        }
        if($canceled) {
            Order::where('id', $id)->update(array('status' => 'Cancelled'));
        }
        return redirect()->route('order')->with('status', 'Order status updated successfully!');
    }

    public function transaction()
    {
        $transaction = Transaction::latest()->paginate(10);
        return view('transactions.transactions', compact('transaction'));
    }
}

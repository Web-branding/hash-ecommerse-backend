<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Imageproduct;
use App\Models\Product;

class ImageproductController extends Controller
{
    public function imgdestroy(Request $request, Imageproduct $imgproduct)
    {
        $file = $request->file;
        $values = str_replace (array('"'), '' , $file);

        $imgproduct->where('file', $file)->delete();
        return response()->json([
            'status' => 200,
            'people' => 'Image deleted successfully!',
        ]);
    }

    public function imgupload(Request $request)
    {
        $request->validate([
            'file' => 'required',
            'file.*' => 'required|image|mimes:jpg,png,jpeg,gif,svg',
        ]);

        $products = Product::where('pd_id', $request->pd_id)->get()->all();

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
        foreach($files as $file)
        {
            $imgproduct = new Imageproduct();
            $imgproduct->pd_id = $request->pd_id;
            $imgproduct->name = $products[0]->name;
            $imgproduct->file = $file;
            $imgproduct->save();
        }
       
        return response()->json([
            'status' => 200,
            'people' => 'Image added successfully!',
        ]);
    }

    public function videodestroy(Request $request, Product $product)
    {
        $video = $request->video;
        $product->where('video', $video)->update(array('video' => ''));

        return response()->json([
            'status' => 200,
            'people' => 'Video deleted successfully!',
        ]);
    }

    public function videoupload(Request $request, Product $product)
    {
        $request->validate([
            'video' => 'required|mimes:mp4',
        ]);

        $video=$request->video;
        $filename=$video->getClientOriginalName();
        $video->move(storage_path('app/public/videos'), $filename);  

        $product->where('pd_id', $request->addvideo_id)->update(array('video' => $filename));
        return response()->json([
            'status' => 200,
            'people' => 'Video added successfully!',
        ]);
    }
}

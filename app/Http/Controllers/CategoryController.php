<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    function index()
    {
        return view('pages.dashboard.category');
    }

    function create(Request $request)
    {

        $request->validate([
            'category_name' => 'unique:categories',
            'category_img' => 'image|max:2048',
        ], [
            'category_img.max' => ' Category Image must not be greater than 2 MB!',
        ]);

        $category = Category::create([
            'category_name' => $request->category_name
        ]);

        if ($request->hasFile('category_img')) {
            $img = $request->file('category_img');
            $file_name = $category->id . '.' . $img->getClientOriginalExtension();
            $preview_path = public_path('upload/category/' . $file_name);
            Image::make($img)->resize(200, 200)
            ->save($preview_path, 80);


            $category->update([
                'category_img' => $file_name,
            ]);
        }

        return response()->json();
    }

    function list()
    {
        return Category::all();
    }

    function delete(Request $request)
    {
        $present = Category::find($request->category_id);
        if ($present->category_img != null) {
            unlink(public_path('upload/category/' . $present->category_img));
        }
        $present->delete();
        return response()->json();
    }

    function update(Request $request)
    {
        $request->validate([
            'category_name' => 'unique:categories,category_name,' . $request->category_id . ',id',
            'category_img' => 'image|max:2048',
        ],  [
            'category_img.max' => 'Category Image must not be greater then 2mb',
        ]);

        $category_info = Category::find($request->category_id);

        if ($request->hasFile('category_img')) {
            if ($category_info->category_img != null) {
                unlink(public_path('upload/category/' . $category_info->category_img));
            }
            $img = $request->file('category_img');
            $file_name = $category_info->id . '.' . $img->getClientOriginalExtension();
            $preview_path = public_path('upload/category/' . $file_name);
            Image::make($img)->resize(200, 200)
            ->save($preview_path, 80);

            $category_info->update([
                'category_img' => $file_name,
            ]);
        }

        $category_info->update([
            'category_name' => $request->category_name,
        ]);

        return response()->json();
    }


}

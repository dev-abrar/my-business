<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductGallery;
use App\Models\Subcategory;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    function index()
    {
        return view('pages.dashboard.products');
    }

    function list()
    {
        $products =  Product::leftJoin('categories', 'products.category_id', '=', 'categories.id')
            ->select('products.*', 'categories.category_name as category_name')
            ->get();
        return response()->json($products);
    }


    function create(Request $request)
    {

        // Validate product
        $request->validate([
            'preview' => 'image|max:2024',
            'gallery' => 'array|max:6',
            'gallery.*' => 'image|max:2024',
        ], [
            'preview.max' => 'Preview Image must not be greater than 2 MB!',
            'gallery.max' => 'You can upload a maximum of 6 gallery images!',
            'gallery.*.max' => 'Each gallery Image must not be greater than 2 MB!',
        ]);


        // Generate random values for SKU and slug
        $random = random_int(1000, 9990);

        // Generate SKU and slug
        $sku = Str::upper(str_replace(' ', '_', substr($request->product_name, 0, 6))) . '_' . $random;

        // Create the product and get the created product model
        $product = Product::create([
            'product_name' => $request->product_name,
            'price' => $request->price,
            'discount' => $request->discount,
            'after_discount' => $request->price - ($request->price * $request->discount) / 100,
            'category_id' => $request->category_id,
            'commision' => $request->commision,
            'qty' => $request->qty,
            'long_desp' => $request->long_desp,
            'sku' => $sku,
            'slug' => Str::slug($request->product_name, '-'),
        ]);

        if ($request->has('preview')) {
            // Handle preview image
            $preview_img = $request->file('preview');
            $extension = $preview_img->getClientOriginalExtension();
            $file_name = $product->id. $random . '.' . $extension;
            $preview_path = public_path('upload/product/preview/' . $file_name);
            Image::make($preview_img)->resize(720, 720)
                ->save($preview_path, 80);

            $product->update([
                'preview' => $file_name,
            ]);
        }

        // Handle gallery images if provided
        if ($request->has('gallery')) {
            $gallery_img = $request->gallery;

            foreach ($gallery_img as $sl => $gallery) {
                $gall_extension = $gallery->getClientOriginalExtension();
                $gall_name = $product->id. $random . $sl . '.' . $gall_extension;

                $gallery_path = public_path('upload/product/gallery/' . $gall_name);
                Image::make($gallery)->resize(720, 720)
                    ->save($gallery_path, 80);

                // Create gallery images using create function
                ProductGallery::create([
                    'product_id' => $product->id,
                    'gallery' => $gall_name,
                ]);
            }
        }

        // Return success response
        return response()->json();
    }


    function delete(Request $request)
    {

        $present = Product::find($request->product_id);
        unlink(public_path('upload/product/preview/' . $present->preview));

        $present_gallery = ProductGallery::where('product_id', $request->product_id)->get();
        foreach ($present_gallery as $gallery) {
            unlink(public_path('upload/product/gallery/' . $gallery->gallery));
            ProductGallery::where('product_id', $gallery->product_id)->delete();
        }

        $present->delete();

        return response()->json([
            'status' => 'success',
        ]);
    }



    public function get_product_gallery($product_id)
    {

        $product = Product::with('galleries')->find($product_id);

        if (!$product) {
            return response()->json([
                'status' => 'error',
                'message' => 'Product not found.'
            ], 404);
        }

        if ($product->galleries->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => 'No gallery images found for this product.'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $product->galleries
        ], 200);
    }

    public function update(Request $request)
    {

        // Validate product
        $request->validate([
            'preview' => 'image|max:2024',
            'gallery' => 'array|max:6',
            'gallery.*' => 'image|max:5060',
        ], [
            'preview.max' => 'Preview Image must not be greater than 5 MB!',
            'gallery.max' => 'You can upload a maximum of 6 gallery images!',
            'gallery.*.max' => 'Each gallery Image must not be greater than 5 MB!',
        ]);

        // Find the product by ID
        $product = Product::find($request->product_id);

        $random = random_int(1000, 9990);

        // Generate SKU and slug
        $sku = Str::upper(str_replace(' ', '_', substr($request->product_name, 0, 2))) . '_' . $random;

        // Handle preview image update if not null
        if ($request->hasFile('preview')) {
            unlink(public_path('upload/product/preview/' . $product->preview));


            // Upload the new preview image
            $preview_img = $request->file('preview');
            $extension = $preview_img->getClientOriginalExtension();
            $file_name2 =$product->id. $random . '.' . $extension;
            $preview_path = public_path('upload/product/preview/' . $file_name2);
            Image::make($preview_img)
                ->resize(720, 720)
                ->save($preview_path, 80);
            $product->update([
                'preview' => $file_name2,
            ]);
        }

        $product_gallery = ProductGallery::where('product_id', $request->product_id)->get();
        if ($request->hasFile('gallery')) {
            if ($product_gallery->isNotEmpty()) {
                // Unlink the old gallery images if they exist
                foreach ($product_gallery as $galleryImage) {
                    unlink(public_path('upload/product/gallery/' . $galleryImage->gallery));
                }
                // Delete the existing gallery entries
                ProductGallery::where('product_id', $request->product_id)->delete();
            }

            // Upload and save new gallery images
            foreach ($request->gallery as $sl => $gallery) {
                $gall_extension = $gallery->getClientOriginalExtension();
                $gall_name2 = $product->id. $random . $sl . '.' . $gall_extension;

                $gallery_path = public_path('upload/product/gallery/' . $gall_name2);
                Image::make($gallery)->resize(720, 720)
                    ->save($gallery_path, 80);

                // Create gallery images using create function
                ProductGallery::create([
                    'product_id' => $product->id,
                    'gallery' => $gall_name2,
                ]);
            }
        }

        $product->update([
            'product_name' => $request->product_name,
            'price' => $request->price,
            'discount' => $request->discount,
            'after_discount' => $request->price - ($request->price * $request->discount) / 100,
            'category_id' => $request->category_id,
            'commision' => $request->commision,
            'qty' => $request->qty,
            'long_desp' => $request->long_desp,
            'sku' => $sku,
            'slug' => Str::slug($request->product_name, '-'),
        ]);

        return response()->json();
    }
}

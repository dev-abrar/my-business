<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    function checkout_order(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'number' => 'required',
            'district' => 'required',
            'city' => 'required',
            'address' => 'required',
        ]);

        $random = random_int(100000, 9999999);
        $order_id = '#' . Str::upper(substr($request->district, 0, 3)) . '-' . $random;
        $total = $request->price * $request->qty + $request->charge;
        Order::create([
            'order_id' => $order_id,
            'product_id' => $request->product_id,
            'student_id' => $request->student_id,
            'name' => $request->name,
            'number' => $request->number,
            'district' => $request->district,
            'city' => $request->city,
            'address' => $request->address,
            'extra_address' => $request->extra_address,
            'qty' => $request->qty,
            'commision' => $request->commision,
            'charge' => $request->charge,
            'total' => $total,
        ]);

        Product::where('id', $request->product_id)->decrement('qty', $request->qty);

        $new_order_id = substr($order_id, 1);
        return redirect()->route('order.success', $new_order_id)->withOrdersuccess('Ordersuccess');
    }

    function order_success($order_id)
    {
        if (session('ordersuccess')) {
            return view('pages.frontend.order_success', compact('order_id'));
        } else {
            abort('404');
        }
    }

    function orders(){
        return view('pages.dashboard.order');
    }

    public function order_list()
    {
        $orders = Order::with(['rel_to_product', 'rel_to_student'])
        ->orderBy('created_at', 'desc') // Sort by latest first
        ->get();
    
        // Map all necessary data into a response-friendly format
        $data = $orders->map(function ($order) {
            return [
                'order_id' => $order->order_id,
                'name' => $order->name,
                'number' => $order->number,
                'district' => $order->district,
                'city' => $order->city,
                'address' => $order->address,
                'extra_address' => $order->extra_address,
                'charge' => $order->charge,
                'commission' => $order->commision,
                'qty' => $order->qty,
                'total' => $order->total,
                'sts' => $order->sts,
                'product_id' => $order->rel_to_product->id ?? null,
                'product_name' => $order->rel_to_product->product_name ?? 'N/A',
                'product_price' => $order->rel_to_product->after_discount ?? 0,
                'student_id' => $order->rel_to_student->id ?? null,
                'student_name' => $order->rel_to_student->name ?? 'Not A Member',
            ];
        });
    
        return response()->json($data);
    }

    function update(Request $request){
        Order::where('order_id', $request->order_id)->update([
            'sts'=>$request->sts,
        ]);

        return response()->json();
    }
    
}

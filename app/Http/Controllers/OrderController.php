<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{



    public function create()
    {
        $products = Product::all();
        return view('order.create', compact('products'));
    }
    public function store(StoreOrderRequest $request)
    {

        $products = $request->input('product_ids');
        $customer_id = $request->input('customer_id');
        $quantities = $request->input('quantities');

        // "customer_id",
        // "status",
        // "user_id",
        // "total_amount",
        // "total_quantity",

        $serialNo = $this->generateSerialNomber();

        $order = \App\Models\Order::create([
            'serial_number' => $serialNo,
            'customer_id' => $customer_id,
            'total_quantity' => $this->sum($quantities),
            'user_id' => Auth::id(),
            'status' => 'booked',
            'total_amount' => $this->sum($quantities) * Product::find($products[0])->price,
        ]);


        for ($i = 0; $i < count($products); $i++) {
            $orderChild = \App\Models\OrderChild::create([
                'order_id' => $order->id,
                'product_id' => $products[$i],
                'quantity' => $quantities[$i],
            ]);
        }
        return response('success', 200);
    }

    public function sum($quantities)
    {
        $sum = 0;
        foreach ($quantities as $quantity) {
            $sum += $quantity;
        }
        return $sum;
    }

    public function generateSerialNomber()
    {
        $serialNo = 'NBG/' . date('m-Y/');
        $today_last_order = \App\Models\Order::whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->orderBy('id', 'desc')->first();
        if ($today_last_order) {
            $serialNo .= str_pad($today_last_order->count() + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $serialNo .= '0001';
        }
        return $serialNo;
    }

    public function toArray($request)
    {
        return [
            'created_at' => $this->created_at->format('Y-m-d H:i:s')
        ];
    }
}

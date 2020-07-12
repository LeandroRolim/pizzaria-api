<?php


namespace App\Http\Controllers\Order;


use App\Http\Controllers\Controller;
use App\Http\Requests\Order\RegisterRequest;
use App\Models\Order\Order;
use App\Models\Order\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'user_uid' => 'required|uuid',
            'order_address_id' => 'required|integer',
            'products.*.product_id' => 'required|integer',
            'products.*.amount' => 'required|integer',
            'products' => 'array|min:1|required'
        ]);
        $order = Order::create($request->only([
            'user_uid',
            'comments',
            'order_address_id',
        ]));
        $products = [];
        foreach ($request->input('products') as $product) {
            $products[] = new Product($product);
        }
        $order->products()->saveMany($products);
        return new JsonResponse($order, 201);
    }
}

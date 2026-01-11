<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Product;

class PurchaseController extends Controller
{
    public function buy(int $id)
    {
        return DB::transaction(function () use ($id) {

            $product = Product::where('id', $id)
                ->lockForUpdate()
                ->first();

            if (! $product || $product->stock < 1) {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Out of stock'
                ], 409);
            }

            $product->stock -= 1;
            $product->save();

            DB::table('orders')->insert([
                'product_id' => $product->id,
                'status' => 'SUCCESS',
                'created_at' => now()
            ]);

            return response()->json([
                'status' => 'success'
            ]);
        });
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCartItemRequest;
use App\Http\Requests\UpdateCartItemRequest;
use App\Http\Resources\CartItemResource;
use App\Models\CartItem;
use Illuminate\Http\Request;


class CartItemController extends Controller
{
    //
    public function store(StoreCartItemRequest $request)
    {
        $item = CartItem::create([
            'user_id' => auth()->id(),
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Item added.',
            'data' => new CartItemResource($item->load('product'))
        ]);
    }

    public function update(UpdateCartItemRequest $request, $id)
    {
        $item = CartItem::where('user_id', auth()->id())->findOrFail($id);

        $item->update([
            'quantity' => $request->quantity
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Quantity updated.',
            'data' => new CartItemResource($item->load('product'))
        ]);
    }

    public function destroy($id)
    {
        $item = CartItem::where('user_id', auth()->id())->findOrFail($id);

        $item->delete();

        return response()->json([
            'success' => true,
            'message' => 'Item removed.'
        ]);
    }
}

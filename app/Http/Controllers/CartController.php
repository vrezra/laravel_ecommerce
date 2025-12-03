<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use Illuminate\Http\Request;

class CartController extends Controller
{
    //
    public function index(Request $request)
    {
        $user = $request->user(); // pastikan user tidak null

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 401);
        }

        $items = CartItem::where('user_id', $user->id)
            ->with('product')
            ->get();

        return response()->json([
            'success' => true,
            'items' => $items
        ]);
    }

}

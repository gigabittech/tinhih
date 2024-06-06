<?php

namespace App\Http\Controllers;
use GuzzleHttp\Client;
use App\Services\PrintfulService;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Cart;


class CartController extends Controller
{
    public function viewCart()
    {

        $apiKey = 'PwWSZjoYp22egFPCKZYaoQAH62IBGrGw8v4DB3QJ';
        $cartItems = Cart::content();
        $printfulProducts = [];

        foreach ($cartItems as $item) {
            $printfulProductId = $item->options->printful_product_id;
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
            ])->get("https://api.printful.com/products/$printfulProductId");

            $printfulProduct = $response->json();
            $printfulProducts[] = $printfulProduct;
        }

        return view('admin.pages.products.cart', compact('cartItems', 'printfulProducts'));
    }
}

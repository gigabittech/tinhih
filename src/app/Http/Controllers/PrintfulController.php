<?php

namespace App\Http\Controllers;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Services\PrintfulService;
use App\Models\Admin\PrintfulProduct;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Support\Facades\Http;
use Session;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Alaouy\Youtube\Facades\Youtube;
use Illuminate\Database\QueryException;

class PrintfulController extends Controller
{
    protected $printfulService;
    private $moduleObject;
    private $moduleName = "Product";
    private $singularVariableName = 'product';
    private $pluralVariableName = 'products';

    private $retrievedDataList;
    private $singleData;
    private $path;

    public function __construct()
    {
        
        $this->moduleObject = new PrintfulProduct();
        $this->path = "admin.pages." . $this->pluralVariableName;
    }

    // public function __construct(PrintfulService $printfulService)
    // {
    //     $this->printfulService = $printfulService;
    // }

    // public function index()
    // {
    //     $products = $this->printfulService->getProducts();
    //     return view('admin/pages/products/index', compact('products'));
    // }


    public function getSyncedProducts()
    {
        $apiKey = 'PwWSZjoYp22egFPCKZYaoQAH62IBGrGw8v4DB3QJ';
        $baseUrl = 'https://api.printful.com/';

        $client = new Client([
            'base_uri' => $baseUrl,
            'headers' => [
                'Authorization' => 'Bearer ' . $apiKey,
            ],
            
        ]);

        

        $response = $client->get('sync/products');
        $products = json_decode($response->getBody()->getContents(), true);
        // dd($products);
        // exit;
        return view($this->path . '.index', [
            $this->pluralVariableName => $this->retrievedDataList,
            'products'=>$products,
        ]);
    }
    
    
    
    public function addCart(Request $request)
    {

        $productId = $request->input('product_id');
        $apiKey = 'PwWSZjoYp22egFPCKZYaoQAH62IBGrGw8v4DB3QJ';
        $baseUrl = 'https://api.printful.com/';

        $client = new Client([
            'base_uri' => $baseUrl,
            'headers' => [
                'Authorization' => 'Bearer ' . $apiKey,
            ],
            'result' => [
                'sync_product' => $productId,
                'sync_variants' => $productId,
            ],
        ]);

        $response = $client->get('sync/products/' . $productId);
        
        
        $carts = json_decode($response->getBody()->getContents(), true);

        // dd($carts);
        // exit;
        Session::put ('cart', $carts);
        

        return redirect()->route('cart');
        // return view('admin.pages.products.cart', compact('carts'));
        
    }

    public function viewCart()
    {

        $carts = session()->get('cart');
        // dd($carts);
        // exit;
        

        return view('admin.pages.products.cart', compact('carts'));
        
    }




    public function checkout()
    {
        return view('admin.pages.products.checkout');
    }

    public function processCheckout(Request $request)
    {
      


          
        // // Redirect to the order confirmation page or handle response as needed
        // return redirect()->route('printful.orderConfirmation', ['orderId' => $orderId]);



    }


  




}









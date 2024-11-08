<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    //
    function index()
    {
        $data = Product::all();
        return view('product', ['products' => $data]);
    }

    function detail($id)
    {
        $data = Product::find($id);
        return view('detail', ['product' => $data]);
    }

    function search(Request $request)
    {
        // return $request->input();
        $data = Product::where('name', 'like', '%' . $request->input('query') . '%')->get();
        //    dd($data);
        return view('search', ['products' => $data]);
    }

    function add(Request $request)
    {
        if ($request->session()->has('user')) {
            $cart = new Cart;
            $cart->user_id = $request->session()->get('user')['id'];
            $cart->product_id = $request->product_id;
            $cart->save();
            return redirect('/cartlist');
        } else {
            return redirect('/login');
        }
    }

    static function cartItem()
    {
        $userId = Session::get('user')['id'];
        return Cart::where('user_id', $userId)->count();
    }

    function cart()
    {
        $userId = Session::get('user')['id'];
        $data = DB::table('carts')->join('products', 'carts.product_id', 'products.id')->select('products.*', 'carts.id as cart_id')->where('carts.user_id', $userId)->get();
        return view('cartlist', ['products' => $data]);
    }

    function remove($id)
    {

        Cart::destroy($id);
        return redirect('/cartlist');
    }

    function order(Request $request) 
    {
        $userId = Session::get('user')['id'];
        $total = DB::table('carts')->join('products', 'carts.product_id', 'products.id')->where('carts.user_id', $userId)->sum('products.price');
        return view('order', ['total' => $total]);
    }
    function orderplace(Request $request){
        $userId = Session::get('user')['id'];
        $allcart=Cart::where('user_id',$userId)->get();
        foreach($allcart as $cart){
            $order= new Order;
            $order->product_id=$cart['product_id'];
            $order->user_id = $cart['user_id'];
            $order->address = $request->address;
            $order->status ="pending";
            $order->payment_method =$request->payment;
            $order->payment_status ="pending";
            $order->save();
        }
        Cart::where('user_id', $userId)->delete();
        return redirect('/');
        // return $request->input();
    }
    function myorder(){
        $userId = Session::get('user')['id'];
        $orders= DB::table('orders')->join('products', 'orders.product_id', 'products.id')->where('orders.user_id', $userId)->get();
        return view('myorders', ['orders' => $orders]);
    }

    public function showByCategory($id)
    {
        // Find the category by ID
        $category = Category::findOrFail($id);

        // Retrieve products that belong to this category using the relationship
        $products = $category->products;  // Eloquent will automatically fetch the related products

        // Return the view with the category and products
        return view('product', compact('category', 'products'));
    }

// Crud Operation

    function dashboard(){
        $data=Product::all();
        return view('product/dashboard',['data' => $data]);
    }

    function create()
    {
        
        $category = Category::all();
        return view('product/create',['category'=>$category]);
    }
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|exists:categories,id',  // Ensure category ID exists
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'gallery' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle the image upload
        $imagePath = null;
        if ($request->hasFile('gallery')) {
            $imagePath = $request->file('gallery')->store('images', 'public');
        } else {
            return back()->withErrors(['gallery' => 'Image upload failed.']);
        }

        // Create the product with the data
        $product = Product::create([
            'name' => $request->name,
            'category_id' => $request->category,  // Use category ID, not name
            'price' => $request->price,
            'description' => $request->description,
            'gallery' => $imagePath,
        ]);

        return redirect()->route('product.dashboard')->with('success', 'Product created successfully!');
    }
    public function edit($id)
    {
        // Fetch the product by ID or fail if not found
        $product = Product::findOrFail($id);

        // Return the edit view with the product data
        return view('product.edit', compact('product'));
    }
    public function update(Request $request, $id)
    {
        // Validate the incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string',
            'gallery' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price' => 'required|numeric',
            'description' => 'required|string',
        ]);

        // Find the product by ID or fail if not found
        $product = Product::findOrFail($id);

        // Update product details
        $product->name = $request->name;
        $product->category = $request->category;
        $product->price = $request->price;
        $product->description = $request->description;

        // Handle file upload for the image
        if ($request->hasFile('gallery')) {
            // Store the new image and update the path in the database
            $path = $request->file('gallery')->store('images', 'public');
            $product->gallery = $path;
        }

        // Save the updated product
        $product->save();

        // Redirect back to the product dashboard with a success message
        return redirect()->route('product.dashboard')->with('success', 'Product updated successfully!');
    }
    public function destroy($id)
    {
        // Find the product by ID or fail if not found
        $product = Product::findOrFail($id);

        // Optionally, delete the product's image file from storage
        if ($product->gallery) {
            Storage::disk('public')->delete($product->gallery);
        }

        // Delete the product
        $product->delete();

        // Redirect back to the product dashboard with a success message
        return redirect()->route('product.dashboard')->with('success', 'Product deleted successfully!');
    }
    
}

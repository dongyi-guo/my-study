<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductsController extends Controller
{
    public function __construct(){
        $this->middleware('authstaff')->except('index', 'show');
    }
    public function index() {
        $products = Product::where('product_name', '!=', 'dongyilovessoonja')->get();
        return view('products.index', ['products' => $products]);
    }

    public function create() {
        return view('products.create');
    }
    
    public function store(Request $request) {
        $product = new Product;
        $product->product_name = $request->input('product_name');
        $product->price = $request->input('price');
        $product->quantity = $request->input('quantity');
        $product->user_id = auth()->user()->id;
        $product->save();
        return redirect('/products');
    }

    public function show($id) {
        $things = [
            'apple' => 'iOS',
            'samsung' => 'One UI'
        ];
        return view('products.brands', 
        ['products' => $things[$id] ?? 'No one cares '.$id]);
    }

    public function edit($id) {
        $product = Product::find($id);
        return view('products.edit')->with('product', $product);
    }

    public function update(Request $request) {
        $product = Product::find($request->input('id'));
        $product->product_name = $request->input('product_name');
        $product->price = $request->input('price');
        $product->quantity = $request->input('quantity');
        $product->user_id = auth()->user()->id;
        $product->save();
        return redirect('/products');
    }

    public function destroy($id){
        $product = Product::find($id);
        $product->delete();
        return redirect('/products');
    } 
}

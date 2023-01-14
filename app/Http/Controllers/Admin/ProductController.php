<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Product;
use App\Shop;
use Illuminate\Support\Facades\File;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $shops = Shop::all();
        return view('admin.products.create', compact('shops'));
    }


    public function store(StoreProductRequest $request)
    {
//        dd($request->product_price);
        $file = $request->file('image');
        $filename = date('YmdHi') . $request->file('image')->getClientOriginalName();
        $file->move(public_path('storage/products/img'), $filename);
        Product::query()->create([
            'product_name' => $request->product_name,
            'product_description' => $request->product_description,
            'product_price' => $request->product_price,
            'shop_id' => $request->shop,
            'image' => $filename,
        ]);
        return redirect()->route('admin.products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $shops = Shop::all();
        return view('admin.products.edit', compact( 'product', 'shops'));
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        if ($request->file('image')) {
            if (File::exists('storage/products/img' . $product->image)) {
                File::delete('storage/products/img' . $product->image);
            }
            $file = $request->file('image');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move('storage/products/img', $filename);
        }

        $product->updateOrFail([
            'product_name' => $request->product_name ?: $product->name,
            'product_description' => $request->product_description ?: $product->product_description,
            'photo' => $request->file('image') ? $filename : $product->image,
            'product_price' => $request->product_price ?: $product->product_price
        ]);
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return back();
    }
    public function massDestroy()
    {
        Shop::whereIn('id', request('ids'))->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}

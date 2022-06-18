<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Promo;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Product::with(["promo", "productCategory"])->get();

        return view('pages.product.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $promos = Promo::all();
        $productCategories = ProductCategory::all();
        return view("pages.product.create", compact("promos", "productCategories"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->only(["name", "stock", "price", "promo_id", "product_category_id"]);
        $createdData = Product::create($input);
        if (!$createdData) {
            return redirect()->route("product-web.create")->with("danger", "Gagal Membuat Data");
        }
        return redirect()->route("product-web.index")->with("success", "Berhasil Membuat Data");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $promos = Promo::all();
        $productCategories = ProductCategory::all();
        $data = $product->load(["promo", "productCategory"]);
        return view("pages.product.update", compact("promos", "productCategories", "data"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $input = $request->only(["name", "stock", "price", "promo_id", "product_category_id"]);
        $updatedData = $product->update($input);
        if (!$updatedData) {
            return redirect()->route("product-web.edit")->with("danger", "Gagal Mengubah Data");
        }
        return redirect()->route("product-web.index")->with("success", "Berhasil Mengubah Data");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $deletedData = $product->delete();
        if (!$deletedData) {
            return redirect()->route("product-web.index")->with("danger", "Gagal Menghapus Data");
        }
        return redirect()->route("product-web.index")->with("success", "Berhasil Menghapus Data");
    }
}

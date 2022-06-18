<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = ProductCategory::with("products")->get();

        return view("pages.product_category.index", compact("datas"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("pages.product_category.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->only(["name"]);
        $createdData = ProductCategory::create($input);
        if (!$createdData) {
            return redirect()->route("product-category-web.index")->with("danger", "Gagal Membuat Data");
        }
        return redirect()->route("product-category-web.index")->with("success", "Berhasil Membuat Data");
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
    public function edit(ProductCategory $productCategory)
    {
        $data = $productCategory->load("products");
        // dd($data);
        return view("pages.product_category.update", compact("data"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  ProductCategory $productCategory)
    {
        $input = $request->only(["name"]);
        $updatedData = $productCategory->update($input);
        if (!$updatedData) {
            return redirect()->route("product-category-web.index")->with("danger", "Gagal Mengubah Data");
        }
        return redirect()->route("product-category-web.index")->with("success", "Berhasil Mengubah Data");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductCategory $productCategory)
    {
        $deletedData = $productCategory->delete();
        if (!$deletedData) {
            return redirect()->route("product-category-web.index")->with("danger", "Gagal Menghapus Data");
        }
        return redirect()->route("product-category-web.index")->with("success", "Berhasil Menghapus Data");
    }
}

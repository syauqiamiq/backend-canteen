<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Promo;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productCategories = ProductCategory::all();
        $products = Product::with(["promo", "productCategory"])->get();
        $promos = Promo::all();
        return view("pages.client.landing_page.index", compact("productCategories", "products", "promos"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {

        $category = ProductCategory::with(["products"])->where("category_slug", $slug)->get();
        if (count($category) == 0) {
            $productByPromo = Promo::with(["products"])->where("promo_slug", $slug)->first()->products;
            $products = $productByPromo;
            $productCategories = ProductCategory::all();
            $promos = Promo::all();
            $promo = Promo::where("promo_slug", $slug)->first();
            return view("pages.client.landing_page.promo", compact("productCategories", "products", "promos", "promo"));
        }
        $productCategories = ProductCategory::all();
        $products = $category->first()->products;
        $category = $category->first();
        $promos = Promo::all();
        return view("pages.client.landing_page.category", compact("productCategories", "products", "promos", "category"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

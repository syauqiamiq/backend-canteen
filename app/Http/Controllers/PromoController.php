<?php

namespace App\Http\Controllers;

use App\Models\Promo;
use App\Http\Requests\StorePromoRequest;
use App\Http\Requests\UpdatePromoRequest;

class PromoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ["except" => ["index", "show"]]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Promo::with("products")->get();
        if (!$data) {
            return sendResponse("Failed get data", 400, "error", null);
        }
        return sendResponse("Successfully Get Data", 200, "success", $data);
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
     * @param  \App\Http\Requests\StorePromoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePromoRequest $request)
    {
        $input = $request->only(["name", "discount"]);

        $createdData = Promo::create($input);
        if (!$createdData) {
            return sendResponse("Failed to create data", 400, "error", null);
        }
        return sendResponse("Successfully create the data", 200, "success", $createdData);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Promo  $promo
     * @return \Illuminate\Http\Response
     */
    public function show(Promo $promo)
    {
        $data = $promo->load("products");

        return sendResponse("Successfully get the data", 200, "success", $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Promo  $promo
     * @return \Illuminate\Http\Response
     */
    public function edit(Promo $promo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePromoRequest  $request
     * @param  \App\Models\Promo  $promo
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePromoRequest $request, Promo $promo)
    {
        $input = $request->only(["name", "discount"]);
        $promo->update($input);
        return sendResponse("Successfully update the data", 200, "success", $promo);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Promo  $promo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Promo $promo)
    {
        $promo->delete();
        return sendResponse("Successfully delete the data", 200, "success", $promo);
    }
}

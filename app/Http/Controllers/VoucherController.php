<?php

namespace App\Http\Controllers;

use App\Models\Voucher;
use App\Http\Requests\StoreVoucherRequest;
use App\Http\Requests\UpdateVoucherRequest;

class VoucherController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Voucher::with("user:id,name")->get();
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
     * @param  \App\Http\Requests\StoreVoucherRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVoucherRequest $request)
    {
        $input = $request->only(["code", "amount", "user_id"]);

        $createdData = Voucher::create($input);
        if (!$createdData) {
            return sendResponse("Failed to create data", 400, "error", null);
        }
        return sendResponse("Successfully create the data", 200, "success", $createdData);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Voucher  $voucher
     * @return \Illuminate\Http\Response
     */
    public function show(Voucher $voucher)
    {
        $data = $voucher->load("user:id,name");

        return sendResponse("Successfully get the data", 200, "success", $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Voucher  $voucher
     * @return \Illuminate\Http\Response
     */
    public function edit(Voucher $voucher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateVoucherRequest  $request
     * @param  \App\Models\Voucher  $voucher
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVoucherRequest $request, Voucher $voucher)
    {
        $input = $request->only(["code", "amount", "user_id"]);
        $voucher->update($input);
        return sendResponse("Successfully update the data", 200, "success", $voucher);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Voucher  $voucher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Voucher $voucher)
    {
        $voucher->delete();
        return sendResponse("Successfully delete the data", 200, "success", $voucher);
    }
}

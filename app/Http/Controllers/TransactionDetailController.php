<?php

namespace App\Http\Controllers;

use App\Models\TransactionDetail;
use App\Http\Requests\StoreTransactionDetailRequest;
use App\Http\Requests\UpdateTransactionDetailRequest;

class TransactionDetailController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth:api");
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = TransactionDetail::with("product:id,name,price")->get();
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
     * @param  \App\Http\Requests\StoreTransactionDetailRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTransactionDetailRequest $request)
    {
        $input = $request->only(["quantity", "unit_price", "transaction_id", "product_id"]);

        $createdData = TransactionDetail::create($input);
        if (!$createdData) {
            return sendResponse("Failed to create data", 400, "error", null);
        }
        return sendResponse("Successfully create the data", 200, "success", $createdData);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TransactionDetail  $transactionDetail
     * @return \Illuminate\Http\Response
     */
    public function show(TransactionDetail $transactionDetail)
    {
        $data = $transactionDetail->load("product:id,name,price");

        return sendResponse("Successfully get the data", 200, "success", $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TransactionDetail  $transactionDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(TransactionDetail $transactionDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTransactionDetailRequest  $request
     * @param  \App\Models\TransactionDetail  $transactionDetail
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTransactionDetailRequest $request, TransactionDetail $transactionDetail)
    {
        $input = $request->only(["quantity", "unit_price", "transaction_id", "product_id"]);
        $transactionDetail->update($input);
        return sendResponse("Successfully update the data", 200, "success", $transactionDetail);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TransactionDetail  $transactionDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(TransactionDetail $transactionDetail)
    {
        $transactionDetail->delete();
        return sendResponse("Successfully delete the data", 200, "success", $transactionDetail);
    }
}

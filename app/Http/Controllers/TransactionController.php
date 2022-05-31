<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest;

class TransactionController extends Controller
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
        $data = Transaction::with("user:id,name", "transactionDetail")->get();
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
     * @param  \App\Http\Requests\StoreTransactionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTransactionRequest $request)
    {
        $input = $request->only(["transaction_date", "total_price", "user_id", "note"]);

        $createdData = Transaction::create([
            "transaction_date" => $input["transaction_date"],
            "total_price" => $input["total_price"],
            "status" => "pending",
            "user_id" => $input["user_id"],
        ]);
        if (!$createdData) {
            return sendResponse("Failed to create data", 400, "error", null);
        }
        return sendResponse("Successfully create the data", 200, "success", $createdData);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        $data = $transaction->load("user:id,name", "transactionDetail");

        return sendResponse("Successfully get the data", 200, "success", $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTransactionRequest  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTransactionRequest $request, Transaction $transaction)
    {
        $input = $request->only(["transaction_date", "total_price", "unit_price", "status", "user_id", "note"]);
        $transaction->update($input);
        return sendResponse("Successfully update the data", 200, "success", $transaction);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return sendResponse("Successfully delete the data", 200, "success", $transaction);
    }
}

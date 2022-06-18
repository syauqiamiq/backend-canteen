<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Promo;
use Illuminate\Http\Request;

class PromoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Promo::with("products")->get();

        return view("pages.promo.index", compact("datas"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("pages.promo.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->only(["name", "discount"]);
        $createdData = Promo::create($input);
        if (!$createdData) {
            return redirect()->route("promo-web.index")->with("danger", "Gagal Membuat Data");
        }
        return redirect()->route("promo-web.index")->with("success", "Berhasil Membuat Data");
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
    public function edit(Promo $promo)
    {
        $data = $promo->load("products");
        // dd($data);
        return view("pages.promo.update", compact("data"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Promo $promo)
    {
        $input = $request->only(["name", "discount"]);
        $updatedData = $promo->update($input);
        if (!$updatedData) {
            return redirect()->route("promo-web.index")->with("danger", "Gagal Mengubah Data");
        }
        return redirect()->route("promo-web.index")->with("success", "Berhasil Mengubah Data");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Promo $promo)
    {
        $deletedData = $promo->delete();
        if (!$deletedData) {
            return redirect()->route("promo-web.index")->with("danger", "Gagal Menghapus Data");
        }
        return redirect()->route("promo-web.index")->with("success", "Berhasil Menghapus Data");
    }
}

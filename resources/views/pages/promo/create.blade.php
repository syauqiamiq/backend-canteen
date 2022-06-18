@extends('layouts.admin')

@section('title','Promo Produk')

@section('breadcrumb')
<nav>
  <!-- breadcrumb -->
  <ol class="flex flex-wrap pt-1 mr-12 bg-transparent rounded-lg sm:mr-16">
    <li class="leading-normal text-size-sm">
      <a class="opacity-50 text-slate-700" href="javascript:;">Pages</a>
    </li>
    <li class="text-size-sm pl-2 capitalize leading-normal text-slate-700 before:float-left before:pr-2 before:text-gray-600 before:content-['/']" aria-current="page">Create Promo</li>
  </ol>
  <h6 class="mb-0 font-bold capitalize">Create Promo</h6>
</nav>

@endsection

@section('main-content')

<div class="flex flex-wrap -mx-3">
  <div class="flex-none w-full max-w-full px-3">
    <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
      <div class="flex justify-between p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
        <h6>Tambah Promo Produk</h6>
      </div>
      <div class="flex-auto px-0 pt-0 pb-2">
        <div class="p-0 overflow-x-auto">
          <form action="{{ route('promo-web.store') }}" method="POST" >
            @csrf
            <div class="p-6">
              <label class="text-sm font-semibold">Nama Promo</label>
              <input type="text" name="name" placeholder="Masukkan Nama Promo" class="focus:shadow-soft-primary-outline text-size-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none"/>
            </div>
            <div class="p-6">
              <label class="text-sm font-semibold">Discount Produk</label>
              <input type="text" name="discount" placeholder="Masukkan discount produk" class="focus:shadow-soft-primary-outline text-size-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none"/>
            </div>
            <div class="p-6 flex justify-end">
              <button type="submit" class="h-9 w-100 bg-green-500">Submit</button>
            </div>
          </form>
 
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
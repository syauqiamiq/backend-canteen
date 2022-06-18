@extends('layouts.client')

@section('title','E-Canteen')

@section('main-content')

      <!-- cards -->
      <div class="w-full px-6 py-6 mx-auto">
        <h2>Promo {{ $promo->name }}</h2>
        <!-- row 1 -->
        <div class="flex flex-wrap -mx-3">
          <!-- card4 -->
          @foreach ($products as $product)
          <div class="w-full p-4 max-w-full  px-3 sm:w-1/2 sm:flex-none xl:w-1/4">
            <div style="min-height: 125px !important" class="relative flex flex-col  min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
              <div class="flex-auto p-4">
                <div class="flex flex-row -mx-3">
                  <div class="flex-none w-2/3 max-w-full px-3">
                    <div>
                      <p class="mb-0 flex justify-between font-sans font-semibold leading-normal text-size-sm">{{ $product->name }}<span class="leading-normal text-size-sm font-weight-bolder text-lime-500">{{ $product->stock }} pcs</span></p>
                      <i style="text-decoration: line-through !important; color:red">{{ $product->promo_id != null ? "Rp.".$product->price : ""  }}</i>
                      <h5 class="mb-0 font-bold flex justify-between">
                       <span>{{$product->promo_id != null ? $product->price-$product->promo->discount : "Rp.".$product->price  }} </span>
                      </h5>
                    </div>
                  </div>
                  <div class="px-3 text-right basis-1/3">
                    <div class="inline-block w-12 h-12 text-center rounded-lg bg-gradient-fuchsia">
                      <i class="ni ni-cart text-size-lg relative top-3.5 text-white"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          @endforeach
        </div>

      </div>
@endsection
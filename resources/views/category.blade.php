@extends('layouts.shared')

@section('content')
    <div class="product-section mt-150 mb-150">
        <div class="container">

            <div class="row">
                <div class="col-md-12">
                    <div class="product-filters">
                        <ul>
                            <li class="" data-filter="*">All</li>

                            @foreach ($categories as $item)
                                <li data-filter="._{{$item->id}}"> {{ $item->name }} </li>
                            @endforeach

                        </ul>
                    </div>
                </div>
            </div>

            <div class="row product-lists" style="position: relative; height: 555.688px;">

                @foreach ($products as $item)
                    <div class="col-lg-4 col-md-6 text-center _{{$item->category_id}}"
                        style="position: absolute; left: 0px; top: 0px;">
                        <div class="single-product-item">
                            <div class="product-image">
                                <a href="/single-product/{{ $item->id }}">
                                    <img style="max-height: 250px; min-height:250px" src="{{asset($item -> imagepath)}}"
                                        alt=""></a>
                            </div>
                            <h3>{{$item -> name}}</h3>
                            <p class="product-price"><span>Amount:</span> {{$item -> amount}} </p>
                            <p class="product-price"><span>Price:</span> {{$item -> price}}$ </p>


                            @if (Auth::user() && Auth::user()->role != 'admin')

                            <a href="/addtocart/{{$item->id}}" class="cart-btn"><i class="fas fa-shopping-cart"></i> Add to Cart</a>
                             @endif
                            @if (Auth::user() && Auth::user()->role == 'admin')
                                <p class="mt-3">
                                    <a href="/removeproduct/{{ $item->id }}" class="btn btn-danger"><i
                                            class="fa fa-trash">
                                        </i> Delete </a>

                                    <a href="/editproduct/{{ $item->id }}" class="btn btn-primary"><i
                                            class="fa fa-edit">
                                        </i> Edit </a>
                                </p>
                            @endif

                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
@endsection

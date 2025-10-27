@extends('layouts.shared')

@section('content')
    <div class="cart-section mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12">
                    <div class="cart-table-wrap">
                        <table class="cart-table">
                            <thead class="cart-table-head">
                                <tr class="table-head-row">
                                    <th class="product-remove"></th>
                                    <th class="product-image">Product Image</th>
                                    <th class="product-name">Name</th>
                                    <th class="product-price">Price</th>
                                    <th class="product-amount">Amount</th>
                                    <th class="product-total">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cartProducts as $item)
                                    <tr class="table-body-row">
                                        <td class="product-remove">
											<a href="/deletecartitem/{{$item->id}}"><i class="far fa-window-close"></i></a>
                                        </td>
                                        <td class="product-image"><img src="{{ asset($item->product->imagepath) }}"
                                                alt=""></td>
                                        <td class="product-name"> <a href="
                                            /single-product/{{$item-> product ->id}}"> {{ $item->product->name }}  </a> </td>
                                        <td class="product-price">{{ $item->product->price }}</td>
                                        <td class="product-amount">{{ $item->amount }}</td>
                                        <td class="product-total">{{ $item->product->price * $item->amount }}$</td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="total-section">
                        <table class="total-table">
                            <thead class="total-table-head">
                                <tr class="table-total-row">
                                    <th>Total</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="total-data">
                                    <td><strong>Total: </strong></td>
                                    <td>
                                       {{ $cartProducts->sum (function($item){
                                        return $item->product->price * $item->amount;
                                        }) }}$
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="cart-buttons">
                            @if (Auth::user() && Auth::user()->role != 'admin')

                            <a href="/order" class="boxed-btn black">Check Out</a>
                            @endif

                             @if (Auth::user() && Auth::user()->role == 'admin')

                            <a href="/previousorder" class="boxed-btn black">Previous Orders</a>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

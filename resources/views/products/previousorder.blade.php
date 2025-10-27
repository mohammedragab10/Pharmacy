@extends('layouts.shared')

@section('content')


    <div class="checkout-section mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="checkout-accordion-wrap">
                        <div class="accordion" id="accordionExample">

                            @foreach ($orders as $order)
                                <div class="card single-accordion mb-3">
                                    <div class="card-header" id="heading{{ $order->id }}">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link" type="button" data-toggle="collapse"
                                                data-target="#collapse{{ $order->id }}" aria-expanded="false"
                                                aria-controls="collapse{{ $order->id }}">
                                                Order #{{ $order->id }} — {{ $order->created_at->format('Y-m-d') }}
                                            </button>
                                        </h5>
                                    </div>

                                    <div id="collapse{{ $order->id }}" class="collapse"
                                        aria-labelledby="heading{{ $order->id }}" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="billing-address-form mb-4">
                                                <form>
                                                    @csrf
                                                    <p><input type="text" value="{{ $order->name }}" readonly></p>
                                                    <p><input type="email" value="{{ $order->email }}" readonly></p>
                                                    <p><input type="text" value="{{ $order->address }}" readonly></p>
                                                    <p><input type="tel" value="{{ $order->phone }}" readonly></p>
                                                    <p>
                                                        <textarea readonly cols="30" rows="3">{{ $order->note }}</textarea>
                                                    </p>
                                                </form>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-8 col-md-12">
                                                    <div class="cart-table-wrap">
                                                        <table class="cart-table">
                                                            <thead class="cart-table-head">
                                                                <tr class="table-head-row">
                                                                    <th class="product-image">Product Image</th>
                                                                    <th class="product-name">Name</th>
                                                                    <th class="product-price">Price</th>
                                                                    <th class="product-amount">Amount</th>
                                                                    <th class="product-total">Total</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($order->orderdetails as $detail)
                                                                    <tr class="table-body-row">
                                                                        <td class="product-image">
                                                                            <img src="{{ asset($detail->product->imagepath) }}"
                                                                                alt="{{ $detail->product->name }}">
                                                                        </td>
                                                                        <td class="product-name">
                                                                            <a
                                                                                href="/single-product/{{ $detail->product->id }}">
                                                                                {{ $detail->product->name }}
                                                                            </a>
                                                                        </td>
                                                                        <td class="product-price">
                                                                            {{ $detail->product->price }}$
                                                                        </td>
                                                                        <td class="product-amount">
                                                                            {{ $detail->amount }}
                                                                        </td>
                                                                        <td class="product-total">
                                                                            {{ $detail->product->price * $detail->amount }}$
                                                                        </td>
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
                                                                        {{ $order->orderdetails->sum(function ($detail) {
                                                                            return $detail->product->price * $detail->amount;
                                                                        }) }}$
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection



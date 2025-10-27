@extends('layouts.shared')


@section('content')

    <div class="product-section mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="section-title">
                        <h3><span class="orange-text">Add</span> Products</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 mb-5 mb-lg-0">
                    <div id="form_status"></div>
                    <div class="contact-form">
                        <form method="post" enctype="multipart/form-data" action="/storeproduct">
                            @csrf
                            <p>
                                <input type="text" required  style="width: 100%" placeholder="Name" name="name"
                                    id="name" value="{{old('name')}}">
                                <span class="text-danger">
                                    @error('name')
                                      {{$message}}
                                    @enderror
                                </span>
                            </p>
                            <p style="display: flex;">
                                <input type="number" required class="mr-4" value="{{old('price')}}" style="width: 50%" placeholder="Price"
                                    name="price" id="price">
                                    <span class="text-danger">
                                    @error('price')
                                      {{$message}}
                                    @enderror
                                </span>
                                <input type="number" required style="width: 50%" value="{{old('amount')}}" placeholder="Amount" name="amount"
                                    id="amount">
                                    <span class="text-danger">
                                    @error('amount')
                                      {{$message}}
                                    @enderror
                                </span>
                            </p>
                            <p>
                                <textarea name="description" required {{old('description')}} id="description" cols="30" rows="10" placeholder="Description"></textarea>
                                <span class="text-danger">
                                    @error('description')
                                      {{$message}}
                                    @enderror
                                </span>
                            </p>
                            <p>
                                <select class="form-control" required name="category_id" id="category_id">
                                    @foreach ($allcate as $item)
                                        <option value="{{$item-> id}}">{{$item -> name}}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger">
                                    @error('category_id')
                                      {{$message}}
                                    @enderror
                                </span>
                            </p>  
                            
                            <p>
                                <input type="file" name="photo" class="form-control" id="photo" >
                                <span class="text-danger">
                                    @error('photo')
                                      {{$message}}
                                    @enderror
                                </span>
                            </p>
                           
                            <p><input type="submit" value="Submit"></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

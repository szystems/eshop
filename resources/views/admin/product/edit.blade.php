@extends('layouts.admin')

@section('content')
    <div class="row">

        <div class="col-xl-12 col-sm-12 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-header p-3 pt-2">
                    <div
                        class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                        <i class="material-icons opacity-10">sell</i>
                    </div>
                    <div class="text-center pt-1">
                        {{-- <p class="text-sm mb-0 text-capitalize">Today's Money</p> --}}
                        <h4 class="mb-0">Products</h4>
                    </div>
                    <hr class="dark horizontal my-0">
                </div>
                <div class="card-body p-3 pt-2">
                    <h4><u>Edit Product</u></h4>
                    @if (count($errors)>0)
                        <div class="alert alert-danger text-white" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                      <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>

                    @endif
                    <form action="{{ url('update-product/'.$product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="">Category</label>
                                <select class="form-select px-2" aria-label="Default select example" name="cate_id">
                                    <option selected value="{{ $product->category->id }}">{{ $product->category->name }}</option>
                                    @foreach ($categories as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('cate_id'))
                                    <span class="help-block opacity-7">
                                            <strong>
                                                <font color="Red">{{ $errors->first('cate_id') }}</font>
                                            </strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="">Code</label>
                                <input type="text" class="form-control border px-2 " name="code" value="{{ $product->code }}" >
                                @if ($errors->has('code'))
                                    <span class="help-block opacity-7">
                                            <strong>
                                                <font color="red">{{ $errors->first('code') }}</font>
                                            </strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="">Name</label>
                                <input type="text" class="form-control border px-2 " name="name" value="{{ $product->name }}" >
                                @if ($errors->has('name'))
                                    <span class="help-block opacity-7">
                                            <strong>
                                                <font color="red">{{ $errors->first('name') }}</font>
                                            </strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="">Small Description</label>
                                <textarea name="small_description" cols="30" rows="5" class="form-control border px-2 " >{{ $product->small_description }}</textarea>
                                @if ($errors->has('small_description'))
                                    <span class="help-block opacity-7">
                                            <strong>
                                                <font color="Red">{{ $errors->first('small_description') }}</font>
                                            </strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Description</label>
                                <textarea name="description" cols="30" rows="5" class="form-control border px-2 " >{{ $product->description }}</textarea>
                                @if ($errors->has('description'))
                                    <span class="help-block opacity-7">
                                            <strong>
                                                <font color="Red">{{ $errors->first('description') }}</font>
                                            </strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="">Price</label>
                                <div class="input-group input-group-dynamic mb-4">
                                    <span class="input-group-text">{{ $config->currency_simbol }}</span>
                                    <input type="number" class="form-control" aria-label="Amount (to the nearest dollar)" name="original_price" value="{{ $product->original_price }}">
                                </div>
                                @if ($errors->has('original_price'))
                                    <span class="help-block opacity-7">
                                            <strong>
                                                <font color="red">{{ $errors->first('original_price') }}</font>
                                            </strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="">Discount Price</label>
                                <div class="input-group input-group-dynamic mb-4">
                                    <span class="input-group-text">{{ $config->currency_simbol }}</span>
                                    <input type="number" class="form-control" aria-label="Amount (to the nearest dollar)" name="selling_price" value="{{ $product->selling_price }}">
                                </div>
                                @if ($errors->has('selling_price'))
                                    <span class="help-block opacity-7">
                                            <strong>
                                                <font color="red">{{ $errors->first('selling_price') }}</font>
                                            </strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="">Stock</label>
                                <input type="number" class="form-control border px-2 " name="qty" value="{{ $product->qty }}" >
                                @if ($errors->has('qty'))
                                    <span class="help-block opacity-7">
                                            <strong>
                                                <font color="red">{{ $errors->first('qty') }}</font>
                                            </strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="status" {{ $product->status == 1 ? 'checked':'' }}>
                                    <label class="form-check-label" for="flexSwitchCheckDefault">Status</label>
                                </div>
                                <label><font color="orange">Enable in store</font></label>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="trending" {{ $product->trending == 1 ? 'checked':'' }}>
                                    <label class="form-check-label" for="flexSwitchCheckDefault">Trending</label>
                                </div>
                                <label><font color="orange">Enable to trending</font></label>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="discount" {{ $product->discount == 1 ? 'checked':'' }}>
                                    <label class="form-check-label" for="flexSwitchCheckDefault">Discount</label>
                                </div>
                                <label><font color="orange">Enable discount</font></label>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="">Meta Title</label>
                                <input type="text" class="form-control border px-2" name="meta_title" value="{{ $product->meta_title }}" >
                                @if ($errors->has('meta_title'))
                                    <span class="help-block opacity-7">
                                            <strong>
                                                <font color="Red">{{ $errors->first('meta_title') }}</font>
                                            </strong>
                                    </span>
                                @endif
                            </div>
                            @if ($product->image)
                            <div class="col-md-12 mb-3">
                                <img class="border-radius-md w-25" src="{{ asset('assets/uploads/product/'.$product->image) }}" alt="Product Image">
                            </div>
                            @endif
                            <div class="col-md-12 mb-3">
                                <label for="">Cambiar Imagen</label>
                                <input type="file" name="image" class="form-control border">
                            </div>
                            <div class="col-md-12 mb-3" >
                                <button type="submit" class="btn btn-success"><i class="material-icons">save</i> Save</button>
                            </div>
                        </div>
                    </form>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                    {{-- <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+55% </span>than last week</p> --}}
                </div>
            </div>
        </div>

    </div>

@endsection

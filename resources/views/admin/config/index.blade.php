@extends('layouts.admin')

@section('content')
    <div class="row">

        <div class="col-xl-12 col-sm-12 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-header p-3 pt-2">
                    <div
                        class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                        <i class="material-icons opacity-10">settings</i>
                    </div>
                    <div class="text-center pt-1">
                        {{-- <p class="text-sm mb-0 text-capitalize">Today's Money</p> --}}
                        <h4 class="mb-0">Settings</h4>
                    </div>
                    <hr class="dark horizontal my-0">
                </div>
                <div class="card-body p-3 pt-2">
                    <h4><u>E-Shop Settings</u></h4>
                    <!-- .flash-message -->
                    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                        @if(Session::has('alert-' . $msg))
                            <div class="alert alert-{{ $msg }} alert-dismissible text-white fade show" role="alert">
                                <span class="alert-text"><strong>Success!</strong> {{ Session::get('alert-' . $msg) }}</span>
                                <span class="alert-icon align-middle">
                                    <span class="material-icons text-md">
                                    thumb_up_off_alt
                                    </span>
                                </span>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                     @endforeach
                    <!-- fin .flash-message -->
                    <form action="{{ url('update-config')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">

                            <div class="col-md-3 mb-3">
                                <label for="">Currency</label>
                                <select class="form-select px-2" aria-label="Default select example" name="currency">
                                    <option selected value="{{ $config->currency }}">{{ $config->currency }}</option>
                                    <option value="USD $">USD ($)</option>
                                    <option value="GTQ Q">GTQ (Q)</option>
                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="paypal" {{ $config->paypal == 1 ? 'checked':'' }}>
                                    <label class="form-check-label" for="flexSwitchCheckDefault">PayPal Status</label>
                                    <h6><font color="orange">Deactivate/Activate PayPal payment.</font></h6>
                                </div>

                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="dbt" {{ $config->dbt == 1 ? 'checked':'' }}>
                                    <label class="form-check-label" for="flexSwitchCheckDefault">DBT Status</label>
                                </div>
                                <h6><font color="orange">Deactivate/Activate payment per Direct Bank Transfer</font></h6>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="tax_status" {{ $config->tax_status == 1 ? 'checked':'' }}>
                                        <label class="form-check-label" for="flexSwitchCheckDefault">Tax Status</label>
                                    </div>
                                </label>

                                <div class="input-group input-group-dynamic mb-4">
                                    <span class="input-group-text" id="basic-addon1">%</span>
                                    <input type="number" name="tax" class="form-control" placeholder="Example:12%" aria-describedby="basic-addon1" value="{{ $config->tax }}" required>
                                </div>
                                <h6><font color="orange">Deactivate/Activate tax and percentage</font></h6>
                                @if ($errors->has('tax'))
                                    <span class="help-block opacity-7">
                                            <strong>
                                                <font color="red">{{ $errors->first('tax') }}</font>
                                            </strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="">Shipping Description</label>
                                <textarea name="shipping_description" cols="30" rows="5" class="form-control border px-2 ">{{ $config->shipping_description }}</textarea>
                                @if ($errors->has('shipping_description'))
                                    <span class="help-block opacity-7">
                                            <strong>
                                                <font color="red">{{ $errors->first('shipping_description') }}</font>
                                            </strong>
                                    </span>
                                @endif
                            </div>

                            @if ($config->logo)
                            <div class="col-md-12 mb-3">
                                <img class="border-radius-md w-25" src="{{ asset('assets/uploads/logos/'.$config->logo) }}" alt="Logo Image">
                            </div>
                            @endif
                            <div class="col-md-12 mb-3">
                                <label for="">Change image</label>
                                <input type="file" name="logo" class="form-control border">
                            </div>
                            <div class="col-md-12 mb-3" >
                                <button type="submit" class="btn btn-primary">Save</button>
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

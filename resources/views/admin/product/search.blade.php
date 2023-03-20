
                <form action="{{ url('products') }}" method="GET">
                    @csrf
                    <div class="row">

                        <div class="col-md-12 mb-0">
                            <label for=""><strong>Filter by:</strong></label>

                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="">Product Name/Code </label>
                            {{-- <select class="form-select px-2" aria-label="Default select example" name="fproduct"> --}}
                            <input class="form-select px-2" list="productListOptions" placeholder="Search Product by name/code" name="fproduct" value="{{ $queryProduct }}">
                            <datalist id="productListOptions">
                                <option value="">All</option>
                                @if ($queryProduct != null)
                                    <option selected value="{{ $queryProduct }}" >{{ $queryProduct }}</option>
                                @endif
                                @foreach ($filterProducts as $item)
                                    <option value="{{ $item->name }}">{{ $item->name }} / {{ $item->code }}</option>
                                @endforeach
                            </datalist>
                            {{-- </select> --}}
                        </div>
                        <div class="col-md-2 mb-3">
                            <label for="">Category</label>
                            <select class="form-select px-2" aria-label="Default select example" name="fcategory">
                                <option value="">All</option>
                                @if ($queryCategory != null)
                                    <option selected value="{{ $queryCategory }}" >{{ $queryCategory }}</option>
                                @endif
                                @foreach ($filterCategories as $item)
                                    <option value="{{ $item->name }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label for="">Stock</label>
                            <select class="form-select px-2" aria-label="Default select example" name="fstock">
                                <option value=">=">All</option>
                                @if ($queryStock != '>=')
                                    @if ($queryStock == '<=')
                                        <option selected value="<=">Out of stock</option>
                                    @else
                                        <option selected value=">" >With stock</option>
                                    @endif
                                @endif
                                <option value="<=">Out of stock</option>
                                <option value=">">With stock</option>
                            </select>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label for="">Status</label>
                            <select class="form-select px-2" aria-label="Default select example" name="fstatus">
                                <option value="">All</option>
                                @if ($queryStatus != null)
                                    @if ($queryStatus == '0')
                                        <option selected value="0">Disabled</option>
                                    @else
                                        <option selected value="1">Enabled</option>
                                    @endif
                                @endif
                                <option value="0">Disabled</option>
                                <option value="1">Enabled</option>
                            </select>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label for="">Trending</label>
                            <select class="form-select px-2" aria-label="Default select example" name="ftrending">
                                <option value="">All</option>
                                @if ($queryTrending != null)
                                    @if ($queryTrending == '0')
                                        <option selected value="0">Disabled</option>
                                    @else
                                        <option selected value="1">Enabled</option>
                                    @endif
                                @endif
                                <option value="0">Disabled</option>
                                <option value="1">Enabled</option>
                            </select>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label for="">Discount</label>
                            <select class="form-select px-2" aria-label="Default select example" name="fdiscount">
                                <option value="">All</option>
                                @if ($queryDiscount != null)
                                    @if ($queryDiscount == '0')
                                        <option selected value="0">Disabled</option>
                                    @else
                                        <option selected value="1">Enabled</option>
                                    @endif
                                @endif
                                <option value="0">Disabled</option>
                                <option value="1">Enabled</option>
                            </select>
                        </div>
                        <div class="col-md-2 mb-3" >
                            <button type="submit" class="btn btn-info m-1 p-4 w-100 float-right b-3"><i class="material-icons">filter_list</i>filter</button>
                        </div>
                    </div>
                </form>


                <form action="{{ url('categories') }}" method="GET">
                    @csrf
                    <div class="row">

                        <div class="col-md-12 mb-0">
                            <label for=""><strong>Search Category:</strong></label>

                        </div>
                        <div class="col-md-6 mb-3">

                            <input class="form-select px-2" list="categoryListOptions" placeholder="Search..." name="fcategory" value="{{ $queryCategory }}">
                            <datalist id="categoryListOptions">
                                <option value="">All</option>
                                @if ($queryCategory != null)
                                    <option selected value="{{ $queryCategory }}" >{{ $queryCategory }}</option>
                                @endif
                                @foreach ($filterCategories as $item)
                                    <option value="{{ $item->name }}">{{ $item->name }}</option>
                                @endforeach
                            </datalist>
                            {{-- </select> --}}
                        </div>
                        <div class="col-md-2 mb-3" >
                            <button type="submit" class="btn btn-info"><i class="material-icons">search</i> Search</button>
                        </div>
                    </div>
                </form>

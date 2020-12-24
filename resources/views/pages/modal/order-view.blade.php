@section('modal-content')
<form method="post" id="user_form" class="form-horizontal">
    @csrf

    <div class="modal-body">

        <div class="row">
            @if (Auth::user()->type == 'admin' || Auth::user()->type == 'seller')
            <div class="col-md-6">
                <div class="form-group">
                    <label for="customer_email">Customer Email</label>
                    <div class="input-group">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-genderless"></span>
                            </div>
                        </div>

                        <input type="text" id="customer_email" name="customer_email" placeholder=""
                            class="form-control " disabled />
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="customer_name">Customer name</label>
                    <div class="input-group">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-genderless"></span>
                            </div>
                        </div>

                        <input type="text" id="customer_name" name="customer_name" placeholder="" class="form-control "
                            disabled />
                    </div>
                </div>
            </div>

            @endif
            @if (Auth::user()->type == 'admin' || Auth::user()->type == 'user')

            <div class="col-md-6">
                <div class="form-group">
                    <label for="owner_name">Owner Name</label>
                    <div class="input-group">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-genderless"></span>
                            </div>
                        </div>

                        <input type="text" id="owner_name" name="owner_name" placeholder="" class="form-control "
                            disabled />
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="owner_email">Owner Email</label>
                    <div class="input-group">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-genderless"></span>
                            </div>
                        </div>

                        <input type="text" id="owner_email" name="owner_email" placeholder="" class="form-control "
                            disabled />
                    </div>
                </div>
            </div>
            @endif

            <div class="col-md-4">
                <div class="form-group">
                    <label for="price">Price</label>
                    <div class="input-group">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-genderless"></span>
                            </div>
                        </div>

                        <input type="text" id="price" disabled class="form-control " />

                    </div>


                    <span class="invalid-feedback d-block" role="alert">
                        <strong id="error_price"></strong>
                    </span>

                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="propose_price">Propose Price</label>
                    <div class="input-group">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-genderless"></span>
                            </div>
                        </div>

                        <input type="text" id="propose_price" class="form-control " disabled />

                    </div>


                    <span class="invalid-feedback d-block" role="alert">
                        <strong id="error_price"></strong>
                    </span>

                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="balance">Diferrence<span></label>
                    <div class="input-group">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-genderless"></span>
                            </div>
                        </div>
                        <input type="number" id="balance" disabled placeholder="Max price" class="form-control " />

                    </div>


                    <span class="invalid-feedback d-block" role="alert">
                        <strong id="error_max_price"></strong>
                    </span>

                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="brand">Brand, Modl, Type, year</label>
                    <div class="input-group">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-genderless"></span>
                            </div>
                        </div>

                        <select id="brand" disabled class="form-control ">
                            <option value="">Select your brand</option>
                            <option value="other">Other</option>
                            @foreach ($car_brand as $brand)
                            <option value="{{$brand->id}}">
                                {{$brand->brand}}, {{$brand->model}},
                                {{$brand->vehicle_type}}, {{$brand->year}}
                            </option>
                            @endforeach
                        </select>
                    </div>


                    <span class="invalid-feedback d-block" role="alert">
                        <strong id="error_brand"></strong>
                    </span>

                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="vehicle_registration">Vehicle registration</label>
                    <div class="input-group">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        <input type="text" id="vehicle_registration" disabled placeholder="Vehicle registration"
                            class="form-control " />
                    </div>

                    <span class="invalid-feedback d-block" role="alert">
                        <strong id="error_vehicle_registration"></strong>
                    </span>

                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="Vehicle_identification_number">Vehicle identification number</label>
                    <div class="input-group">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        <input type="text" id="Vehicle_identification_number" disabled
                            placeholder="Vehicle identification number" class="form-control " />
                    </div>

                    <span class="invalid-feedback d-block" role="alert">
                        <strong id="error_Vehicle_identification_number"></strong>
                    </span>

                </div>
            </div>




            <div class="col-md-6">
                <div class="form-group">
                    <label for="status">Status</label>
                    <div class="input-group">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-genderless"></span>
                            </div>
                        </div>

                        <select id="status" name="status" class="form-control ">
                            <option value="">Select Status</option>
                            <option value="sold">For Sold</option>
                            <option value="rental">For Rent</option>
                            <option value="remove">Remove</option>
                            <option value="in stock">In stock</option>
                            <option value="buy">Buy</option>

                        </select>
                    </div>


                    <span class="invalid-feedback d-block" role="alert">
                        <strong id="error_status"></strong>
                    </span>

                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="country">Country</label>
                    <div class="input-group">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-genderless"></span>
                            </div>
                        </div>

                        <select id="country" disabled class="form-control ">
                            <option value="">Select your country</option>
                            @foreach ($countries as $country)
                            <option value="{{$country->id}}">
                                {{$country->name}}

                            </option>
                            @endforeach
                        </select>
                    </div>


                    <span class="invalid-feedback d-block" role="alert">
                        <strong id="error_country"></strong>
                    </span>

                </div>
            </div>




            <div class="col-md-6">
                <div class="form-group">
                    <label for="state_or_province">State / Province</label>
                    <div class="input-group">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        <input type="text" id="state_or_province" disabled placeholder="state or province"
                            class="form-control " />
                    </div>

                    <span class="invalid-feedback d-block" role="alert">
                        <strong id="error_state_or_province"></strong>
                    </span>

                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="city">City</label>
                    <div class="input-group">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        <input type="text" id="city" disabled placeholder="City" class="form-control " />
                    </div>

                    <span class="invalid-feedback d-block" role="alert">
                        <strong id="error_city"></strong>
                    </span>

                </div>
            </div>




        </div>

    </div>
    <div class="modal-footer">

        <input type="hidden" name="action" id="action" value="" />
        <input type="hidden" name="hidden_id" id="hidden_id" />

        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i>
            Close</button>
        <button type="submit" class="btn btn-outline-orange" id="submit"><i class="fas fa-save "></i> <span
                id="action_button">
                changes</span>
        </button>

    </div>

</form>
@endsection

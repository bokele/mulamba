@section('modal-content')
<form method="post" id="user_form" class="form-horizontal">
    @csrf

    <div class="modal-body">

        <div class="row">

            <div class="col-md-3">
                <div class="form-group">
                    <label for="current_status_of_registraion">registed</label>
                    <div class="input-group">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-genderless"></span>
                            </div>
                        </div>

                        <select id="current_status_of_registraion" name="current_status_of_registraion"
                            class="form-control ">
                            <option value="">Select Status</option>
                            <option value="yes">Yes</option>
                            <option value="non">Non</option>
                        </select>
                    </div>


                    <span class="invalid-feedback d-block" role="alert">
                        <strong id="error_current_status_of_registraion"></strong>
                    </span>

                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="price">Price</label>
                    <div class="input-group">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-genderless"></span>
                            </div>
                        </div>

                        <input type="text" id="price" name="price" class="form-control " />

                    </div>


                    <span class="invalid-feedback d-block" role="alert">
                        <strong id="error_price"></strong>
                    </span>

                </div>
            </div>
            <div class="col-md-5">
                <div class="form-group">
                    <label for="color">Color</label>
                    <div class="input-group">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        <input type="color" id="color" name="color" class="form-control " />
                    </div>

                    <span class="invalid-feedback d-block" role="alert">
                        <strong id="error_color"></strong>
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

                        {{-- <select id="brand" name="brand" class="form-control ">
                            <option value="">Select your brand</option>
                            <option value="other">Other</option>
                            @foreach ($car_brand as $brand)
                            <option value="{{$brand->id}}">
                        {{$brand->brand}}, {{$brand->model}},
                        {{$brand->vehicle_type}}, {{$brand->year}}
                        </option>
                        @endforeach
                        </select> --}}
                        <select class="car_model" id="brand" name="brand"></select>

                    </div>


                    <span class="invalid-feedback d-block" role="alert">
                        <strong id="error_brand"></strong>
                    </span>

                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="vehicle_fuel_type">Type of fuel</label>
                    <div class="input-group">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        <select id="vehicle_fuel_type" name="vehicle_fuel_type" class="form-control ">
                            <option value="">Select vehicle fuel type</option>
                            <option value="electric">Electric</option>
                            <option value="petrol">Petrol</option>
                            <option value="diesel">diesel</option>
                            <option value="hybrid">Hybrid</option>
                            <option value="hybrid">Hybrid</option>
                            <option value="gas">Gas</option>
                        </select>
                    </div>

                    <span class="invalid-feedback d-block" role="alert">
                        <strong id="error_vehicle_fuel_type"></strong>
                    </span>

                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="vehicle_door_count">Number of door</label>
                    <div class="input-group">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-genderless"></span>
                            </div>
                        </div>

                        <select id="vehicle_door_count" name="vehicle_door_count" class="form-control ">
                            <option value="">Select number of door</option>
                            @for ($i = 1; $i <= 10; $i++) <option value="{{$i}}">{{$i}}</option>
                                @endfor


                        </select>
                    </div>


                    <span class="invalid-feedback d-block" role="alert">
                        <strong id="error_vehicle_door_count"></strong>
                    </span>

                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="vehicle_seat_count">Number of seat</label>
                    <div class="input-group">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-genderless"></span>
                            </div>
                        </div>

                        <select id="vehicle_seat_count" name="vehicle_seat_count" class="form-control ">
                            <option value="">Select number of seat</option>
                            @for ($i = 1; $i <= 50; $i++) <option value="{{$i}}">{{$i}}</option>
                                @endfor


                        </select>
                    </div>


                    <span class="invalid-feedback d-block" role="alert">
                        <strong id="gender"></strong>
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
                        <input type="text" id="vehicle_registration" name="vehicle_registration"
                            placeholder="Vehicle registration" class="form-control " />
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
                        <input type="text" id="Vehicle_identification_number" name="Vehicle_identification_number"
                            placeholder="Vehicle identification number" class="form-control " />
                    </div>

                    <span class="invalid-feedback d-block" role="alert">
                        <strong id="error_Vehicle_identification_number"></strong>
                    </span>

                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="mileage">Mileage</label>
                    <div class="input-group">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        <input type="text" id="mileage" name="mileage" placeholder="Mileage" class="form-control " />
                    </div>

                    <span class="invalid-feedback d-block" role="alert">
                        <strong id="error_mileage"></strong>
                    </span>

                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="vehicle_gear_box_type">Gear Box</label>
                    <div class="input-group">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        <select id="vehicle_gear_box_type" name="vehicle_gear_box_type" class="form-control ">
                            <option value="">Select your gear box type</option>
                            <option value="other">Other</option>
                            @foreach ($gear_boxes as $gear_box)
                            <option value="{{$gear_box->name}}">
                                {{$gear_box->name}}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <span class="invalid-feedback d-block" role="alert">
                        <strong id="error_vehicle_gear_box_type"></strong>
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
                            <option value="sale">For sale</option>
                            <option value="rent">For Rent</option>


                        </select>
                    </div>


                    <span class="invalid-feedback d-block" role="alert">
                        <strong id="error_status"></strong>
                    </span>

                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="color">Description</label>


                    <textarea id="description_of_feature" name="description_of_feature"
                        placeholder="Description of feature" class="form-control "></textarea>


                    <span class="invalid-feedback d-block" role="alert">
                        <strong id="error_description_of_feature"></strong>
                    </span>

                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="country_name">Country</label>
                    <div class="input-group">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        <select id="country_name" name="country_name" class="form-control ">
                            <option value="">Select your country</option>

                            @foreach ($countries as $country)
                            <option value="{{$country->id}}">
                                {{$country->name}}
                            </option>
                            @endforeach
                        </select>

                    </div>

                    <span class="invalid-feedback d-block" role="alert">
                        <strong id="error_country_name"></strong>
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
                        <input type="text" id="state_or_province" name="state_or_province"
                            placeholder="state or province" class="form-control " />
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
                        <input type="text" id="city" name="city" placeholder="City" class="form-control " />
                    </div>

                    <span class="invalid-feedback d-block" role="alert">
                        <strong id="error_city"></strong>
                    </span>

                </div>
            </div>
        </div>

    </div>
    <div class="modal-footer">
        <input type="hidden" name="action" id="action" value="Add" />
        <input type="hidden" name="hidden_id" id="hidden_id" />
        <input type="hidden" name="hidden_address_id" id="hidden_address_id" />
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i>
            Close</button>
        <button type="submit" class="btn btn-outline-orange"><i class="fas fa-save "></i> <span id="action_button">
                changes</span>
        </button>
    </div>

</form>
@endsection

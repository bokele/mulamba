<form method="post" id="car_model_form" enctype="multipart/form-data">
    @csrf
    <div class="modal-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="brand">Brand:</label>
                    <div class="input-group">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-genderless"></span>
                            </div>
                        </div>
                        <input type="text" class="form-control" id="brand" name="brand" placeholder="Car brand">
                    </div>
                </div>
                <span class="invalid-feedback d-block" role="alert">
                    <strong id="error_brand"></strong>
                </span>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="model">Brand:</label>
                    <div class="input-group">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-genderless"></span>
                            </div>
                        </div>
                        <input type="text" class="form-control" id="model" name="model" placeholder="Car model">
                    </div>
                </div>
                <span class="invalid-feedback d-block" role="alert">
                    <strong id="error_model"></strong>
                </span>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="vehicle_type">Type:</label>
                    <div class="input-group">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-genderless"></span>
                            </div>
                        </div>
                        <input type="text" class="form-control" id="vehicle_type" name="vehicle_type"
                            placeholder="Car type">
                    </div>
                </div>
                <span class="invalid-feedback d-block" role="alert">
                    <strong id="error_vehicle_type"></strong>
                </span>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="year">Year:</label>
                    <div class="input-group">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-genderless"></span>
                            </div>
                        </div>

                        <select name="year" id="year" class="form-control">
                            <option value="">Select year</option>
                            @for ($i = 1920; $i <= date('Y'); $i++) <option value="{{$i}}">{{$i}}</option>

                                @endfor
                        </select>
                    </div>
                </div> <span class="invalid-feedback d-block" role="alert">
                    <strong id="error_year"></strong>
                </span>
            </div>







        </div>
    </div>

    <div class="modal-footer">
        <input type="hidden" name="action" id="action" value="Add" />
        <input type="hidden" name="hidden_id" id="hidden_id" />

        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i>
            Close</button>

        </button>
        <button type="submit" class="btn btn-outline-orange"><i class="fas fa-save "></i> <span
                id="action_button_attachment">
                changes</span>
        </button>
    </div>
</form>

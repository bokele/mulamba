<div class="modal fade" id="attachmnent" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
    data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><span id="modal-icon"></span> title
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="attachment_form" class="form-horizontal" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="white_book">White Book</label>
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-user"></span>
                                        </div>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input inv" id="white_book"
                                            name="white_book">
                                        <label class="custom-file-label" for="white_book">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            <span class="invalid-feedback d-block" role="alert">
                                <strong id="error_white_book"></strong>
                            </span>
                        </div>


                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="cover_image">Cover Image</label>
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-user"></span>
                                        </div>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="cover_image"
                                            name="cover_image">
                                        <label class="custom-file-label" for="cover_image">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            <span class="invalid-feedback d-block" role="alert">
                                <strong id="error_cover_image"></strong>
                            </span>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="front_car_image">Front Car Image</label>
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-user"></span>
                                        </div>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="front_car_image"
                                            name="front_car_image">
                                        <label class="custom-file-label" for="front_car_image">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            <span class="invalid-feedback d-block" role="alert">
                                <strong id="error_front_car_image"></strong>
                            </span>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="car_left_side">Car left side</label>
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-user"></span>
                                        </div>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="car_left_side"
                                            name="car_left_side">
                                        <label class="custom-file-label" for="car_left_side">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            <span class="invalid-feedback d-block" role="alert">
                                <strong id="error_car_left_side"></strong>
                            </span>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="car_right_side">Car Ringht side</label>
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-user"></span>
                                        </div>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="car_right_side"
                                            name="car_right_side">
                                        <label class="custom-file-label" for="car_right_side">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            <span class="invalid-feedback d-block" role="alert">
                                <strong id="error_car_right_side"></strong>
                            </span>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="car_behind_image">Car behind Image </label>
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-user"></span>
                                        </div>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="car_behind_image"
                                            name="car_behind_image">
                                        <label class="custom-file-label" for="car_behind_image">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            <span class="invalid-feedback d-block" role="alert">
                                <strong id="error_car_behind_image"></strong>
                            </span>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="dashbooard_image">Dashboard Image</label>
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-user"></span>
                                        </div>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="dashbooard_image"
                                            name="dashbooard_image">
                                        <label class="custom-file-label" for="dashbooard_image">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            <span class="invalid-feedback d-block" role="alert">
                                <strong id="error_dashbooard_image"></strong>
                            </span>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="inside_image">Inside image</label>
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-user"></span>
                                        </div>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="inside_image"
                                            name="inside_image" data-browse-on-zone-click="true">
                                        <label class="custom-file-label" for="inside_image">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            <span class="invalid-feedback d-block" role="alert">
                                <strong id="error_inside_image"></strong>
                            </span>
                        </div>

                    </div>


                </div>
                <div class="modal-footer">
                    <input type="hidden" name="action" id="action" value="Add" />
                    <input type="hidden" name="car_id" id="car_id" />
                    <input type="hidden" name="current_status_of_registraion" id="current_status_of_registraion" />

                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"
                            aria-hidden="true"></i>
                        Close</button>
                    <button type="submit" class="btn btn-outline-orange"><i class="fas fa-save "></i> <span
                            id="action_button_attachment">
                            changes</span>
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>

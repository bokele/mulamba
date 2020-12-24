<form method="post" id="user_form" class="form-horizontal">
    @csrf

    <div class="modal-body">

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="full_name">Full Name</label>
                    <div class="input-group">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                        <input type="text" name="user_full_name" placeholder="Full name" id="user_full_name"
                            class="form-control" />
                    </div>

                    <span class="invalid-feedback d-block" role="alert">
                        <strong id="full_name"></strong>
                    </span>

                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="user_email">Email Address</label>
                    <div class="input-group">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        <input type="email" id="user_email" name="user_email" placeholder="Email Address"
                            class="form-control " />
                    </div>

                    <span class="invalid-feedback d-block" role="alert">
                        <strong id="email"></strong>
                    </span>

                </div>
            </div>


            <div class="col-md-6">
                <div class="form-group">
                    <label for="user_gender">Gender</label>
                    <div class="input-group">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-genderless"></span>
                            </div>
                        </div>

                        <select id="user_gender" name="user_gender" class="form-control ">
                            <option value="">Select your gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>


                    <span class="invalid-feedback d-block" role="alert">
                        <strong id="gender"></strong>
                    </span>

                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="user_status">Status</label>
                    <div class="input-group">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-genderless"></span>
                            </div>
                        </div>

                        <select id="user_status" name="user_status" class="form-control ">
                            <option value="">Select Status</option>
                            <option value="active">Active</option>
                            <option value="desactive">Desactive</option>
                        </select>
                    </div>


                    <span class="invalid-feedback d-block" role="alert">
                        <strong id="status"></strong>
                    </span>

                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="type">Type</label>
                    <div class="input-group">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-genderless"></span>
                            </div>
                        </div>
                        <select name="type" id="type" class="form-control">
                            <option value>Select User Role</option>
                            <option value="admin">Admin</option>
                            <option value="saler">Saler</option>
                            <option value="user">User</option>
                        </select>

                        <span class="invalid-feedback d-block" role="alert">
                            <strong id="error_type"></strong>
                        </span>

                    </div>
                </div>
            </div>

        </div>

    </div>
    <div class="modal-footer">
        <input type="hidden" name="action" id="action" value="Add" />
        <input type="hidden" name="hidden_id" id="hidden_id" />
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i>
            Close</button>
        <button type="submit" class="btn btn-outline-orange"><i class="fas fa-save "></i> <span id="action_button">
                changes</span>
        </button>
    </div>

</form>
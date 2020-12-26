<form method="post" id="gear_box_form" enctype="multipart/form-data">
    @csrf
    <div class="modal-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">Plan Name:</label>
                    <div class="input-group">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-genderless"></span>
                            </div>
                        </div>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Plan Name">
                    </div>
                </div>
                <span class="invalid-feedback d-block" role="alert">
                    <strong id="error_name"></strong>
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

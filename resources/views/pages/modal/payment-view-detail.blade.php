<form method="post" id="user_form" class="form-horizontal">
    @csrf

    <div class="modal-body">

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="order_reference">Order Number</label>
                    <div class="input-group">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                        <input type="text" name="order_reference" placeholder="Full name" id="order_reference"
                            class="form-control" disabled />
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="payment_reference">Payment Number</label>
                    <div class="input-group">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        <input type="email" id="payment_reference" name="payment_reference" placeholder=""
                            class="form-control " disabled />
                    </div>

                </div>
            </div>



            <div class="col-md-6">
                <div class="form-group">
                    <label for="total_amount_paid">Paid amount<span></label>
                    <div class="input-group">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-genderless"></span>
                            </div>
                        </div>
                        <input type="text" id="total_amount_paid" name="total_amount_paid" placeholder=""
                            class="form-control " disabled />
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="max_price">Max price</label>
                    <div class="input-group">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-genderless"></span>
                            </div>
                        </div>

                        <input type="text" id="max_price" name="max_price" placeholder="" class="form-control "
                            disabled />
                    </div>
                </div>
            </div>
            @if (Auth::user()->type == 'admin')
            <div class="col-md-12">
                <div class="form-group">
                    <label for="stripe_code">Stripe Code</label>
                    <div class="input-group">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-genderless"></span>
                            </div>
                        </div>

                        <input type="text" id="stripe_code" name="stripe_code" placeholder="" class="form-control "
                            disabled />
                    </div>
                </div>
            </div>
            @endif

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
            <div class="col-md-6">
                <div class="form-group">
                    <label for="status">Status</label>
                    <div class="input-group">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-genderless"></span>
                            </div>
                        </div>

                        <select id="status" name="status" class="form-control " disabled>
                            <option value="">Select Status</option>
                            <option value="complete">Complete</option>
                            <option value="cancel">Cancel</option>
                            <option value="refund">Refund</option>


                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="method">Payment method</label>
                    <div class="input-group">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-genderless"></span>
                            </div>
                        </div>

                        <input type="text" id="method" name="method" placeholder="" class="form-control " disabled />
                    </div>
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

        </button>
    </div>

</form>

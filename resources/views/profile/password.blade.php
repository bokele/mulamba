<form action="{{ route('user.profile.password') }}" method="post" class="form-horizontal" id="changePasswordForm">
    @csrf
    <fieldset>
        <legend>Change your passwordd</legend>

        <div class="changePasswordMessages"></div>

        <div class="form-group">
            <label for="password" class="col-sm-4 control-label">Current password
            </label>
            <div class="col-sm-10">
                <input type="password" class="form-control @error('old_password') is-invalid @enderror"
                    id="old_password" name="old_password" placeholder="Current password">
                @error('old_password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="npassword" class="col-sm-4 control-label">New Password</label>
            <div class="col-sm-10">
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                    name="password" placeholder="New Password">
                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="password_confirmation" class="col-sm-4 control-label">Confirm
                Password</label>
            <div class="col-sm-10">
                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                    id="password_confirmation" name="password_confirmation" placeholder="Confirm Password" />
                @error('password_confirmation')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class=" form-group">
            <div class="col-sm-10">
                <input type="hidden" name="user_id" id="user_id" value="" />
                <button type="submit" class="btn btn-primary"> <i class="icofont-save"></i>
                    Enregistre</button>

            </div>
        </div>


    </fieldset>
</form>

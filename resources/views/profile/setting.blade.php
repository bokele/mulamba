<form action="{{ route('user.profile.general.setting') }}" method="post" class="form-horizontal"
    id="changePasswordForm">
    @csrf
    <fieldset>
        <legend>Change your information</legend>

        <div class="changePasswordMessages"></div>

        <div class="form-group">
            <label for="email" class="col-sm-4 control-label">Email
            </label>
            <div class="col-sm-10">
                <input type="email" class="form-control" id="email" name="email" placeholder="Email"
                    value="{{Auth::user()->email}}">
            </div>
        </div>

        <div class="form-group">
            <label for="name" class="col-sm-4 control-label">Full Name</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="name" name="name" placeholder="Name"
                    value="{{Auth::user()->name}}">
            </div>
        </div>
        <div class="form-group">
            <label for="mobile_number" class="col-sm-4 control-label">Mobile Number</label>
            <div class="col-sm-10">
                <input type="phone" class="form-control" id="mobile_number" name="mobile_number"
                    value="{{ Auth::user()->mobile }}" placeholder="Mobile number" />
            </div>
        </div>

        <div class="form-group">
            <label for="date_of_birth" class="col-sm-4 control-label">Date of Birth</label>
            <div class="col-sm-10">
                <input type="date" class="form-control" id="date_of_birth" name="date_of_birth"
                    value="{{ Auth::user()->date_of_birth }}" placeholder="Date of Birth" />
            </div>
        </div>
        <div class="form-group">
            <label for="gender" class="col-sm-4 control-label">Gender</label>
            <div class="col-sm-10">
                <select class="form-control" id="gender" name="gender">
                    <option>Select your gender</option>
                    <option value="male" @if( Auth::user()->gender == 'male' ) selected
                        @endif>Male</option>
                    <option value="female" @if( Auth::user()->gender == 'female' ) selected
                        @endif>Female</option>
                </select>
            </div>
        </div>

        <div class=" form-group">
            <div class="col-sm-10">
                <input type="hidden" name="user_id" id="user_id" value="" />
                <button type="submit" class="btn btn-primary btn-block">
                    <i class="icofont-save"></i>
                    Save</button>

            </div>
        </div>


    </fieldset>
</form>

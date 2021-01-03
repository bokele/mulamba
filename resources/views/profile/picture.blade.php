<form class="form-horizontal" id="attachePhotoProfilForm" action="{{ route('user.profile.picture') }}" method="post"
    enctype="multipart/form-data">
    @csrf
    <fieldset>
        <legend>Profile picture</legend>
        <div id="phototProfil"><img id="preview_img" src="{{asset(Auth::user()->profile_photo_path)}}" class=""
                width="200" height="150" /></div>
        <div class="form-group">
            <label for="profile_image" class="col-sm-4 control-label">Photo du profil :
            </label>
            <div class="col-sm-7">
                <!-- the avatar markup -->
                <div class="form-group">
                    <input type="file" name="profil_picture"
                        class="custom-file-input @error('profil_picture') is-invalid @enderror" id="profile_image"
                        onchange="loadPreview(this);">
                    <label class="custom-file-label" for="customFile">Choose your profile
                        picture</label>
                    @error('profil_picture')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>


            </div>
        </div> <!-- /form-group-->

        <div class="modal-footer removeBrandFooter">
            <input type="hidden" name="user_id" id="user_id" value="" />
            <button type="submit" class="btn btn-primary btn-block" id="createPhotoBtn" data-loading-text="Loading..."
                autocomplete="off"> <i class="icofont-save"></i>
                Save</button>
        </div>
    </fieldset>

</form>

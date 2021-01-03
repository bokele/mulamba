<?php

namespace App\Http\Controllers;

use File;
use App\User;
use App\Order;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Hash;
use Laravolt\Avatar\Facade as Avatar;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()

    {

        // dd(\Route::current()->getName());
        if (\Route::current()->getName() == "admin.all.users") {

            return view('admin.users.list');
        } else if (\Route::current()->getName() == "admin.all.administative") {

            return view('admin.users.administrative');
        } else if (\Route::current()->getName() == "admin.all.customer") {

            return view('admin.users.customer');
        } else if (\Route::current()->getName() == "admin.all.saler") {

            return view('admin.users.saler');
        } else if (\Route::current()->getName() == "user.profile" || \Route::current()->getName() == "user.profile.change.password" || \Route::current()->getName() == "user.profile.change.picture") {

            $user = auth()->user();
            $user_id = $user->id;
            $userInfo = User::where('id', $user_id)->get();


            return view('profile.profile', ['userInfo' => $userInfo,]);
        }
    }


    public function getAllAdminstrative()
    {
        $data = User::where('type', '!=', 'user')->where('type', '!=', 'saler')->orderBy('id', 'desc')->get();
        return DataTables::of($data)

            ->editColumn('created_at', function ($data) {


                return $data->created_at->diffForHumans();
            })
            ->addColumn('status', function ($data) {
                $status = '';
                if ($data->status == 'active') {
                    $status = '<span class="badge badge-success p-1">' . $data->status . '</span>';
                } else {
                    $status = '<span class="badge badge-danger p-1">' . $data->status . '</span>';
                }

                return $status;
            })


            ->addColumn('actions', function ($data) {
                $button = '

                        <button
                          type="button"
                            id="' . $data->id . '"
                          class="edit btn btn-warning btn-sm"
                          data-placement="top"
                          title="User Edit"
                          data-toggle="tooltip modal"
                        >
                          <i class="fa fa-edit blue"></i>
                        </button>

                        <button
                          type="button"
                          id="' . $data->id . '"
                            onclick=deleteUser(' .  $data->id . ')
                          class="btn btn-danger btn-sm"
                          data-placement="top"
                          title="User Delete"
                          data-toggle="tooltip modal"
                        >
                          <i class="fa fa-trash red"></i>
                        </button>
            ';
                return $button;
            })

            ->rawColumns(['status', 'actions'])
            ->make(true);
    }
    public function getAllCusomer()
    {
        $data = User::where('type', 'user')->orderBy('id', 'desc')->get();
        return DataTables::of($data)

            ->editColumn('created_at', function ($data) {


                return $data->created_at->diffForHumans();
            })
            ->addColumn('status', function ($data) {
                $status = '';
                if ($data->status == 'active') {
                    $status = '<span class="badge badge-success p-1">' . $data->status . '</span>';
                } else {
                    $status = '<span class="badge badge-danger p-1">' . $data->status . '</span>';
                }

                return $status;
            })


            ->addColumn('actions', function ($data) {
                $button = '

                        <button
                          type="button"
                            id="' . $data->id . '"
                          class="edit btn btn-warning btn-sm"
                          data-placement="top"
                          title="User Edit"
                          data-toggle="tooltip modal"
                        >
                          <i class="fa fa-edit blue"></i>
                        </button>

                        <button
                          type="button"
                          id="' . $data->id . '"
                            onclick=deleteUser(' .  $data->id . ')
                          class="btn btn-danger btn-sm"
                          data-placement="top"
                          title="User Delete"
                          data-toggle="tooltip modal"
                        >
                          <i class="fa fa-trash red"></i>
                        </button>
            ';
                return $button;
            })

            ->rawColumns(['status', 'actions'])
            ->make(true);
    }

    public function getAllSaler()
    {
        $data = User::where('type', 'saler')->orderBy('id', 'desc')->get();
        return DataTables::of($data)

            ->editColumn('created_at', function ($data) {


                return $data->created_at->diffForHumans();
            })
            ->addColumn('status', function ($data) {
                $status = '';
                if ($data->status == 'active') {
                    $status = '<span class="badge badge-success p-1">' . $data->status . '</span>';
                } else {
                    $status = '<span class="badge badge-danger p-1">' . $data->status . '</span>';
                }

                return $status;
            })


            ->addColumn('actions', function ($data) {
                $button = '

                        <button
                          type="button"
                            id="' . $data->id . '"
                          class="edit btn btn-warning btn-sm"
                          data-placement="top"
                          title="User Edit"
                          data-toggle="tooltip modal"
                        >
                          <i class="fa fa-edit blue"></i>
                        </button>

                        <button
                          type="button"
                          id="' . $data->id . '"
                            onclick=deleteUser(' .  $data->id . ')
                          class="btn btn-danger btn-sm"
                          data-placement="top"
                          title="User Delete"
                          data-toggle="tooltip modal"
                        >
                          <i class="fa fa-trash red"></i>
                        </button>
            ';
                return $button;
            })

            ->rawColumns(['status', 'actions'])
            ->make(true);
    }

    public function getAllUser()
    {
        $data = User::orderBy('id', 'desc')->get();
        return DataTables::of($data)

            ->editColumn('created_at', function ($data) {


                return $data->created_at->diffForHumans();
            })
            ->addColumn('status', function ($data) {
                $status = '';
                if ($data->status == 'active') {
                    $status = '<span class="badge badge-success p-1">' . $data->status . '</span>';
                } else {
                    $status = '<span class="badge badge-danger p-1">' . $data->status . '</span>';
                }

                return $status;
            })


            ->addColumn('actions', function ($data) {
                $button = '

                        <button
                          type="button"
                            id="' . $data->id . '"
                          class="edit btn btn-warning btn-sm"
                          data-placement="top"
                          title="User Edit"
                          data-toggle="tooltip modal"
                        >
                          <i class="fa fa-edit blue"></i>
                        </button>

                        <button
                          type="button"
                          id="' . $data->id . '"
                            onclick=deleteUser(' .  $data->id . ')
                          class="btn btn-danger btn-sm"
                          data-placement="top"
                          title="User Delete"
                          data-toggle="tooltip modal"
                        >
                          <i class="fa fa-trash red"></i>
                        </button>
            ';
                return $button;
            })

            ->rawColumns(['status', 'actions'])
            ->make(true);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request['type']);
        $this->authorize('isAdmin');
        $validator =  Validator::make($request->all(), [
            'user_full_name' => ['required', 'string', 'max:255'],
            'user_email' => ['email', 'max:255', 'unique:users,email'],
            'type' => ['required', 'string', 'max:100'],
            'user_status' => ['required', 'string', 'max:100'],
            'user_gender' => ['required', 'string', 'max:100'],

        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }


        $path = public_path('profile/');
        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        }

        $namAvatare = date('Ymd-His');
        Avatar::create(ucwords($request->get('user_full_name')))->save($path . $namAvatare . '.png', 100);

        $password = 'Password@2020';
        User::create([
            'name' => ucwords($request['user_full_name']),
            'email' => $request['user_email'],
            'profile_photo_path' => 'profile/' . $namAvatare . '.png',
            'type' => $request['type'],
            'status' => $request['user_status'],
            'gender' => $request['user_gender'],
            'terms_condition' => true,
            'password' => Hash::make($password),
        ]);

        return response()->json(['success' => 'Data Added successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (request()->ajax()) {
            $data = User::findOrFail($id);
            return response()->json(['result' => $data]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {


        // dd($request['type']);
        $this->authorize('isAdmin');
        $user = User::findOrFail($id);
        $validator =  Validator::make($request->all(), [
            'user_full_name' => ['required', 'string', 'max:255'],
            'user_email' => ['email', 'max:255', 'unique:users,email,' . $user->id],
            'type' => ['required', 'string', 'max:100'],
            'user_status' => ['required', 'string', 'max:100'],
            'user_gender' => ['required', 'string', 'max:100'],

        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        $user->name = ucwords($request['user_full_name']);
        $user->email = $request['user_email'];

        $user->type = $request['type'];
        $user->status = $request['user_status'];
        $user->gender = $request['user_gender'];
        $user->update();
        return response()->json(['success' => 'Data updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = User::findOrFail($id);
        $data->status = 'desactive';
        $data->update();
        $data->delete();
        return response()->json(['success' => 'User dalated successfully.']);
    }

    public function updatePassword(Request $request)
    {

        $user = auth()->user();
        $user = User::findOrFail($user->id);
        $password = Hash::make($request['password']);
        $this->validate($request, [
            'old_password' => 'required:users,password,' . $password,
            'password' => array(
                'required',
                'string',
                'min:8',
                'confirmed',
                'regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/'

            ),
            'password_confirmation' => 'required|string|min:8',
        ]);


        $request->merge(['password' => Hash::make($request['password'])]);
        $user->password = $request->password;
        $user->update();
        Auth::guard('web')->login($user);
        Auth::guard('web')->logout();
        return route('login');
    }
    public function updateProfilePicture(Request $request)
    {

        $request->validate([
            'profil_picture' => 'required|mimes:jpg,jpeg|max:2048',
        ]);



        $user = auth()->user();
        $user = User::findOrFail($user->id);
        $currentPhoto = $user->avatar;
        $path = public_path('images/users/');

        $fileName = time() . '.' . $request->profil_picture->extension();;

        $request->profil_picture->move($path, $fileName);


        if (file_exists($currentPhoto)) {
            @unlink($currentPhoto);
        }

        $user->avatar = '/images/users/' . $fileName;

        $user->update();


        return back()
            ->with('success', 'Your profile picture has been updated.');
    }
}

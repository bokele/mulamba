<?php

namespace App\Http\Controllers;

use App\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use File;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->type == 'admin') {
            return view('admin.preference.country');
        }
    }
    public function getAllCountry()
    {
        $plans = Country::query();
        return DataTables::eloquent($plans)

            ->editColumn('created_at', function ($data) {


                return $data->created_at->diffForHumans();
            })
            ->editColumn('updated_at', function ($data) {


                return $data->updated_at->diffForHumans();
            })
            ->addColumn('actions', function ($data) {
                $button = '';
                $button = '

                        <button
                          type="button"
                            id="' . $data->id . '"
                          class="edit btn btn-warning btn-sm"
                          data-placement="top"
                          title="Edit Country"
                          data-toggle="tooltip modal"
                        >
                          <i class="fa fa-edit blue"></i>
                        </button>

                        <button
                          type="button"
                          id="' . $data->id . '"
                            onclick=deletePlan(' .  $data->id . ')
                          class="btn btn-danger btn-sm"
                          data-placement="top"
                          title="Country Delete"
                          data-toggle="tooltip modal"
                        >
                          <i class="fa fa-trash red"></i>
                        </button>
            ';



                return $button;
            })

            ->rawColumns(['status', 'actions',])
            ->toJson();
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
        if (\Gate::allows('isAdmin')) {
            $user = Auth::user();
            $validator =  Validator::make($request->all(), [
                'name' => ['required', 'unique:countries,name'],
                'flag' => ['required', 'image', 'mimes:png,jpg,ico', 'max:2048'],
                'code' => ['required'],
                'currency' => ['required'],
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()]);
            } else {
                $data = $request->except('_token');
                $path = public_path('country-flag/');
                if (!File::isDirectory($path)) {
                    File::makeDirectory($path, 0777, true, true);
                }
                $flag = $request->file('flag');
                $new_flag_name = time() . '.' . $flag->getClientOriginalExtension();
                $flag->move($path, $new_flag_name);
                $data['flag'] = 'country-flag/' . $new_flag_name;
                Country::create($data);

                return ['success' => 'Country has been created'];
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function show(Country $country)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        if (\Gate::allows('isAdmin')) {
            $user = Auth::user();
            if ($user->type == 'admin') {
                $result = Country::findOrFail($id);

                return ['result' => $result];
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (\Gate::allows('isAdmin')) {
            $country = Country::findOrFail($id);
            $user = Auth::user();
            $validator =  Validator::make($request->all(), [
                'name' => ['required', 'unique:countries,name,' . $country->id],
                'flag' => ['required', 'image', 'mimes:png,jpg,ico', 'max:2048'],
                'code' => ['required'],
                'currency' => ['required'],
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()]);
            } else {
                $data = $request->except('_token');
                if ($request->flag != $country->flag) {
                    $path = public_path('country-flag/');

                    $flag = $request->file('flag');
                    $new_flag_name = time() . '.' . $flag->getClientOriginalExtension();
                    $flag->move($path, $new_flag_name);
                    $data['flag'] = 'country-flag/' . $new_flag_name;

                    $current_flag = public_path() . $country->flag;
                    if (file_exists($current_flag)) {
                        @unlink($current_flag);
                    }
                }

                $country->update($data);

                return ['success' => 'Country has been updated'];
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (\Gate::allows('isAdmin')) {
            $country = Country::findOrFail($id);
            $user = Auth::user();
            $country->delete();
            return response()->json(['success' => 'Data dalated successfully.']);
        }
    }
}

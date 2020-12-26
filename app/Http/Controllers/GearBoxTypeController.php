<?php

namespace App\Http\Controllers;

use App\GearBoxType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class GearBoxTypeController extends Controller
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
            return view('admin.preference.gearbox');
        } else {
            return view('pages.notFound');
        }
    }
    public function getAllGearBox()
    {
        $gear_box = GearBoxType::query();
        return DataTables::eloquent($gear_box)

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
                'name' => ['required', 'unique:gear_box_types,name'],
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()]);
            } else {
                $data = $request->except('_token');
                GearBoxType::create($data);

                return ['success' => 'Gear box  has been created'];
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\GearBoxType  $gearBoxType
     * @return \Illuminate\Http\Response
     */
    public function show(GearBoxType $gearBoxType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\GearBoxType  $gearBoxType
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (\Gate::allows('isAdmin')) {
            $user = Auth::user();
            if ($user->type == 'admin') {

                $result = GearBoxType::findOrFail($id);

                return ['result' => $result];
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\GearBoxType  $gearBoxType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (\Gate::allows('isAdmin')) {
            $user = Auth::user();
            $gear_box = GearBoxType::findOrFail($id);
            $validator =  Validator::make($request->all(), [
                'name' => ['required', 'unique:gear_box_types,name,' . $gear_box->id],

            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()]);
            } else {
                $data = $request->except('_token');

                $gear_box->update($data);

                return ['success' => 'Gear box has been created'];
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\GearBoxType  $gearBoxType
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (\Gate::allows('isAdmin')) {
            $gear_box = GearBoxType::findOrFail($id);
            $user = Auth::user();
            $gear_box->delete();
            return response()->json(['success' => 'Data dalated successfully.']);
        }
    }
}

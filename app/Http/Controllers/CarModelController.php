<?php

namespace App\Http\Controllers;

use App\CarModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class CarModelController extends Controller
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
            return view('admin.preference.carModel');
        } else {
            return view('pages.notFound');
        }
    }

    public function getAllCarModel()
    {
        $gear_box = CarModel::query();
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
    public function getAllCarModelSelect()
    {

        $formatted_data = [];
        if ($search = \Request::get('q')) {

            $data = CarModel::where(function ($query) use ($search) {
                $query->where('brand', 'LIKE', "%$search%")
                    ->orWhere('model', 'LIKE', "%$search%");
            })->paginate(15);

            foreach ($data as $tag) {
                $formatted_data[] = ['id' => $tag->id, 'text' => $tag->brand . ", " . $tag->model . ", " . $tag->vehicle_type . " " . $tag->year];
            }
        } else {
            $data = CarModel::latest()->paginate(15);
            foreach ($data as $tag) {
                $formatted_data[] = ['id' => $tag->id, 'text' => $tag->brand . ", " . $tag->model . ", " . $tag->vehicle_type . ", " . $tag->year];
            }
        }

        return \Response::json($formatted_data);
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
                'brand' => ['required',],
                'model' => ['required', 'unique:car_models,model'],
                'vehicle_type' => ['required',],
                'year' => ['required',],
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()]);
            } else {
                $data = $request->except('_token');
                CarModel::create($data);

                return ['success' => 'Gear box  has been created'];
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CarModel  $carModel
     * @return \Illuminate\Http\Response
     */
    public function show(CarModel $carModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CarModel  $carModel
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (\Gate::allows('isAdmin')) {
            $user = Auth::user();
            if ($user->type == 'admin') {

                $result = CarModel::findOrFail($id);

                return ['result' => $result];
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CarModel  $carModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (\Gate::allows('isAdmin')) {
            $user = Auth::user();
            $car_model = CarModel::findOrFail($id);
            $validator =  Validator::make($request->all(), [
                'brand' => ['required',],

                'model' => ['required', 'unique:car_models,model,' . $car_model->id],
                'vehicle_type' => ['required',],
                'year' => ['required',],

            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()]);
            } else {
                $data = $request->except('_token');

                $car_model->update($data);

                return ['success' => 'Gear box has been created'];
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CarModel  $carModel
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (\Gate::allows('isAdmin')) {
            $car_model = CarModel::findOrFail($id);
            $user = Auth::user();
            $car_model->delete();
            return response()->json(['success' => 'Data dalated successfully.']);
        }
    }
}

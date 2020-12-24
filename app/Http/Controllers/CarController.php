<?php

namespace App\Http\Controllers;

use File;
use App\Car;
use App\Address;
use App\Country;
use App\CarModel;
use App\GearBoxType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class CarController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countries = Country::orderBy('name', 'asc')->get();
        $gear_boxes = GearBoxType::orderBy('name', 'asc')->get();
        $car_model = CarModel::orderBy('model', 'asc')->groupBy('model', 'car_models.id')->limit(30)->get();
        $car_brand = CarModel::orderBy('brand', 'asc')->groupBy('brand', 'car_models.id')->limit(30)->get();
        $car_types = CarModel::select('vehicle_type', 'car_models.id')->groupBy('vehicle_type', 'id')->limit(30)->orderBy('vehicle_type', 'asc')->get();


        if (\Route::current()->getName() == "admin.all.cars") {

            return view('admin.car.list', [
                'countries' => $countries,
                'gear_boxes' => $gear_boxes,
                'car_model' => $car_model,
                'car_brand' => $car_brand,
                'car_types' => $car_types,
            ]);
        } else if (\Route::current()->getName() == "seller.all.cars") {
            $user = Auth::user();

            return view('seller.car.list', [
                'countries' => $countries,
                'gear_boxes' => $gear_boxes,
                'car_model' => $car_model,
                'car_brand' => $car_brand,
                'car_types' => $car_types,
            ]);
        }
    }
    public function getAllCar()
    {

        if (\Gate::allows('isAdmin')) {
            $data = Car::with(['owner', 'carModel', 'address'])
                ->join('addresses', 'cars.address_id', '=', 'addresses.id')
                ->join('countries', 'addresses.country_id', '=', 'countries.id')
                ->select('cars.*', 'countries.name as country_name');
        } else if (\Gate::allows('isSeller')) {
            $user = Auth::user();
            $data = Car::with(['owner', 'carModel', 'address',])
                ->where('owner_id', $user->id)
                ->where('status', '!=', 'remove')
                ->join('addresses', 'cars.address_id', '=', 'addresses.id')
                ->join('countries', 'addresses.country_id', '=', 'countries.id')
                ->select('cars.*', 'countries.name as country_name');
        }

        return DataTables::eloquent($data)
            ->orderByNullsLast()
            ->addColumn('owner', function ($data) {

                return $data->owner->name;
            })
            ->addColumn('country_name', function ($data) {

                return  $data->country_name;
            })
            ->addColumn('car_model_brand', function ($data) {

                return $data->carModel->brand;
            })
            ->addColumn('car_model', function ($data) {

                return $data->carModel->model;
            })
            ->addColumn('vehicle_type', function ($data) {

                return $data->carModel->vehicle_type;
            })
            ->editColumn('price', function ($data) {


                return number_format($data->price / 100, 2);
            })

            ->editColumn('created_at', function ($data) {


                return $data->created_at->diffForHumans();
            })
            ->editColumn('updated_at', function ($data) {


                return $data->updated_at->diffForHumans();
            })



            ->addColumn('status', function ($data) {
                $status = '';
                if ($data->status == 'sold') {
                    $status = '<span class="badge badge-purple p-1 text-capitalize">' . $data->status . '</>';
                } else if ($data->status == 'in stock') {
                    $status = '<span class="badge badge-success p-1 text-capitalize">' . $data->status . '</span>';
                } else if ($data->status == 'rent') {
                    $status = '<span class="badge badge-primary p-1 text-capitalize">' . $data->status . '</span>';
                } else {
                    $status = '<span class="badge badge-danger p-1 text-capitalize">' . $data->status  . '</span>';
                }

                return $status;
            })


            ->addColumn('actions', function ($data) {
                $button = '';
                $button = '

                        <button
                          type="button"
                            id="' . $data->id . '"
                          class="edit btn btn-warning btn-sm"
                          data-placement="top"
                          title="Edit Car"
                          data-toggle="tooltip modal"
                        >
                          <i class="fa fa-edit blue"></i>
                        </button>

                        <button
                          type="button"
                          id="' . $data->id . '"
                            onclick=deleteCar(' .  $data->id . ')
                          class="btn btn-danger btn-sm"
                          data-placement="top"
                          title="User Delete"
                          data-toggle="tooltip modal"
                        >
                          <i class="fa fa-trash red"></i>
                        </button>
            ';

                $button .= ' <button
                          type="button"
                          id="' . $data->id . '"

                          class="attachment btn btn-dark btn-sm"
                          data-placement="top"
                          title="documents Attach"
                          data-toggle="tooltip modal"
                        >
                          <i class="fa fa-paperclip red"></i>
                        </button>';

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
        if (\Gate::allows('isAdmin') || \Gate::allows('isSeller')) {

            $user = Auth::user();
            $validator =  Validator::make($request->all(), [
                'current_status_of_registraion' => ['required'],
                'brand' => ['required'],
                'vehicle_fuel_type' => ['required'],
                'vehicle_seat_count' => ['required'],
                'vehicle_door_count' => ['required'],
                'vehicle_registration' => ['required_if:current_status_of_registraion,==,yes',],
                'Vehicle_identification_number' => ['required', 'string', 'max:17', 'unique:cars'],
                'vehicle_gear_box_type' => ['required'],
                'mileage' => ['required'],
                'color' => ['required'],
                'description_of_feature' => ['required'],
                'city' => ['required'],
                'state_or_province' => ['required'],
                'status' => ['required'],
                'country_name' => ['required'],
                'price' => ['required'],


            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()]);
            }
            $car = new Car;
            $address = new Address;




            $address->country_id = $request['country_name'];
            $address->city = $request['city'];
            $address->state = $request['state_or_province'];
            $address->save();

            $latesCar = Car::orderBy('created_at', 'DESC')->first();
            if ($latesCar == "") {
                $code = date('ymd') . '#' . str_pad(0 + 1, 8, "0", STR_PAD_LEFT);
            } else {
                $code = date('ymd') . '#' . str_pad(0 + 1, 8, "0", STR_PAD_LEFT);
            }
            $car->code =  $code;
            $car->car_model_id = $request['brand'];
            $car->owner_id =  $user->id;
            $car->current_status_of_registraion = $request['current_status_of_registraion'];
            $car->vehicle_fuel_type = $request['vehicle_fuel_type'];
            $car->vehicle_seat_count = $request['vehicle_seat_count'];
            $car->vehicle_door_count = $request['vehicle_door_count'];
            $car->vehicle_registration = $request['vehicle_registration'];
            $car->Vehicle_identification_number = $request['Vehicle_identification_number'];
            $car->vehicle_gear_box_type = $request['vehicle_gear_box_type'];
            $car->mileage = $request['mileage'];
            $car->color = $request['color'];
            $car->price = $request['price'] * 100;
            $car->description_of_feature = $request['description_of_feature'];
            $car->status = $request['status'];
            $car->address_id = $address->id;
            $car->save();





            return response()->json(['success' => 'Data updated successfully.']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function show(Car $car)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (\Gate::allows('isAdmin') || \Gate::allows('isSeller')) {
            if (request()->ajax()) {

                $data = Car::with(['owner', 'carModel', 'address'])->where('cars.id', $id)->join('addresses', 'cars.address_id', '=', 'addresses.id')
                    ->join('countries', 'addresses.id', '=', 'countries.id')
                    ->select('cars.*', 'addresses.*', 'countries.name as country_name')->get();
                return response()->json(['result' => $data]);
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (\Gate::allows('isAdmin') || \Gate::allows('isSeller')) {
            $car = Car::findOrFail($id);
            $user = Auth::user();
            $validator =  Validator::make($request->all(), [
                'current_status_of_registraion' => ['required'],
                'brand' => ['required'],
                'vehicle_fuel_type' => ['required'],
                'vehicle_seat_count' => ['required'],
                'vehicle_door_count' => ['required'],
                'vehicle_registration' => ['required_if:current_status_of_registraion,==,yes',],
                'Vehicle_identification_number' => ['required', 'string', 'max:17', 'unique:cars,Vehicle_identification_number,' . $car->id],
                'vehicle_gear_box_type' => ['required'],
                'mileage' => ['required'],
                'color' => ['required'],
                'description_of_feature' => ['required'],
                'city' => ['required'],
                'state_or_province' => ['required'],
                'status' => ['required'],
                'country_name' => ['required'],
                'price' => ['required'],


            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()]);
            }


            $address_id = $request['hidden_address_id'];
            $address = Address::findOrFail($address_id);
            $address->country_id = $request['country_name'];
            $address->city = $request['city'];
            $address->state = $request['state_or_province'];
            $address->update();


            $car->car_model_id = $request['brand'];
            $car->owner_id =  $user->id;
            $car->current_status_of_registraion = $request['current_status_of_registraion'];
            $car->vehicle_fuel_type = $request['vehicle_fuel_type'];
            $car->vehicle_seat_count = $request['vehicle_seat_count'];
            $car->vehicle_door_count = $request['vehicle_door_count'];
            $car->vehicle_registration = $request['vehicle_registration'];
            $car->Vehicle_identification_number = $request['Vehicle_identification_number'];
            $car->vehicle_gear_box_type = $request['vehicle_gear_box_type'];
            $car->mileage = $request['mileage'];
            $car->color = $request['color'];
            $car->price = $request['price'];
            $car->description_of_feature = $request['description_of_feature'];
            $car->status = $request['status'];
            $car->address_id = $address->id;
            $car->update();
            return response()->json(['success' => 'Data updated successfully.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $car = Car::findOrFail($id);
        $car->status = 'remove';
        $car->update();
        $car = Car::findOrFail($id);

        $car->delete();
        return response()->json(['success' => 'Data dalated successfully.']);
    }
    public function uploadDocument(Request $request)
    {

        $id = $request->get('car_id');

        $car = Car::where('id', $id)->firstOrFail();
        $validation = Validator::make($request->all(), [
            'white_book' => 'required_if:current_status_of_registraion,==,yes|mimes:pdf,docx,doc,jpg,jpeg,png|max:2048:',
            // 'tax_clearancy' => 'required|mimes:pdf,docx,doc,jpg,jpeg,png|max:2048',
            // 'last_insurancy' => 'required|mimes:pdf,docx,doc,jpg,jpeg,png|max:2048',
            'cover_image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'front_car_image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'car_left_side' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'car_right_side' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'car_behind_image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'dashbooard_image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'inside_image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);






        if ($validation->passes()) {

            $path = public_path('cars/' . $car->Vehicle_identification_number . '/');
            if (!File::isDirectory($path)) {
                File::makeDirectory($path, 0777, true, true);
            }



            $white_book = $request->file('white_book');
            // $tax_clearancy = $request->file('tax_clearancy');
            // $last_insurancy =  $request->file('last_insurancy');
            $cover_image =  $request->file('cover_image');
            $front_car_image = $request->file('front_car_image');
            $car_left_side =  $request->file('car_left_side');
            $car_right_side =  $request->file('car_right_side');
            $car_behind_image =  $request->file('car_behind_image');
            $dashbooard_image = $request->file('dashbooard_image');
            $inside_image =  $request->file('inside_image');

            $new_white_book = time() . '.' . $white_book->getClientOriginalExtension();
            // $new_tax_clearancy = time() . '.' . $tax_clearancy->getClientOriginalExtension();
            // $new_last_insurancy = time() . '.' . $last_insurancy->getClientOriginalExtension();
            $new_cover_image = time() . '.' . $cover_image->getClientOriginalExtension();
            $new_front_car_image = time() . '.' . $front_car_image->getClientOriginalExtension();
            $new_car_left_side = time() . '.' . $car_left_side->getClientOriginalExtension();
            $new_car_right_side = time() . '.' . $car_right_side->getClientOriginalExtension();
            $new_car_behind_image = time() . '.' . $car_behind_image->getClientOriginalExtension();
            $new_dashbooard_image = time() . '.' . $dashbooard_image->getClientOriginalExtension();
            $new_inside_image = time() . '.' . $inside_image->getClientOriginalExtension();

            $white_book->move($path, $new_white_book);
            // $tax_clearancy->move($path, $new_tax_clearancy);
            // $last_insurancy->move($path, $new_last_insurancy);
            $cover_image->move($path, $new_cover_image);
            $front_car_image->move($path, $new_front_car_image);
            $car_left_side->move($path, $new_car_left_side);
            $car_right_side->move($path, $new_car_right_side);
            $car_behind_image->move($path, $new_car_behind_image);
            $dashbooard_image->move($path, $new_dashbooard_image);
            $inside_image->move($path, $new_inside_image);

            $car->white_book = 'cars/' . $car->Vehicle_identification_number . '/' .  $new_white_book;
            // $car->tax_clearancy = 'cars/' . $car->Vehicle_identification_number . '/' . $new_tax_clearancy;
            // $car->last_insurancy = 'cars/' . $car->Vehicle_identification_number . '/' . $new_last_insurancy;
            $car->cover_image = 'cars/' . $car->Vehicle_identification_number . '/' . $new_cover_image;
            $car->front_car_image = 'cars/' . $car->Vehicle_identification_number . '/' . $new_front_car_image;
            $car->car_left_side = 'cars/' . $car->Vehicle_identification_number . '/' . $new_car_left_side;
            $car->car_right_side = 'cars/' . $car->Vehicle_identification_number . '/' . $new_car_right_side;
            $car->car_behind_image = 'cars/' . $car->Vehicle_identification_number . '/' . $new_car_behind_image;
            $car->dashbooard_image = 'cars/' . $car->Vehicle_identification_number . '/' . $new_dashbooard_image;
            $car->inside_image = 'cars/' . $car->Vehicle_identification_number . '/' . $new_inside_image;

            $car->update();

            return response()->json(['success' => 'File updated successfully.']);
        } else {


            return response()->json(['errors' => $validation->errors()]);
        }
    }
}

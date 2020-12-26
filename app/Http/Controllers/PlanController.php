<?php

namespace App\Http\Controllers;

use App\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class PlanController extends Controller
{
    protected $stripe;
    public function __construct()
    {
        $this->stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->type == 'admin') {
            return view('admin.preference.plan');
        }
    }

    public function getAllPlan()
    {
        $plans = Plan::query();
        return DataTables::eloquent($plans)
            ->editColumn('cost', function ($data) {


                return  '$' . number_format($data->cost / 100, 2);
            })
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
                          title="Edit Plan"
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
                          title="Plan Delete"
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
                'name' => ['required', 'unique:plans,name'],
                'cost' => ['required'],
                'description' => ['required'],
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()]);
            } else {
                $data = $request->except('_token');

                $data['slug'] = strtolower($data['name']);
                $price = $data['cost'] * 100;
                $description = $data['description'];

                //create stripe product
                $stripeProduct = $this->stripe->products->create([
                    'name' => $data['name'],
                    'description' => $description,
                ]);

                //Stripe Plan Creation
                $stripePlanCreation = $this->stripe->plans->create([
                    'amount' => $price,
                    'currency' => 'usd',
                    'interval' => 'month', //  it can be day,week,month or year

                    'product' => $stripeProduct->id,
                ]);

                $data['stripe_plan'] = $stripePlanCreation->id;
                $data['cost'] = $stripePlanCreation->amount * 100;
                $data['current'] = $stripePlanCreation->currency;

                Plan::create($data);

                return ['success' => 'plan has been created'];
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function show(Plan $plan, Request $request)
    {
        $paymentMethods = $request->user()->paymentMethods();

        $intent = $request->user()->createSetupIntent();

        return view('admin.plans.show', compact('plan', 'intent'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (\Gate::allows('isAdmin')) {
            $user = Auth::user();
            if ($user->type == 'admin') {
                $result = Plan::findOrFail($id);

                return ['result' => $result];
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (\Gate::allows('isAdmin')) {
            $user = Auth::user();
            $plan = Plan::findOrFail($id);
            $validator =  Validator::make($request->all(), [
                'name' => ['required', 'unique:plans,name,' . $id],
                'cost' => ['required'],
                'description' => ['required'],
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()]);
            } else {
                $data = $request->except('_token');

                $data['slug'] = strtolower($data['name']);
                $price = $data['cost'] * 100;
                $description = $data['description'];

                //retrive stripe product
                $stripe_plan = $this->stripe->plans->retrieve(
                    $plan->stripe_plan,
                    []
                );
                //create stripe product

                $stripeProduct = $this->stripe->products->update($stripe_plan->product, [
                    'name' => $data['name'],
                    'description' => $description,
                ]);

                //Stripe Plan Creation
                $stripePlanCreation = $this->stripe->plans->update(
                    $plan->stripe_plan,

                );

                $data['stripe_plan'] = $stripePlanCreation->id;
                $data['stripe_product'] = $stripePlanCreation->id;

                $data['cost'] = $stripe_plan->amount * 100;
                $data['current'] = $stripe_plan->currency;


                $plan->Update($data);

                return ['success' => 'plan has been created'];
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (\Gate::allows('isAdmin')) {
            $plan = Plan::findOrFail($id);
            $user = Auth::user();
            $plan->delete();
            return response()->json(['success' => 'Data dalated successfully.']);
        }
    }
}

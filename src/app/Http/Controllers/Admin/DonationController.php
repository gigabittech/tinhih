<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Donation;
use App\Models\Admin\Provider;
use App\Models\Admin\Client;
use Illuminate\Database\QueryException;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Stripe;
use Session;

class DonationController extends Controller
{
    private $moduleObject;
    private $moduleName = "Donation";
    private $singularVariableName = 'donation';
    private $pluralVariableName = 'donations';

    private $retrievedDataList;
    private $singleData;
    private $path;

    public function __construct()
    {
        $this->moduleObject = new Donation();
        $this->path = "admin.pages." . $this->pluralVariableName;
    }

    public function index()
    {

        $this->singleData = User::with('provider', 'client')->find(auth()->user()->id);


        return view($this->path . '.index', [
            $this->singularVariableName => $this->singleData,
        ]);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view($this->path . '.create');
    }

    public function checkout(Request $request)
    {

        $validation = Validator::make(
            $request->all(),
            [
                'one_time' => 'required|numeric|min:1',
            ],
            [
                'one_time.required' => 'Please enter a valid donation amount',
                'one_time.min' => "Donation amount must be greater than or equal to $1"
            ]
        );

        if ($validation->fails()) {
            return redirect()->back()->with('error', $validation->errors()->first());
        }
        $one_time = $request->one_time;
        \Stripe\Stripe::setApiKey('sk_test_YFlA9dRMI4Mpv40ci9BQgdVf');
        $session = \Stripe\Checkout\Session::create(
            [
                'line_items' => [
                    [
                        'price_data' => [
                            'currency' => 'usd',
                            'product_data' => [
                                'name' => 'Total Payment',
                            ],
                            'unit_amount' => $one_time * 100,
                        ],
                        'quantity' => 1,
                    ],

                ],
                'mode' => 'payment',
                'success_url' => route('donation.index'),
                'cancel_url' => 'https://tinhih.com/private-panel/donation',
            ]
        );




        try {

            // $request['one_time'] = $one_time;

            $donation = $this->moduleObject->GetData($request->all());

            // dd($donation);

            if ($this->moduleObject->create($donation)) {


                return redirect($session->url)->with(['success' => $this->moduleName . " created successfully"]);
            }

            return redirect()->back()->with(['error' => "Unable to handle this request !"]);


        } catch (QueryException $ex) {
            return redirect()->back()->with(['error' => $ex->getMessage()]);
        }


    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $input = $request->all();
        // dd($input);

        // $charge = \Stripe\Charge::create([
        //     'source' => $_POST['stripeToken'],
        //     'description' => "10 cucumbers from Roger's Farm",
        //     'amount' => 2000,
        //     'currency' => 'usd',
        //     'application_fee_amount' => 200,
        //   ]);

        \Stripe\Stripe::setApiKey('sk_test_4eC39HqLyjWDarjtT1zdp7dc');

        $charge = Stripe\Charge::create([
            "amount" => 100 * 100,
            "currency" => "usd",
            "source" => $request->stripeToken,
        ]);

        // dd($charge);
        // exit;

        if ($charge->status == "succeeded") {
            //dd("succidded");

            return redirect()->back()->with(['success' => " Payment successfull"]);
            ;
        }

    }


    public function edit($id)
    {
        $data = $this->moduleObject->findOrFail($id);

        return view($this->path . '.edit', [
            $this->singularVariableName => $data,
            $this->pluralVariableName => $this->moduleObject->all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $oldData = $this->moduleObject->findOrFail($id);
        try {
            $certification = $this->moduleObject->GetData($request->all());

            if ($oldData->update($certification)) {
                return redirect()->back()->with(['success' => $this->moduleName . "  updated successfully"]);
            }
            return redirect()->back()->with(['error' => "Unable to update"]);

        } catch (QueryException $ex) {
            return redirect()->back()->with(['error' => $ex->getMessage()]);
        }


    }

    public function toggleStatus(Request $request)
    {
        $id = $request->id;
        $oldData = $this->moduleObject->findOrFail($id);
        try {
            //            $certification = $this->moduleObject->GetData($request->all());
            $data['is_active'] = $oldData->is_active == 1 ? 0 : 1;


            if ($oldData->update($data)) {
                return redirect()->back()->with(['success' => $this->moduleName . "  updated successfully"]);
            }
            return redirect()->back()->with(['error' => "Unable to update"]);

        } catch (QueryException $ex) {
            return redirect()->back()->with(['error' => $ex->getMessage()]);
        }


    }
    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            if ($this->moduleObject->destroy($id)) {
                return redirect()->back()->with(['success' => $this->moduleName . "  deleted successfully"]);
            }
        } catch (QueryException $exception) {
            return redirect()->back()->with(['error' => $exception->getMessage()]);

        }
        return redirect()->back()->with(['error' => "Unable to handle this request !"]);


    }

}

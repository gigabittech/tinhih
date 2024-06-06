<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Certification;
use App\Models\Admin\Provider;
use App\Models\User;
use App\Models\Admin\DrCertificate;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PhpParser\Comment\Doc;

class DrCertificateController extends Controller
{
    private $moduleObject;
    private $moduleName = "DrCertificate";
    private $singularVariableName = 'drcertificate';
    private $pluralVariableName = 'drcertificates';

    private $retrievedDataList;
    private $singleData;
    private $path;

    public function __construct()
    {
        $this->moduleObject = new DrCertificate();
        $this->path = "admin.pages.providers";
    }

    public function index()
    {
        $certifications = Certification::all();
        $providers = Provider::all();
        $this->singleData = $this->moduleObject->all();
        // $this->singleData =User::with('provider')->find(auth()->user()->id);

        return view($this->path . '.profile', [
            'certifications' => $certifications,
            'providers' => $providers,
            $this->singularVariableName => $this->singleData
        ]);

        // $certifications = Certification::all();
        // $profiles = Profile::all();
        // $this->singleData =User::with('profile')->find(auth()->user()->id);

        // return view($this->path . '.create', [
        //     'providers'=>$providers,
        //     'profiles'=>$profiles,
        //     $this->singularVariableName => $this->singleData
        // ]);


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

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // dd($request->all());
        $validation = Validator::make($request->all(), [
            'certification_id' => 'required'
        ], [
            'certification_id' => 'Please select a Certification'
        ]);

        if ($validation->fails()) {
            return redirect()->back()->with(['error' => $validation->errors()->first()]);
        }

        try {

            $drcertificate = $this->moduleObject->GetData($request->all());

            if ($this->moduleObject->create($drcertificate)) {


                return redirect()->back()->with(['success' => $this->moduleName . " created successfully"]);
            }

            return redirect()->back()->with(['error' => "Unable to handle this request !"]);


        } catch (QueryException $ex) {
            return redirect()->back()->with(['error' => $ex->getMessage()]);
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
            $drcertificate = $this->moduleObject->GetData($request->all());

            if ($oldData->update($drcertificate)) {
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
            //            $drcertification = $this->moduleObject->GetData($request->all());
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

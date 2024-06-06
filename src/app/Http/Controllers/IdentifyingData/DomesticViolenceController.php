<?php

namespace App\Http\Controllers\IdentifyingData;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\IdentifyingData\DomesticViolenceScreening;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class DomesticViolenceController extends Controller
{
    private $moduleObject;
    private $moduleName = "DomesticViolenceScreening";
    private $singularVariableName = 'domestic_violence_screening';
    private $pluralVariableName = 'domestic_violence_screenings';

    private $retrievedDataList;
    private $singleData;
    private $path;

    public function __construct()
    {
        $this->moduleObject = new DomesticViolenceScreening();
        $this->path = "admin.pages.identifying_datas";
    }

    public function index()
    {

        $this->singleData = User::with('client')->find(auth()->user()->id);
        $this->retrievedDataList = $this->moduleObject->all();

        return view($this->path . '.domestic_violence', [
            $this->pluralVariableName => $this->retrievedDataList,
            $this->singularVariableName => $this->singleData,
            'domestic_violence' => $this->moduleObject->where('client_id', auth()->user()->id)->get()->first()

        ]);


    }

    public function viewEvent()
    {

        $this->retrievedDataList = $this->moduleObject->all();

        return view($this->path . '.show', [
            $this->pluralVariableName => $this->retrievedDataList
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

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try {

            $domestic_violence_screening = $this->moduleObject->GetData($request->all());
            // dd($parents_information);

            if ($this->moduleObject->create($domestic_violence_screening)) {

                return redirect()->route('school_work_data.index')->with(['success' => $this->moduleName . " created successfully"]);
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
            $domestic_violence_screening = $this->moduleObject->GetData($request->all());

            if ($oldData->update($domestic_violence_screening)) {

                return redirect()->route('school_work_data.index')->with(['success' => $this->moduleName . " created successfully"]);
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
            //            $specialization = $this->moduleObject->GetData($request->all());
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

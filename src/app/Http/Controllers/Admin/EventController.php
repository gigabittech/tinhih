<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Event;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{

    private $moduleObject;
    private $moduleName = "Event";
    private $singularVariableName = 'event';
    private $pluralVariableName = 'events';

    private $retrievedDataList;
    private $singleData;
    private $path;

    public function __construct()
    {
        $this->moduleObject = new Event();
        $this->path = "admin.pages." . $this->pluralVariableName;
    }
    protected function validator(array $request)
    {
        return Validator::make($request, [

        ]);
    }

    public function index()
    {

        $this->retrievedDataList = $this->moduleObject->orderBy('status', 'desc')->orderBy('date', 'asc')->get();
        // dd($this->retrievedDataList);

        return view($this->path . '.index', [
            $this->pluralVariableName => $this->retrievedDataList
        ]);


    }

    public function viewEvent()
    {

        $this->retrievedDataList = $this->moduleObject->where('status', 1)->orderBy('date', 'asc')->get();

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
        $this->validator($request->all())->validate();


        $validatedData = $request->validate([
            'title' => ['required', 'string', 'max:255', 'regex:/^[A-Za-z0-9][A-Za-z0-9\s]*[A-Za-z0-9]$/'],

        ]);


        try {

            $event = $this->moduleObject->GetData($request->all());

            if ($this->moduleObject->create($event)) {


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
            $specialization = $this->moduleObject->GetData($request->all());

            if ($oldData->update($specialization)) {
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


    public function deleteAll(Request $request)
    {
        $selectedIds = $request->input('selectedIds');
        try {
            $this->moduleObject->whereIn('id', $selectedIds)->delete();
            return redirect()->back()->with(['success' => "Selected " . $this->moduleName . "`s  deleted successfully"]);
        } catch (Exception $ex) {
            return redirect()->back()->with(['error' => "Something went wrong, try later"]);
        }
    }


}

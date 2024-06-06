<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Admin\CommunityMember;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Validation\Validation;
use Illuminate\Support\Facades\Validator;


class CommunityMemberController extends Controller
{


    private $moduleObject;
    private $moduleName = "CommunityMember";
    private $singularVariableName = 'community_member';
    private $pluralVariableName = 'community_members';

    private $retrievedDataList;
    private $singleData;
    private $path;

    public function __construct()
    {
        $this->moduleObject = new CommunityMember();
        $this->path = "admin.pages." . $this->pluralVariableName;
    }

    public function index()
    {
        $this->singleData = User::with('community_member')->find(auth()->user()->id);


        return view($this->path . '.index', [
            $this->singularVariableName => $this->singleData,
        ]);
    }


    public function user_manage()
    {
        //     $this->singleData =User::with('profile')->find(auth()->user()->id);

        //    // dd(($this->singleData->profile));

        //     return view($this->path . '.user_manage', [
        //         $this->singularVariableName => $this->singleData
        //     ]);


        $this->retrievedDataList = $this->moduleObject->all();

        return view($this->path . '.user_manage', [
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

            $community_member = $this->moduleObject->GetData($request->all());
            //dd($profile);

            if ($this->moduleObject->create($community_member)) {

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
        if ($request->has('recovery_date')) {
            $validator = Validator::make($request->all(), [
                'recovery_date' => 'required|date|before_or_equal:today',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator);
            }
        }

        $oldData = $this->moduleObject->where('user_id', $id)->first();
        try {
            $community_member = $this->moduleObject->GetData($request->all());

            if ($oldData->update($community_member)) {
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


    public function settings($id)
    {
        $data = $this->moduleObject->findOrFail($id);
        return view($this->path . '.settings', [
            $this->singularVariableName => $data,
            $this->pluralVariableName => $this->moduleObject->all()
        ]);
    }

}

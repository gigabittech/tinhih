<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Auth;
use Exception;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    private $moduleObject;
    private $moduleName = "User";
    private $singularVariableName = 'user';
    private $pluralVariableName = 'users';

    private $retrievedDataList;
    private $singleData;
    private $path;

    public function __construct()
    {
        $this->moduleObject = new User();

        $this->path = "admin.pages." . $this->pluralVariableName;
    }

    public function index()
    {
        $this->retrievedDataList = User::where('type', 'provider')->get();

        return view($this->path . '.index', [
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


    // ...

    public function store(Request $request)
    {
        try {
            // Validation rules
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'dob' => 'required|date',
                'password' => 'required|min:8|confirmed',
                'phone' => 'required|string|max:20|unique:users',
                // Add other validation rules as needed
            ]);


            // Set the 'type' explicitly to 'provider'
            $validatedData['type'] = 'provider';

            // Hash the password
            $validatedData['password'] = Hash::make($validatedData['password']);

            // Create the user
            $user = $this->moduleObject->create($validatedData);

            if ($user) {
                // Since 'type' is always 'provider', no need to check
                $user->provider()->create($validatedData);

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


    // ...

    public function update(Request $request, $id)
    {
        $oldData = $this->moduleObject->findOrFail($id);

        try {
            // Validation rules
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => [
                    'required',
                    'email',
                    Rule::unique('users')->ignore($oldData->id),
                ],
                'dob' => 'required|date',
                'phone' => 'required|string|max:20',
                'password' => 'nullable|min:8|confirmed',
                // Add other validation rules as needed
            ]);

            // Update the user data
            if ($validatedData['password'] !== null) {
                // Hash the password only if a new password is provided
                $validatedData['password'] = Hash::make($validatedData['password']);
            } else {
                // If no new password is provided, remove it from the data array
                unset($validatedData['password']);
            }

            if ($oldData->update($validatedData)) {
                return redirect()->back()->with(['success' => $this->moduleName . " updated successfully"]);
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

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Admin;
use App\Models\User;
use App\Models\Admin\Client;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    private $moduleObject;
    private $moduleName = "Profile";
    private $singularVariableName = 'profile';
    private $pluralVariableName = 'profiles';

    private $retrievedDataList;
    private $singleData;
    private $path;

    public function __construct()
    {
        $this->moduleObject = new Client();
        $this->path = "admin.pages." . $this->pluralVariableName;
    }



    public function profileAdmin()
    {
        $this->singleData = User::with('client')->find(auth()->user()->id);

        return view($this->path . '.admin.profile', [
            $this->singularVariableName => $this->singleData
        ]);
    }
    public function profileClient()
    {
        $this->singleData = User::with('client')->find(auth()->user()->id);

        return view($this->path . '.client.profile', [
            $this->singularVariableName => $this->singleData
        ]);
    }


    public function adminSettings($id)
    {
        // $data = $this->moduleObject->findOrFail($id);
        $data = Admin::findorFail($id);
        return view($this->path . '.admin.settings', [
            'admin' => $data,
            $this->pluralVariableName => $this->moduleObject->all()
        ]);
    }
    public function clientSettings($id)
    {
        $data = $this->moduleObject->findOrFail($id);
        return view($this->path . '.client.settings', [
            $this->singularVariableName => $data,
            $this->pluralVariableName => $this->moduleObject->all()
        ]);
    }

}

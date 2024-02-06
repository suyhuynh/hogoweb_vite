<?php

namespace Modules\User\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\User\Entities\User;
use Modules\User\Http\Requests\SavePasswordRequest;

class AccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
        $this->lang = 'vi';
    }
    public function profile()
    {
        $profile = User::find(auth()->id());

        return view('user::admin.account.profile', ['profile' => $profile]);
    }

    public function updateProfile(Request $request)
    {
        $input = $this->filterData($request->all());
        $profile = User::where('id', auth()->id())->update($input);
        \Auth::loginUsingId(auth()->id());
        return response()->json(['success' => true, 'resource' => trans('attributes.update_success')]);
    }

    public function changePassword()
    {
        return view('user::admin.account.change_password');
    }

    public function updatePassword(SavePasswordRequest $request)
    {
        User::where('id', auth()->id())->update(['password' => bcrypt($request->password_confirmation)]);
        return response()->json(['success' => true, 'resource' => trans('attributes.update_success'), 'url' => route('admin.login')]);
    }

    public function setting($id)
    {
        return view('user::admin.account.setting');
    }

    private function filterData($data) {
        unset($data['_token']);
        $newData = [];
        foreach ($data as $key => $val) {
            if (!empty($val)) {
                if ($key == 'birthday') {
                    $val = date('Y-m-d', strtotime($val));
                }
                $newData[$key] = $val;
            }
        }

        return $newData;
    }
}

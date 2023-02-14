<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AppetaleController extends Controller
{
    public function login(Request $request)
    {
        $this->validate($request, ['email' => 'required', 'password' => 'required']);
        if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password])) {
            session(['tab' => 'info']);
            return redirect()->route('dashboard');
        }
        return back()->withErrors(['credetial' => trans('auth.failed')]);
    }

    public function logout(){
        Auth::guard('web')->logout();
        return redirect('/');
    }

    public function dashboard()
    {
        return view('app.dashboard', ['user' => auth()->user()]);
    }

    public function updateUserInfo(Request $request)
    {
        if ($request->updateBasicInfo) {
            session()->put('tab', 'info');
            return $this->updateBasicInfo($request, auth()->user()->id);
        }
        if ($request->updateAvatar) {
            session()->put('tab', 'avatar');
            return $this->updateAvatar($request, auth()->user()->id);
        }
        if ($request->updatePassword) {
            session()->put('tab', 'password');
            return $this->updatePassword($request, auth()->user()->id);
        }
        return back();
    }

    protected function updateBasicInfo(Request $request, $id)
    {
        $validated = $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|email',
            'mobile' => 'required|integer',
        ]);
        User::find($id)->update($validated);
        return back()->with(['msg' => 'User Updated Successfully!']);
    }

    protected function updateAvatar(Request $request, $id)
    {
        $this->validate($request, [
            'avatar' => 'required|file|max:200|mimes:jpg,png',
        ]);

        $file = $request->file('avatar');
        $path = Storage::disk('public')->putFileAs('profile/avatar', $file, $id . "." . $file->getClientOriginalExtension());
        User::find($id)->update(['avatar' => $path]);
        return back()->with(['msg' => 'Avatar Updated Successfully']);
    }

    protected function updatePassword(Request $request, $id)
    {
        $this->validate($request, [
            'current_password' => ['required', function ($attribute, $value, $fail) {
                if (!Hash::check($value, auth()->user()->password)) {
                    $fail('Current password is incorrect');
                }
            }],
            'new_password' => ['required'],
            'retype_password' => 'required_with:new_password|same:new_password',
        ]);
        $password = bcrypt($request->new_password);
        User::find($id)->update(['password' => $password]);
        return back()->with(['msg' => 'Password Updated Successfully']);
    }
}

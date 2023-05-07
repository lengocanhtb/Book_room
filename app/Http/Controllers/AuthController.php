<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function loginView() {
        return view('auth.login');
    }

    public function login(Request $request) {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            if (Auth::user()->status == 0) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                Session::flash('error','Tài khoản đã bị khóa!');
                return redirect()->route('login');
            }
            if (Auth::user()->role === '1'){
                return redirect()->route('admin.users.index');
            }
            return redirect()->route('home');
        }
        Session::flash('error','Địa chỉ mail hoặc mật khẩu không chính xác!');
        return redirect()->back();
    }

    public function registerView() {
        return view('auth.register');
    }

    public function register(Request $request) {
        try {
            $request->validate(		[
                'username' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|confirmed',
                'fullname' => 'required|string|max:255',
                'telephone' => 'required|string|max:10',
            ]);
            $dataUser = [
                'username'=> $request->input('username'),
                'fullname'=> $request->input('fullname'),
                'telephone'=> $request->input('telephone'),
                'email'=>$request->input('email'),
                'password'=>Hash::make($request->input('password')),
            ];
            User::create($dataUser);
            Session::flash('success','Đăng ký thành công!');
            return redirect()->route('login');
        }catch (\Exception $err){
            Session::flash('error','Đăng ký thất bại!');
        }
        return redirect()->back();
    }

    public function changePassword(Request $request) {
        try {
            $this->validate($request, [
                'current_password' => 'required|string',
                'new_password' => 'required|confirmed|string'
            ]);
            $auth = Auth::user();

            if (!Hash::check($request->get('current_password'), $auth->password))
            {
                return back()->with('error', "Mật khẩu cũ không đúng");
            }

            if (strcmp($request->get('current_password'), $request->new_password) == 0)
            {
                return redirect()->back()->with("error", "Mật khẩu mới giống mật khẩu cũ");
            }

            $user =  User::find($auth->id);
            $user->password =  Hash::make($request->new_password);
            $user->save();
            return redirect()->back()->with('success', "Đổi Mật Khẩu Thành Công");
        } catch (\Exception $err) {
            return redirect()->back()->with('error', "Đổi Mật Thất Bại");
        }
    }

    public function profileUser() {
        return view('profile');
    }

    public function updateProfile(Request $request) {
        try {
            $user = User::find(Auth::user()->id);
            $request->validate([
                'fullname' => 'required|string|max:255',
                'username' => 'required|string|max:255',
                'telephone' => 'required|string|max:10',
            ]);
            $user->email = Auth::user()->email;
            $user->role = Auth::user()->role;
            $user->username = $request->input('username');
            $user->fullname = $request->input('fullname');
            $user->telephone = $request->input('telephone');
            $user->save();
            Session::flash('success','Cập Nhật Thành Công');
        }catch (\Exception $err){
            Session::flash('error','Cập Nhật Thất Bại');
        }
        return redirect()->back();
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect(route('home'));
    }
}

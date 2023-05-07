<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function index()
    {
        $data['users'] = User::all();
        return view('admin.users.index', $data);
    }

    public function create() {
        return view('admin.users.create');
    }

    public function store(Request $request) {
        try {
            $dataUser = [
                'email'=>$request->input('email'),
                'username'=> $request->input('username'),
                'fullname'=> $request->input('fullname'),
                'password'=>Hash::make('password'),
                'telephone'=> $request->input('telephone'),
            ];
            DB::table('users')->insert($dataUser);
            Session::flash('success','Thêm người dùng thành công!');
            return redirect()->route('admin.users.index');
        }catch (\Exception $err){
            Session::flash('error','Thêm người dùng thất bại!');
        }
        return redirect()->back();
    }

    public function delete(Request $request)
    {
        $data = $request->all();
        if (empty(User::find($data['id']))) {
            return redirect()->back()->with('error','Không tìm thấy');
        }
        DB::beginTransaction();
        try {
            User::where('id', $data['id'])->delete();
            Room::where('user_id', $data['id'])->delete();
            DB::commit();
            return redirect()->back()->with('success', 'Xóa người dùng thành công');
        } catch (\Exception $err) {
            DB::rollBack();
            Session::flash('error','Delete room fail');
            \Log::info($err->getMessage());
            return redirect()->back()->with('error', 'Xóa người dùng lỗi!!');
        }
    }

    public function changeStatus(Request $request){
        $data = $request->all();
        if (empty(User::find($data['id']))) {
            return redirect()->back()->with('error','không có dữ liệu');
        }
        $user = User::where('id',$data['id'])->first();
        $current_status = $user->status;
        try {
            User::where('id',$data['id'])->update([
                'status' => $current_status == 1 ? 0 : 1,
                'updated_at' => Carbon::now()
            ]);
            Session::flash('success','Cập nhật trạng thái thành công');
        } catch (\Exception $err) {
            Session::flash('error','Cập nhật trạng thái thất bại');
            \Log::info($err->getMessage());
        }
        return redirect()->back();
    }
}

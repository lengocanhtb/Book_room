<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Review;
use App\Models\Room;
use App\Models\RoomImage;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File as File2;
use Kjmtrue\VietnamZone\Models\Province;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Kjmtrue\VietnamZone\Models\District;
use Kjmtrue\VietnamZone\Models\Ward;
use Illuminate\Support\Facades\Session;

class RoomController extends Controller
{
    public function index() {
        $my_room = Room::with('reports')->where('user_id', Auth::user()->id)->get();

        return view('post.list_room', compact('my_room'));
    }

    public function detail($id) {
        Carbon::setLocale('vi');
        $comments = Review::where('room_id','=',$id)->orderBy('created_at','DESC')->get();
        $room = Room::where('id','=',$id)->first();
        $rating=round(Review::where('room_id',$id)->whereNotNull('user_id')->get()->avg('rate_star'));

        $user_rating = null;
        if(Auth::check()){
            $user_rating = Review::where('room_id',$id)->where('user_id',Auth::user()->id)->first();
        }

        $reported = false;
        $listReportThisRoom = DB::table('reports')->where('room_id', $id)->get();
        foreach($listReportThisRoom as $reportThisRoom) {
            if(!Auth::check()){
                break;
            }
            if(Auth::user()->id == $reportThisRoom->user_id){
                $reported = true;
                break;
            }
        }

        $user = [
            'username' => "",
            'telephone' => "",
        ];
        if(Auth::check()){
            $user['username'] = Auth::user()->username;
            $user['telephone'] = Auth::user()->telephone;
        }

        return view('comment',compact(['comments','room','rating','user_rating', 'reported', 'user']));
    }

    public function create()
    {
        $data['districts'] = District::where('province_id', 1)->get();
        return view('post.create', $data);
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $province = Province::whereId($request->province_id)->first();
        $district = District::whereId($request->district_id)->first();
        $ward = Ward::whereId($request->ward_id)->first();
        $detail_address = $request->street.', '.$ward->name.', '.$district->name.', '.$province->name;
        $data = [
            'status' => $user->role == 1 ? 1 : 0,
            'title' => $request->title,
            'content' => $request->input('content'),
            'ward_id' => $request->ward_id,
            'district_id' => $request->district_id,
            'province_id' => $request->province_id,
            'detail_address' => $detail_address,
            'rent_type_id' => $request->rent_type_id,
            'videoUrl' => $request->file,
            'area' => $request->area,
            'price' => $request->price,
            'user_id' => $user->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        DB::beginTransaction();
        try {
            $room_id =  DB::table('rooms')->insertGetId($data);
            if ($request->file('filenames')) {
                foreach($request->file('filenames') as $file)
                {
                    $filename = $file->store('public/images');
                    $data_img = [
                        'image' => 'storage' . explode('public', $filename)[1],
                        'room_id' => $room_id,
                    ];
                    DB::table('room_images')->insert($data_img);
                }
            }
            DB::commit();
            return redirect()->back()->with('success', $user->role == 1 ? 'Đăng bài thành công!' : 'Đăng bài thành công chờ admin phê duyệt!');
        } catch (\Exception $err) {
            DB::rollBack();
            Session::flash('error','Đăng bài thất bại!!');
            Log::info($err->getMessage());
            return redirect()->back()->with('error', 'Đăng bài thất bại!!');
        }
    }

    public function edit(Request $request, $id)
    {
        $room_image = RoomImage::where('room_id', $id)->pluck('image');
        $districtList = District::where('province_id', 1)->pluck('id')->toArray();
        $districts= District::where('province_id', 1)->get();
        $wards= Ward::whereIn('district_id', $districtList)->get();
        $room = Room::where('id', $id)->first();
        $room_address = explode(',',$room->detail_address)[0];
        return view('post.edit', [
            'districts' => $districts,
            'room' => $room,
            'wards' => $wards,
            'room_address' => $room_address,
            'list_images' => $room_image,
            'id' => $id
        ]);
    }

    public function update(Request $request, $id){
        $room = Room::where('id', $id)->first();
        $province = Province::whereId($request->province_id)->first();
        $district = District::whereId($request->district_id)->first();
        $ward = Ward::whereId($request->ward_id)->first();
        $detail_address = $request->street.', '.$ward->name.', '.$district->name.', '.$province->name;
        $data = [
            'title' => $request->title,
            'content' => $request->input('content'),
            'ward_id' => $request->ward_id,
            'district_id' => $request->district_id,
            'province_id' => $request->province_id,
            'detail_address' => $detail_address,
            'rent_type_id' => $request->rent_type_id,
            'videoUrl' => $request->file,
            'area' => $request->area,
            'price' => $request->price,
            'user_id' => Auth::user()->id,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        DB::beginTransaction();
        try {
            RoomImage::where('room_id',$request->id)->delete();
            $files = [];
            if($request->hasfile('filenames'))
            {
                foreach($request->file('filenames') as $file)
                {
                    $filename = $file->store('public/images');
                    $filename = 'storage' . explode('public', $filename)[1];
                    $files[] = $filename;
                }
            }
            if (isset($request->images_uploaded)) {
                $files_remove = array_diff(json_decode($request->images_uploaded_origin), $request->images_uploaded);
                $files = array_merge($request->images_uploaded, $files);
            } else {
                $files_remove = json_decode($request->images_uploaded_origin);
            }
            foreach ($files as $file) {
                DB::table('room_images')->where('room_id', $request->id)->insert([
                    'room_id' => $request->id,
                    'image' => $file
                ]);
            }
            foreach ($files_remove as $file_name) {
                File2::delete($file_name);
            }
            $room->update($data);
            DB::commit();
            return redirect()->back()->with('success', 'Thay đổi thành công!');
        } catch (\Exception $err) {
            DB::rollBack();
            Session::flash('error','Cập nhật thất bại!!');
            Log::info($err->getMessage());
            return redirect()->back()->with('error', 'Cập nhật thất bại!!');
        }
    }

    public function delete(Request $request, $id)
    {
        $data = $request->all();
        if (empty(Room::find($id))) {
            return redirect()->back()->with('error','không có dữ liệu');
        }
        DB::beginTransaction();
        try {
            $files_remove = RoomImage::where('room_id', $id)->pluck('image');
            Room::where('id',$id)->delete();
            RoomImage::where('room_id',$id)->delete();
            foreach ($files_remove as $file_name) {
                File2::delete($file_name);
            }
            DB::commit();
            Session::flash('success','xoá thành công');
        } catch (\Exception $err) {
            DB::rollBack();
            Session::flash('error','xóa thất bại');
            Log::info($err->getMessage());
        }
        return redirect()->back();
    }

    public function report(Request $request) {
        try {
            $validated = $request->validate([
                'room_id' => 'required',
                'title' => 'required',
                'description' => 'required',
                'fullname' => 'required',
                'phone' => 'required',
            ]);

            $listReportThisRoom = DB::table('reports')->where('room_id', $request->room_id)->get();
            foreach($listReportThisRoom as $reportThisRoom) {
                if(Auth::user()->id == $reportThisRoom->user_id){
                    Session::flash('success','Bạn đã báo cáo bài viết trước đây');
                    return redirect()->back();
                }
            }

            $data = [
                'room_id' => $request->room_id,
                'title' => $request->title,
                'description' => $request->description,
                'fullname' => $request->fullname,
                'phone' => $request->phone,
                'user_id' => Auth::user()->id,
            ];
            Report::create($data);
            Session::flash('success','báo cáo thành công');
        } catch (\Exception $err) {
            Log::info($err->getMessage());
            Session::flash('error','báo cáo thất bại');
        }
        return redirect()->back();
    }
}

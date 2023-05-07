<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Report;
use App\Models\Room;
use App\Models\RoomImage;
use App\Models\User;
use Carbon\Carbon;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Kjmtrue\VietnamZone\Models\District;
use Kjmtrue\VietnamZone\Models\Province;
use Kjmtrue\VietnamZone\Models\Ward;
use Illuminate\Support\Facades\File as File2;
use function Symfony\Component\Mime\Header\all;

class RoomController extends Controller
{
    public function index() {
        $data['rooms'] = Room::orderBy('created_at', 'desc')->get();
        return view('admin.rooms.index', $data);
    }

    public function searchStatus(Request $request) {
        $data['rooms'] = Room::orderBy('created_at', 'desc')->where('status',$request->status)->get();
        return view('admin.rooms.index', $data);
    }

    public function create()
    {
        $data['districts'] = District::where('province_id', 1)->get();
        return view('admin.rooms.create', $data);
    }

    public function store(Request $request)
    {
        $province = Province::whereId($request->province_id)->first();
        $district = District::whereId($request->district_id)->first();
        $ward = Ward::whereId($request->ward_id)->first();
        $detail_address = $request->street.', '.$ward->name.', '.$district->name.', '.$province->name;
        $data = [
            'status' => 1,
            'title' => $request->title,
            'content' => $request->input('content'),
            'ward_id' => $request->ward_id,
            'district_id' => $request->district_id,
            'province_id' => $request->province_id,
            'detail_address' => $detail_address,
            'videoUrl' => $request->file,
            'rent_type_id' => $request->rent_type_id,
            'area' => $request->area,
            'price' => $request->price,
            'user_id' => Auth::user()->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        DB::beginTransaction();
        try {
            $room_id =  DB::table('rooms')->insertGetId($data);
            if ($request->file('filenames')) {
                foreach($request->file('filenames') as $file)
                {
                    $filename = $file->store('public/images/');
                    $data_img = [
                        'image' => 'storage/' . explode('public', $filename)[1],
                        'room_id' => $room_id,
                    ];
                    DB::table('room_images')->insert($data_img);
                }
            }
            DB::commit();
            return redirect()->back()->with('success', 'Đăng bài thành công!');
        } catch (\Exception $err) {
            DB::rollBack();
            Session::flash('error','Đăng bài thất bại!!');
            \Log::info($err->getMessage());
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
        return view('admin.rooms.edit', [
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
            'created_at' => Carbon::now(),
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
                    $filename = $file->store('public/images/');
                    $filename = 'storage/' . explode('public', $filename)[1];
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
            \Log::info($err->getMessage());
            return redirect()->back()->with('error', 'Cập nhật thất bại!!');
        }
    }
    /**
     * Controller function delete room
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Request $request)
    {
        $data = $request->all();
        if (empty(Room::find($data['id']))) {
            return redirect()->back()->with('error','không có dữ liệu');
        }
        DB::beginTransaction();
        try {
            $files_remove = RoomImage::where('room_id',$data['id'])->pluck('image');
            Room::where('id',$data['id'])->delete();
            RoomImage::where('room_id',$data['id'])->delete();
            foreach ($files_remove as $file_name) {
                File2::delete($file_name);
            }
            DB::commit();
            Session::flash('success','xoá thành công');
        } catch (\Exception $err) {
            DB::rollBack();
            Session::flash('error','xóa thất bại');
            \Log::info($err->getMessage());
        }
        return redirect()->back();
    }

    public function confirm(Request $request){
        $data = $request->all();
        if (empty(Room::find($data['id']))) {
            return redirect()->back()->with('error','không có dữ liệu');
        }
        try {
            Room::where('id',$data['id'])->update([
                'status' => 1,
                'updated_at' => Carbon::now()
            ]);
            Session::flash('success','duyệt bài thành công');
        } catch (\Exception $err) {
            Session::flash('error','duyệt bài không thành công');
            \Log::info($err->getMessage());
        }
        return redirect()->back();
    }

    public function cancel(Request $request){
        $data = $request->all();
        if (empty(Room::find($data['id']))) {
            return redirect()->back()->with('error','không có dữ liệu');
        }
        try {
            Room::where('id',$data['id'])->update([
                'status' => 2,
                'updated_at' => Carbon::now()
            ]);
            Session::flash('success','Hủy bài đăng thành công');
        } catch (\Exception $err) {
            Session::flash('error','Hủy bài đăng không thành công');
            \Log::info($err->getMessage());
        }
        return redirect()->back();
    }

    public function fetchDistrict(Request $request)
    {
        $data['districts'] = District::where("province_id", $request->province_id)
            ->get();
        return response()->json($data);
    }

    public function fetchWard(Request $request)
    {
        $data['wards'] = Ward::where("district_id", $request->district_id)
            ->get();
        return response()->json($data);
    }

    public function listReport() {
        $reports = DB::table('reports')
            ->orderBy('room_id')
            ->get();
        return view('admin.report.index', [
            'reports' => $reports,
        ]);
    }
}

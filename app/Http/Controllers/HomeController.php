<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Kjmtrue\VietnamZone\Models\District;

class HomeController extends Controller
{
    public function index(Request $request) {
        $schools = DB::table('schools')->get();
        $request->flush();
        Carbon::setLocale('vi');
        $rooms = Room::where('status','1')->paginate(6);
        $search_latests = Room::orderBy('created_at','DESC')->where('status','1')->paginate(6);
        $districts = District::get(["id", "name"])->where('id','<=','30');
        $ratings = [];
        foreach($rooms as $room) {
            $ratings[]=round(Review::where('room_id',$room->id)->whereNotNull('user_id')->get()->avg('rate_star'));
        }
        $ratings_latest = [];
        foreach($search_latests as $room) {
            $ratings_latest[]=round(Review::where('room_id',$room->id)->whereNotNull('user_id')->get()->avg('rate_star'));
        }
        return view('home', ['rooms' => $rooms, 'districts' => $districts, 'search_latests' => $search_latests, 'schools' => $schools, 'ratings' => $ratings, 'ratings_latest' => $ratings_latest]);
    }

    private function get_query($request, $type_id) {
        if (!empty($type_id)) {
            $rent_type_id = $type_id;
        }
        else {
            $rent_type_id = $request->rent_type_id;
        }
        $district_id = $request->district_id;
        $min_price = $request->min_price;
        $max_price = $request->max_price;
        $min_area = $request->min_area;
        $max_area = $request->max_area;

        $query = Room::with('user');
        $school = DB::table('schools')->where('id',$request->school_id)->first();
        $query = $query->where('status', '1');
        if (!empty($district_id)) {
            $query = $query->where('district_id', $district_id);
        }
        if (!empty($rent_type_id)) {
            $query = $query->where('rent_type_id', $rent_type_id);
        }
        if (!empty($min_price)) {
            $query = $query->where('price', '>=', $min_price);
        }
        if (!empty($max_price)) {
            $query = $query->where('price', '<=', $max_price);
        }
        if (!empty($min_area)) {
            $query = $query->where('area', '>=', $min_area);
        }
        if (!empty($max_area)) {
            $query = $query->where('area', '<=', $max_area);
        }
        if (!empty($school->id_address)) {
            $query = $query->where('district_id', '=', $school->id_address);
        }
        return $query;
    }

    public function motel(Request $request) {
        $schools = DB::table('schools')->get();
        Carbon::setLocale('vi');
        $query = $this->get_query($request, '1');
        $rooms = $query->where('status','1')->paginate(6);
        $search_latests = $query->orderBy('created_at','DESC')->paginate(6);
        $districts = District::get(["id", "name"]);
        $request->flash();
        $old_input = $request->session()->getOldInput();
        $old_input['rent_type_id'] = '1';
        $request->session()->put('_old_input', $old_input);
        $ratings = [];
        foreach($rooms as $room) {
            $ratings[]=round(Review::where('room_id',$room->id)->whereNotNull('user_id')->get()->avg('rate_star'));
        }
        $ratings_latest = [];
        foreach($search_latests as $room) {
            $ratings_latest[]=round(Review::where('room_id',$room->id)->whereNotNull('user_id')->get()->avg('rate_star'));
        }
        return view('home', ['rooms' => $rooms, 'districts' => $districts, 'search_latests' => $search_latests, 'schools' => $schools, 'ratings' => $ratings, 'ratings_latest' => $ratings_latest]);
    }

    public function wholeHouse(Request $request) {
        $schools = DB::table('schools')->get();
        Carbon::setLocale('vi');
        $query = $this->get_query($request, '2');
        $rooms = $query->where('status','1')->paginate(6);
        $search_latests = $query->orderBy('created_at','DESC')->paginate(6);
        $districts = District::get(["id", "name"]);
        $request->flash();
        $old_input = $request->session()->getOldInput();
        $old_input['rent_type_id'] = '2';
        $request->session()->put('_old_input', $old_input);
        $ratings = [];
        foreach($rooms as $room) {
            $ratings[]=round(Review::where('room_id',$room->id)->whereNotNull('user_id')->get()->avg('rate_star'));
        }
        $ratings_latest = [];
        foreach($search_latests as $room) {
            $ratings_latest[]=round(Review::where('room_id',$room->id)->whereNotNull('user_id')->get()->avg('rate_star'));
        }
        return view('home', ['rooms' => $rooms, 'districts' => $districts, 'search_latests' => $search_latests, 'schools' => $schools, 'ratings' => $ratings, 'ratings_latest' => $ratings_latest]);
    }

    public function search(Request $request)
    {
        // TODO: Check min_price <= max_price
        // TODO: Check min_area <= max_area
        $schools = DB::table('schools')->get();
        Carbon::setLocale('vi');
        $query = $this->get_query($request, '');
        $rooms = $query->paginate(6);
        $search_latests = $query->orderBy('created_at','DESC')->paginate(6);
        $districts = District::get(["id", "name"]);
        $request->flash();
        $ratings = [];
        foreach($rooms as $room) {
            $ratings[]=round(Review::where('room_id',$room->id)->whereNotNull('user_id')->get()->avg('rate_star'));
        }
        $ratings_latest = [];
        foreach($search_latests as $room) {
            $ratings_latest[]=round(Review::where('room_id',$room->id)->whereNotNull('user_id')->get()->avg('rate_star'));
        }

        return view('home', ['rooms' => $rooms, 'districts' => $districts, 'search_latests' => $search_latests, 'schools' => $schools, 'ratings' => $ratings, 'ratings_latest' => $ratings_latest]);
    }
}

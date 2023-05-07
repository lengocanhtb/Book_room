<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class CommentController extends Controller
{
    public function comment(Request $request) {
        try {
            $data = [
                'comment' => $request->input('comment'),
                'rate_star' => $request->rating,
                'room_id' => $request->input('room_id'),
                'user_id' => Auth::user()->id,
            ];
            Review::create($data);
            Session::flash('success','Đánh giá thành công');
        }catch (\Exception $err){
            Log::error($err);
        }
        return redirect()->back();
    }
}

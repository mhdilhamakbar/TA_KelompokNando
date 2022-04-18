<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\User;
use Carbon\Carbon;
use DB;
use App\Models\Student;
use Auth;
use Validator;

class UserController extends Controller
{
    public function dashboard(){
        return view('user.dashboard');
    }
    public function showBookingPage(){
        return view('user.booking_room');
    }
    public function showRoomListPage(){
        $list_rooms = Reservation::select('reservations.*','r.room_number','u.name')
                                    ->leftJoin('users as u','reservations.user_id','u.id')
                                    ->leftJoin('rooms as r','reservations.room_id','r.id')
                                    ->get();
        foreach($list_rooms as $room){
            $room->date = Carbon::parse($room->start)->format('Y-m-d');
        }
        return view('user.room_list',compact('list_rooms'));
    }
    public function showBookingHistoryPage(){
        $user = Auth::user();
        $book_history = Reservation::select('reservations.*','r.room_number','u.name')
                                    ->leftJoin('users as u','reservations.user_id','u.id')
                                    ->leftJoin('rooms as r','reservations.room_id','r.id')
                                    ->where('reservations.user_id',$user->id)
                                    ->get();
        foreach($book_history as $room){
            $room->date = Carbon::parse($room->start)->format('Y-m-d');
        }
        return view('user.booking_history',compact('book_history'));
    }
    public function getRoomInfo(Request $request){
        $req = $request->all();
        $r_id = $req['id'];
        $room_info = Reservation::join('rooms as r','r.id','reservations.room_id')->where('reservations.id',$r_id)->first();
        $room_info->location = substr($room_info->reservation_code,0,2) == "AD" ? "Aryaduta" : "Lippo Mall";
        $room_info->date = Carbon::parse($room_info->start)->format('Y-m-d');
        return $room_info;
    }
    public function getBookInfo(Request $request){
        $req = $request->all();
        $r_id = $req['id'];
        $room_info = Reservation::join('rooms as r','r.id','reservations.room_id')
                                    ->join('users as u','u.id','reservations.user_id')
                                    ->join('students as s','s.user_id','reservations.user_id')
                                    ->where('reservations.id',$r_id)
                                    ->first();
        $room_info->location = substr($room_info->reservation_code,0,2) == "AD" ? "Aryaduta" : "Lippo Mall";
        $room_info->date = Carbon::parse($room_info->start)->format('Y-m-d');
        return $room_info;
    }
    public function bookRoom(Request $request){
        $user = Auth::user();
        $req = $request->all();
        $validator = Validator::make($req,[
            'room_id' => ['required'],
            'name' => ['required'],
            'nim' => ['required'],
            'class' => ['required'],
            'desc' => ['required']
        ]);
        if($validator->fails()){
            return redirect()->back()->with('error',"Please check your form again");
        }
        DB::beginTransaction();
        try{
            Reservation::where('id',$req['room_id'])->update([
                'user_id' => $user->id,
                'description' => $req['desc'],
                'reservation_status_id' => 'pending'
            ]);
            if(!Student::where('user_id',$user->id)->exists()){
                Student::create([
                    'user_id' => $user->id,
                    'class' => $req['class'],
                    'nim' => $req['nim']
                ]);
            }
            DB::commit();
            return view('user.booking_room')->with('success','Succeed Book Room');
        }
        catch(Exception $e){
            DB::rollback();
            return redirect()->back()->with('error',$e);
        }
    }
    public function cancelBook(Request $request){
        $req = $request->all();
        $validator = Validator::make($req,[
            'b_id' => ['required']
        ]);
        if($validator->fails()){
            return redirect()->back()->with('error',"Please check your form again");
        }
        Reservation::where('id',$req['b_id'])->update([
            'reservation_status_id' => 'decline'
        ]);
        return redirect()->view('user.booking_room')->with('success','Your booking has been declined');
    }
    public function searchAvailRoom(Request $request){
        $req = $request->all();
        $validator = Validator::make($req,[
            'booking_date' => ['required'],
            'start_time' => ['required'],
            'end_time' => ['required'],
        ]);
        if($validator->fails()){
            return redirect()->back()->with('error',"Please check your form again");
        }
        $start = Carbon::parse($req['booking_date'].' '.$req['start_time'])->toDateTimeString();
        $end = Carbon::parse($req['booking_date'].' '.$req['end_time'])->toDateTimeString();
        $list_rooms = Reservation::select('reservations.*','r.room_number','u.name')
                ->leftJoin('users as u','reservations.user_id','u.id')
                ->leftJoin('rooms as r','reservations.room_id','r.id')            
                ->whereBetween('start',[$start,$end])
                ->get();
        foreach($list_rooms as $room){
            $room->date = Carbon::parse($room->start)->format('Y-m-d');
        }
        return view('user.room_list',compact('list_rooms'));
    }
}

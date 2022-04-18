<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use Hash;
use App\Models\Location;
use App\Models\Attendance;
use App\Models\Room;
use Carbon\Carbon;
use App\Models\Reservation;

class AdminController extends Controller
{
    public function sa_dashboard(){
        $list_admin = User::where('role','!=','member')->get();
        return view('admin.sa.dashboard',compact('list_admin'));
    }
    public function fed_dashboard(){
        return view('admin.fed.dashboard');
    }
    public function ssc_dashboard(){
        return view('admin.ssc.dashboard');
    }
    public function itemManagement(){
        return view('admin.ssc.item_management');
    }
    public function itemHistory(){
        return view('admin.ssc.item_history');
    }
    public function showItemList(){
        return view('admin.ssc.item_list');
    }
    public function requestItemList(){
        return view('admin.ssc.request_item');
    }
    public function attendancePage(){
        $list_location = Location::all();
        $list_lecture = User::where('role','lc')->get();
        $list_room_ad = Room::join('locations as l','l.id','rooms.location_id')->where('l.code','AD')->get();
        $list_room_lp = Room::join('locations as l','l.id','rooms.location_id')->where('l.code','LP')->get();
        
        $list_attendance = Attendance::select('attendances.*','r.room_number','l.name as location','u.name as lecture_name')
                                        ->join('locations as l','l.id','attendances.location_id')
                                        ->join('users as u','u.id','attendances.user_id')
                                        ->join('rooms as r','r.id','attendances.room_id')
                                        ->get();
        foreach($list_attendance as $attendance){
            $attendance->date = Carbon::parse($attendance->created_at)->format('d-m-Y');            
        }
        return view('admin.fed.attendance',compact('list_location','list_lecture','list_room_ad','list_room_lp','list_attendance'));
    }
    public function roomManagementPage(){
        $key = isset($_GET['s']) ? $_GET['s'] : '';
        if($key == 'ac'){
            $key = "accept";
        }
        else if ($key == "dc"){
            $key = "decline";
        }
        else if ($key == "rj"){
            $key = "rejected";
        }
        else if ($key == "pd"){
            $key = "pending";
        }
        if($key != ''){
            $list_res = Reservation::select('reservations.*','r.room_number','u.name','s.nim','s.class')
                    ->leftJoin('users as u','reservations.user_id','u.id')
                    ->leftJoin('students as s','reservations.user_id','s.user_id')
                    ->leftJoin('rooms as r','reservations.room_id','r.id')
                    ->where('reservation_status_id','LIKE',$key)
                    ->where('reservations.user_id','!=',null)
                    ->get();
        }
        else {
            $list_res = Reservation::select('reservations.*','r.room_number','u.name','s.nim','s.class')
                    ->leftJoin('users as u','reservations.user_id','u.id')
                    ->leftJoin('students as s','reservations.user_id','s.user_id')
                    ->leftJoin('rooms as r','reservations.room_id','r.id')
                    ->where('reservations.user_id','!=',null)
                    ->get();
        }
        foreach($list_res as $room){
            $room->date = Carbon::parse($room->start)->format('Y-m-d');
        }
        return view('admin.fed.room_management',compact('list_res'));
    }
    public function infoAttendance(Request $request){
        $req = $request->all();
        $id = $req['id'];
        $att_info = Attendance::select('attendances.*','r.room_number','l.code as location','u.name as lecture_name','l.name as location_fname')
                                        ->join('locations as l','l.id','attendances.location_id')
                                        ->join('users as u','u.id','attendances.user_id')
                                        ->join('rooms as r','r.id','attendances.room_id')->where('attendances.id',$id)->first();
        $att_info->date = Carbon::parse($att_info->created_at)->format('Y-m-d');
        $att_info->marker_collect_at = Carbon::parse($att_info->marker_collect_at)->format('H:i:s');
        $att_info->marker_return_at = Carbon::parse($att_info->marker_return_at)->format('H:i:s');
        $att_info->attendance_collect_at = Carbon::parse($att_info->attendance_collect_at)->format('H:i:s');
        $att_info->attendance_return_at = Carbon::parse($att_info->attendance_return_at)->format('H:i:s');
        
        return $att_info;
    }
    



    public function add_admin(Request $request){
        $req = $request->all();
        $validator = Validator::make($req,[
            'email' => ['unique:users','required'],
            'name' => ['required'],
            'role' => ['required']
        ]);
        if($validator->fails()){
            return redirect()->back()->with('error',"Please check your form again");
        }
        $password = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 5)), 0, 5);
        User::create([
            'email' => $req['email'],
            'name' => $req['name'],
            'password' => Hash::make($password),
            'role' => $req['role']
        ]);
        return redirect()->back()->with('success','Create new account success ! Temporary password is :'.$password);
    }
    public function addAttendance(Request $request){
        $req = $request->all();
        $validator = Validator::make($req,[
            'l_name' => ['required'],
            'location' => ['required'],
            'class' => ['required'],
            'room' => ['required'],
            'date' => ['required'],
            'mk_pick' => ['required'],
            'mk_rtn' => ['required'],
            'at_pick' => ['required'],
            'at_rtn' => ['required'],
        ]);
        if($validator->fails()){
            return redirect()->back()->with('error',$validator->errors());
        }
        $loc_id = Location::where('code',$req['location'])->first()->id;
        $req['mk_pick'] = Carbon::parse($req['mk_pick'])->format('Y-m-d H:i:s');
        $req['mk_rtn'] = Carbon::parse($req['mk_rtn'])->format('Y-m-d H:i:s');
        $req['at_pick'] = Carbon::parse($req['at_pick'])->format('Y-m-d H:i:s');
        $req['at_rtn'] = Carbon::parse($req['at_rtn'])->format('Y-m-d H:i:s');
        Attendance::create([
            'user_id' => $req['l_name'],
            'location_id' => $loc_id,
            'room_id' => $req['room'],
            'class' => $req['class'],
            'marker_collect_at' => $req['mk_pick'],
            'marker_return_at' => $req['mk_rtn'],
            'attendance_collect_at' => $req['at_pick'],
            'attendance_return_at' => $req['at_rtn'],
        ]);
        return redirect()->back()->with('success','Data Created');       
    }
    public function editAttendance(Request $request){
        $req = $request->all();
        $validator = Validator::make($req,[
            'edit_id' => ['required'],
            'l_name_ed' => ['required'],
            'loc_ed' => ['required'],
            'class_ed' => ['required'],
            'room_ed' => ['required'],
            'date_ed' => ['required'],
            'mk_pick_ed' => ['required'],
            'mk_rtn_ed' => ['required'],
            'att_pick_ed' => ['required'],
            'att_rtn_ed' => ['required'],
        ]);
        if($validator->fails()){
            return redirect()->back()->with('error',$validator->errors());
        }
        $loc_id = Location::where('code',$req['loc_ed'])->first()->id;
        $req['mk_pick_ed'] = Carbon::parse($req['mk_pick_ed'])->format('Y-m-d H:i:s');
        $req['mk_rtn_ed'] = Carbon::parse($req['mk_rtn_ed'])->format('Y-m-d H:i:s');
        $req['att_pick_ed'] = Carbon::parse($req['att_pick_ed'])->format('Y-m-d H:i:s');
        $req['att_rtn_ed'] = Carbon::parse($req['att_rtn_ed'])->format('Y-m-d H:i:s');
        $req['date_ed'] = Carbon::parse($req['date_ed'])->format('Y-m-d H:i:s');
        try {
            Attendance::where('id',$req['edit_id'])->update([
                'user_id' => $req['l_name_ed'],
                'location_id' => $loc_id,
                'room_id' => $req['room_ed'],
                'class' => $req['class_ed'],
                'marker_collect_at' => $req['mk_pick_ed'],
                'marker_return_at' => $req['mk_rtn_ed'],
                'attendance_collect_at' => $req['att_pick_ed'],
                'attendance_return_at' => $req['att_rtn_ed'],
                'created_at' => $req['date_ed']
            ]);
            return redirect()->back()->with('success','Data Edited');
        }
        catch (Exception $e){
            return redirect()->back()->with('error',$e->message());
        }
    }
    public function acceptBook($id){
        $room = Reservation::where('id',$id)->first();
        if($room->reservation_status_id != 'pending'){
            return redirect()->back()->with('error','Please check your booking id');
        }
        else {
            Reservation::where('id',$id)->update([
                'reservation_status_id' => 'accept'
            ]);
        }
        return redirect()->back()->with('success','Booking accepted');
    }
    public function cancelBook($id){
        $room = Reservation::where('id',$id)->first();
        if($room->reservation_status_id != 'pending'){
            return redirect()->back()->with('error','Please check your booking id');
        }
        else {
            Reservation::where('id',$id)->update([
                'reservation_status_id' => 'rejected'
            ]);
        }
        return redirect()->back()->with('success','Booking rejected');
    }
}

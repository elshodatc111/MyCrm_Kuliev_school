<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Room;
use App\Models\Guruh;
use App\Models\GuruhUser;
use App\Models\TestNatija;
use App\Models\GuruhTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;

class UserGuruhController extends Controller{
    public function __construct(){
        $this->middleware('auth');
    }
    public function Guruhlar(){
        $Guruh = GuruhUser::where('user_id',Auth::user()->id)->where('status','true')->get();
        $New = "https://atko.tech/NiceAdmin/assets/img/cours_new.jpg";
        $End = "https://atko.tech/NiceAdmin/assets/img/cours_end.jpg";
        $Now = "https://atko.tech/NiceAdmin/assets/img/cours_activ.jpg";
        $Guruhlar = array();
        foreach($Guruh as $key=>$item){
            $Guruhlar[$key]['id'] = $item->guruh_id;
            $Guruhlar[$key]['name'] = Guruh::find($item->guruh_id)->guruh_name;
            $guruh_start = Guruh::find($item->guruh_id)->guruh_start;
            $guruh_end = Guruh::find($item->guruh_id)->guruh_end;
            $thisNow = date("Y-m-d");
            if($guruh_end<$thisNow){
                $Guruhlar[$key]['image'] = $End;
            }elseif($guruh_start>$thisNow){
                $Guruhlar[$key]['image'] = $New;
            }elseif($guruh_start<$thisNow AND $guruh_end>$thisNow){
                $Guruhlar[$key]['image'] = $Now;
            }else{
                $Guruhlar[$key]['image'] = $End;
            }
            $Guruhlar[$key]['start'] = $guruh_start;
            $Guruhlar[$key]['end'] = $guruh_end;
        }
        return view('User.guruh',compact('Guruhlar'));
    }
    public function show($id){
        $Guruh = Guruh::find($id);
        $Guruhs = array();
        switch ($Guruh->guruh_vaqt) {
            case '1':
                $Guruhs['guruh_vaqt'] = "08:00-09:30";
                break;
            case '2':
                $Guruhs['guruh_vaqt'] = "09:30-11:00";
                break;
            case '3':
                $Guruhs['guruh_vaqt'] = "11:00-12:30";
                break;
            case 4:
                $Guruhs['guruh_vaqt'] = "12:30-14:00";
                break;
            case '5':
                $Guruhs['guruh_vaqt'] = "14:00-15:30";
                break;
            case '6':
                $Guruhs['guruh_vaqt'] = "15:30-17:00";
                break;
            case '7':
                $Guruhs['guruh_vaqt'] = "17:00-18:30";
                break;
            case '8':
                $Guruhs['guruh_vaqt'] = "18:30-20:00";
                break;
            case '9':
                $Guruhs['guruh_vaqt'] = "20:00-21:30";
                break;
        }
        $Guruhs['guruh_name'] = $Guruh->guruh_name;
        $Guruhs['guruh_price'] = $Guruh->guruh_price;
        $Guruhs['techer'] = User::find($Guruh->techer_id)->name;
        $Guruhs['test'] = 0;
        $Guruhs['room'] = Room::find($Guruh['room_id'])->room_name;
        $Guruhs['cours_id'] = $Guruh->cours_id;
        $GuruhTime = GuruhTime::where('guruh_id',$Guruh['id'])->get();
        $CountDates = count($GuruhTime);
        $endData = 0;
        foreach ($GuruhTime as $key => $value) {
            $endData = $value->dates;
        }
        $TestNatija = count(TestNatija::where('guruh_id',$id)->where('user_id',Auth::user()->id)->get());
        if($endData<=date("Y-m-d")){
            if($TestNatija==0){
                $Tests = 'true';
            }else{
                $Tests = "Natija";
            }
        }else{
            $Tests = $endData;
        }
        return view('User.guruh_show',compact('id','Guruhs','GuruhTime','CountDates','Tests'));
    }
    
}

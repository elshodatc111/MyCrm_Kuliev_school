<?php

namespace App\Http\Controllers\User;

use App\Models\Guruh;
use App\Models\GuruhUser;
use App\Models\Tulov;
use App\Models\Room;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;

class UserController extends Controller{
    public function __construct(){
        $this->middleware('auth');
    } 
    public function coocies(){
        if(Auth::user()->filial_id != request()->cookie('filial_id')){
            if(Auth::user()->type != 'SuperAdmin'){
                Auth::logout();
                return view('home')->withCookie('filial_id', ' ', -86400)->withCookie('filial_name', ' ', -86400);
            }
        }
        if(!request()->cookie('filial_name')){
            return view('home')->withCookie('filial_id', ' ', -86400)->withCookie('filial_name', ' ', -86400);
        }
    }
    public function index(){
        $this->coocies();
        $GuruhUser = GuruhUser::where('guruh_users.user_id',Auth::user()->id)
            ->join('guruhs','guruhs.id','guruh_users.guruh_id')
            ->where('guruh_users.status','true')
            ->select('guruhs.guruh_start','guruhs.guruh_end','guruhs.guruh_price','guruhs.guruh_name',
                'guruhs.guruh_chegirma','guruhs.created_at')
            ->get();
        $now = date('Y-m-d');
        $New = 0;
        $Activ = 0;
        $End = 0;
        $Stat = array();
        foreach ($GuruhUser as $key => $value) {
            if($value->guruh_end<$now){
                $End = $End + 1;
            }elseif($value->guruh_start<$now){
                $New = $New + 1;
            }else{
                $Activ = $Activ + 1;
            }
        }
        $Stat['new'] = $New;
        $Stat['activ'] = $Activ;
        $Stat['end'] = $End;
        
        $endTimestamp = date("Y-m-d",strtotime('-3 day',time()));
        $GuruhUser2 = GuruhUser::where('guruh_users.user_id',Auth::user()->id)
            ->join('guruhs','guruhs.id','guruh_users.guruh_id')
            ->where('guruh_users.status','true')
            ->where('guruhs.guruh_start','>',$endTimestamp)
            ->select('guruhs.guruh_start','guruhs.id','guruhs.guruh_end','guruhs.guruh_price','guruhs.guruh_name',
                'guruhs.guruh_chegirma','guruhs.created_at')
            ->get();
        $CHegirma = array();
        foreach($GuruhUser2 as $key => $value){
            $Tulov = count(Tulov::where('user_id',Auth::user()->id)->where('type','Chegirma')->where('guruh_id',$value->id)->get());
            if($Tulov==0){
                $CHegirma[$key]['id'] = $value->id;
                $CHegirma[$key]['guruh_name'] = $value->guruh_name;
                $CHegirma[$key]['guruh_price'] = number_format(($value->guruh_price), 0, '.', ' ');
                $CHegirma[$key]['guruh_chegirma'] = number_format(($value->guruh_chegirma), 0, '.', ' ');
                $CHegirma[$key]['summa'] = $value->guruh_chegirma;
                $CHegirma[$key]['tulov'] = number_format(($value->guruh_price-$value->guruh_chegirma), 0, '.', ' ');
            }
        }
        #$GuruhUser->where('guruhs.guruh_start')
        #dd($CHegirma);
        


        return view('User.index',compact('Stat','CHegirma'));
    }
    public function Kabinet(){
        return view('User.kabinet');
    }
}

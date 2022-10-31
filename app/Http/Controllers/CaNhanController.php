<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class CaNhanController extends Controller
{
    //Khai báo các quyền đựa theo KeyCloak
    private $giangVien = 'giangvien';
    private $sinhVien = 'sinhvien';
    private $quanTriVien = 'admin';
    private $covanhoctap='covanhoctap';
    private function redirect()
    {
        if($this->isQuanTriVien())
        {
            //Quản trị
            return redirect()->action('App\Http\Controllers\HeDaoTaoController@getViewHeDaoTao');
        }
        else if($this->isGiangVien())
        {
            return redirect()->action('App\Http\Controllers\GiaoDienGiangVienController@giaoDienGiangVien',session()->get('id'));
        }
        else
        {
            return redirect()->action('App\Http\Controllers\GiaoDienSinhVienController@giaoDien');
//            return redirect()->action('App\Http\Controllers\HocPhanController@giaoDien');
        }
    }

    public function callback(Request $r)
    {
        $user = Socialite::driver('keycloak')->stateless()->user();
        $token = $user->token;
        $tokenParts = explode(".", $token);
        $tokenHeader = base64_decode($tokenParts[0]);
        $tokenPayload = base64_decode($tokenParts[1]);
        $jwtHeader = json_decode($tokenHeader);
        $jwtPayload = json_decode($tokenPayload);

      //  var_dump($jwtPayload);

        foreach($jwtPayload->realm_access->roles as $role)
        {
            session(['role'=>$role]);
        }
        session(['id'=>$jwtPayload->user->id]);
        session(['hoten'=>$jwtPayload->name]);
        session(['email'=>$jwtPayload->email]);
        return $this->redirect();
    }

    public function dangXuat(){
        session()->invalidate();
        $encodedRedirectUri = route('login');
         return redirect("http://sso.vlute.edu.vn/auth/realms/master/protocol/openid-connect/logout?redirect_uri=$encodedRedirectUri");
        
    }

    public function dangNhap()
    {
        return Socialite::driver('keycloak')->redirect();
    }

    public function isGiangVien()
    {
        if(session()->get('role') == $this->giangVien)
            return true;
        return false;
    }

    public function isSinhVien()
    {
        if(session()->get('role') == $this->sinhVien)
            return true;
        return false;
    }

    public function isQuanTriVien()
    {
        if(session()->get('role') == $this->quanTriVien)
            return true;
        return false;
    }
    public function isCoVanHocTap()
    {
        if(session()->get('role') == $this->covanhoctap)
            return true;
        return false;
    }
}

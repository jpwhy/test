<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *admin/user/add
     * @用户管理页
     */
    public function  getAdd()
    {
       return view('user.add');
    }

   //添加用户


//用户列表
    public  function getList(Request $request){
        $this->validate($request,[
            'username'=>'required',
            'nickname'=>'required',
            'password'=>'required',
            'repassword'=>'required | same:password',
            'email'=>'email',
        ],[
            'username'=>'用户名不能为空',
            'nickname'=>'昵称不能为空',
            'password'=>'密码不能为空',
            'repassword'=>'密码不一致',
            'email'=>'邮箱格式不正确',
        ] );
    $date = $request->only('username','reusername','password','repassword','email','role');
    $res = DB::table('user')->insert($date);
     if($res){
         echo 11;
     }else{
  echo 22;
     }

    }



}

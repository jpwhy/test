<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
        return view('user.list');
    }

    public  function getAdduser(Request $request){
        $this->validate($request,[
            'username'=>'required',
            'nikename'=>'required',
            'password'=>'required',
            'repassword'=>'required | same:password',
            'email'=>'email',
        ],[
            'username.required'=>'用户名不能为空',
            'nikename.required'=>'昵称不能为空',
            'password.required'=>'密码不能为空',
            'repassword.required'=>'确认密码不能为空',
            'repassword.same'=>'密码不一致',
            'email.email'=>'邮箱格式不正确',
        ] );
    $date = $request->only('username','nikename','password','repassword','email','role');
    $date['password'] =Hash::make($date['password']);
    $date['repassword'] =Hash::make($date['repassword']);
    $date['created_at'] = date("Y-m-d H:i:s",time());

    $res = DB::table('user')->insert($date);
     if($res){
         return redirect('admin/user/list')->with('info','添加成功');
     }else{
        return back()->with('error','添加失败');
     }

    }



}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


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

     //   dd($search);die;
       $user = DB::table('user')->where(function($query ) use($request)  {
           $query->where('username','like','%'.$request->input('keyword','').'%')->where('isdel','=','1');
        })->orderby('updated_at','desc')->paginate($request->input('prepage',10));

  //dd($user);die;
       return view('user.list')->with('user',$user)->with('keyword',$request->input('keyword',''))->with('prepage',$request->input('prepage'),'');
    }

    public  function getAdduser(Request $request){
//$Validator = Validator::make($request->all(),[
//    'username'=>'required',
//    'nikename'=>'required',
//    'password'=>'required',
//    'repassword'=>'required | same:password',
//    'email'=>'email',
//],[
//    'username.required'=>'用户名不能为空',
//    'nikename.required'=>'昵称不能为空',
//    'password.required'=>'密码不能为空',
//    'repassword.required'=>'确认密码不能为空',
//    'repassword.same'=>'密码不一致',
//    'email.email'=>'邮箱格式不正确',
//]);

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
    $date['updated_at'] = date("Y-m-d H:i:s",time());
    $date['created_at'] = date("Y-m-d H:i:s",time());

    $res = DB::table('user')->insert($date);
     if($res){
         return redirect('admin/user/list')->with('info','添加成功');
     }else{
       // return back()->with('error','添加失败');
         return back();
     }

    }
//用户编辑
    public function getEdit($id)
    {
        if($id){
            $res  = DB::table('user')->where('id',$id)->first();
        }
        if($res){
            return view('user.edit')->with('user',$res);
        }else{
            return back();
        }


    }
//用户更新
    public function getUpdate(Request $request)
    {
        $id = $request->input('uid','');
        $date['username'] =$request->input('username','');
        $date['nikename'] =$request->input('nikename','');
        $date['email'] =$request->input('email','');
        $date['role'] =$request->input('role','');
        $date['updated_at']=date("Y-m-d H:i:s");
       // dd($date);die;
        DB::beginTransaction();
        $res = DB::table('user')->where('id','=',$id)->update(['username'=>$date['username'],
                                                               'nikename'=>$date['nikename'],
                                                                'email'=>$date['email'],
                                                                'role'=>$date['role'],
                                                                 'updated_at'=>$date['updated_at'],
                                                              ]);
        if($res){
            DB::commit();
            return redirect('admin/user/list')->with('info','更新成功');
        }else{
            DB::rollBack();
            return back()->with('info','更新失败');
        }
    }
    //用户删除
    public function getDelete($id)
    {
        $res =  DB::table('user')->where('id',$id)->update(['isdel'=>0]);
        DB::beginTransaction();
        if($res){
             return redirect('admin/user/list')->with('info','删除成功');
        } else{
             return back();
        }
    }
//相册
    public function getPhoto()
    {
        return view('user.photo');
    }
}

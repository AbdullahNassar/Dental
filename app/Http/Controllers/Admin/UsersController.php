<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Hash;
use DB;

class UsersController extends Controller {


    public function getIndex() {
        $users = User::get();

        return view('admin.pages.users.index', compact('users'));
    }

    public function getUser($id)
    {
        if (isset($id)) {
            $users = DB::table('users')
                    ->select('users.*')
                    ->where('id', '=', $id)
                    ->get();

        return view('admin.pages.users.edit', compact('users'));
        }
    }

    public function getU($id)
    {
        if (isset($id)) {
        $users = DB::table('users')
                    ->select('users.*')
                    ->where('id', '=', $id)
                    ->get();

        return view('admin.pages.users.delete', compact('users'));
        }
    }

    public function deleteU($id)
    {
        if (isset($id)) {
            DB::table('users')->where('id','=', $id)->delete();
            $users = DB::table('users')
                    ->select('users.*')
                    ->get();

        return view('admin.pages.users.index', compact('users'));
        }
    }

    public function getAdd() {

        $users = DB::table('users')
                    ->select('users.*')
                    ->get();

        return view('admin.pages.users.add', compact('users'));
    }

    public function insertUser(Request $request)
    {
        $name = $request->input('name');
        $name_en = $request->input('name_en');
        $email = $request->input('email');
        $password = Hash::make('password', [
              'rounds' => 12
            ]);
        $image = $request->input('image');
        $username = $request->input('username');
        $about = $request->input('about');
        $phone = $request->input('phone');
        $facebook = $request->input('facebook');
        $twitter = $request->input('twitter');
        $linkedin = $request->input('linkedin');

        $data = array(
            'name'=>$name,
            'name_en'=>$name_en,
            'email'=>$email,
            'password'=>$password,
            'username'=>$username,
            'about'=>$about,
            'image'=>$image,
            'phone'=>$phone,
            'facebook'=>$facebook,
            'twitter'=>$twitter,
            'linkedin'=>$linkedin
            );

        DB::table('users')->insert($data);
        $users = DB::table('users')
                    ->select('users.*')
                    ->get();

        return view('admin.pages.users.index', compact('users'));
    }

    public function updateUser(Request $request)
    {
        $id = $request->input('s_id');
        $name = $request->input('name');
        $name_en = $request->input('name_en');
        $email = $request->input('email');
        $password = Hash::make('password', [
              'rounds' => 12
            ]);
        $image = $request->input('image');
        $username = $request->input('username');
        $about = $request->input('about');
        $phone = $request->input('phone');
        $facebook = $request->input('facebook');
        $twitter = $request->input('twitter');
        $linkedin = $request->input('linkedin');

        $data = array(
            'name'=>$name,
            'name_en'=>$name_en,
            'email'=>$email,
            'password'=>$password,
            'username'=>$username,
            'about'=>$about,
            'image'=>$image,
            'phone'=>$phone,
            'facebook'=>$facebook,
            'twitter'=>$twitter,
            'linkedin'=>$linkedin
            );

        DB::table('users')
            ->where('id','=', $id)
            ->update($data);

        $users = DB::table('users')
                    ->select('users.*')
                    ->get();

        return view('admin.pages.users.index', compact('users'));
    }

}

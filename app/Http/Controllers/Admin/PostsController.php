<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Posts;
use DB;

class PostsController extends Controller {


    public function getIndex() {
        $posts = DB::table('posts')
                    ->select('posts.*')
                    ->get();

        return view('admin.pages.posts.index', compact('posts'));
    }

    public function getPost($id)
    {
        if (isset($id)) {
            $posts = DB::table('posts')
                    ->join('users', 'users.id', '=', 'posts.user_id')
                    ->select('posts.*','users.name')
                    ->where('posts.id', '=', $id)
                    ->get();
            $users = DB::table('users')
                    ->select('users.*')
                    ->get();

        return view('admin.pages.posts.edit', compact('posts','users'));
        }
    }

    public function getP($id)
    {
        if (isset($id)) {
        $posts = DB::table('posts')
                    ->join('users', 'users.id', '=', 'posts.user_id')
                    ->select('posts.*','users.name')
                    ->where('posts.id', '=', $id)
                    ->get();
        $users = DB::table('users')
                    ->select('users.*')
                    ->get();

        return view('admin.pages.posts.delete', compact('posts','users'));
        }
    }

    public function deleteP($id)
    {
        if (isset($id)) {
            DB::table('posts')->where('id','=', $id)->delete();
            $posts = DB::table('posts')
                    ->select('posts.*')
                    ->get();

        return view('admin.pages.posts.index', compact('posts'));
        }
    }

    public function getAdd() {

        $users = DB::table('users')
                    ->select('users.*')
                    ->get();

        return view('admin.pages.posts.add', compact('users'));
    }

    public function insertPost(Request $request)
    {
        $title = $request->input('title');
        $title_en = $request->input('title_en');
        $content = $request->input('content');
        $content_en = $request->input('content_en');
        $image = $request->input('image');
        $user_id = $request->input('user_id');
        $_order = $request->input('_order');
        $active = $request->input('active');
        $date = $request->input('date');

        $data = array(
            'title'=>$title,
            'title_en'=>$title_en,
            'content'=>$content,
            'content_en'=>$content_en,
            'image'=>$image,
            'user_id'=>$user_id,
            '_order'=>$_order,
            'active'=>$active,
            'created_at'=>$date
            );

        DB::table('posts')->insert($data);
        $posts = DB::table('posts')
                    ->select('posts.*')
                    ->get();

        return view('admin.pages.posts.index', compact('posts'));
    }

    public function updatePost(Request $request)
    {
        $id = $request->input('s_id');
        $title = $request->input('title');
        $title_en = $request->input('title_en');
        $content = $request->input('content');
        $content_en = $request->input('content_en');
        $image = $request->input('image');
        $user_id = $request->input('user_id');
        $_order = $request->input('_order');
        $active = $request->input('active');
        $date = $request->input('date');

        $data = array(
            'title'=>$title,
            'title_en'=>$title_en,
            'content'=>$content,
            'content_en'=>$content_en,
            'image'=>$image,
            'user_id'=>$user_id,
            '_order'=>$_order,
            'active'=>$active,
            'created_at'=>$date
            );


        DB::table('posts')
            ->where('id','=', $id)
            ->update($data);

        $posts = DB::table('posts')
                    ->select('posts.*')
                    ->get();

        return view('admin.pages.posts.index', compact('posts'));
    }

}

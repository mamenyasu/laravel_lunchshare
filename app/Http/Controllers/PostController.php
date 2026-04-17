<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeleteRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PostRequest;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Services\ImageResizeService;
use Exception;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function showPost(){
        $json=file_get_contents(public_path('json/pref_city.json'));
        $data=json_decode($json,true);

    $posts=Post::latest()->paginate(10);

    return view('post',['posts' => $posts, 'data' => $data]);
    }

    public function post(PostRequest $request,ImageResizeService $imageService){
        $image_path=$imageService->resizeAndSave($request->file('image'),800,600,'posts');   
       // $image_path=$request->file('image')->store('posts','public'); 
        $data=$request->validated();
        $data['user_id']=Auth::id();
        $data['image_path']=$image_path;
    try{
        Post::create($data);
        return redirect()->route('post.success');
        }catch(Exception $e){
         return redirect()->route('post.fail');
        }

    }
    public function delete(Post $post, DeleteRequest $request){
    if($post->delete_pass !== $request->post_delete_pass){
        return back()->withErrors(['post_delete_pass'=>'削除パスワードが違います。']);
    }
    if($post->user_id !== Auth::id()){
        abort(403,'権限がありません');
    }
    if($post->image_path){
        Storage::disk('public')->delete($post->image_path);
    }

    $post->delete();
    return view('deleteSuccess');
    }

    public function postSuccess(){
        return view('postSuccess');
    }
    public function postFail(){
        return view('postFail');
    }
}

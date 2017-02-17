<?php

namespace blog\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Illuminate\Foundation\Validation\ValidatesRequests;

class BlogController extends Controller{

    public function index(){
    	$data['articles'] = DB::select('SELECT * FROM blog join users on blog.userID = id  WHERE status = "published";');
    	return view('blog_page', $data);
    }

    public function viewBlog($blogID){
        if(Auth::guest() || Auth::user()->type == "" || Auth::user()->type == null ){
            $data['article']    = DB::select('SELECT * FROM blog join users on blog.userID = id  WHERE status = "Published" and blogID = ?;',[$blogID]);
        } else if(Auth::user()->type == "admin"){
            $data['article']    = DB::select('SELECT * FROM blog join users on blog.userID = id  WHERE blogID = ?;',[$blogID]);
        } 
    	
    	$data['comments'] 	= DB::select('SELECT * FROM comments where blogID = ? and status = "view" order by time_comment desc;', [$blogID]);

    	return view('view_blog', $data);
    }

    public function myBlog($status){
        $data['status']     =  $status; 
        $data['articles']   = DB::select('SELECT * FROM blog join users on blog.userID = id WHERE id = '.Auth::user()->id.' and status = "'.$status.'";');
        return view('my_blog_page', $data);
    }

    public function createBLog(){
        $data['articles'] = null;
        return view('create_blog', $data);
    }

    public function insertNewBlog(Request $request){

        $this->validate($request,[
            'title' =>'required|max:25',
            'content' =>'required',
        ]);

    	$title 		= $request->input('title');
    	$content 	= $request->input('content');
 		$status 	= $request->input('status');
 		$writer		= $request->input('userID');
    	DB::insert('INSERT INTO blog (title, content, status, userID) VALUES (?, ?, ?, ?);',[$title, $content, $status, $writer]);
    	echo "blog has been ".$status."<br>";
    	echo '<a href = "/">Click Here</a> go back to the home page.'; 
    }
    
    public function editBlog($blogID){
        $data['articles']   = DB::select('SELECT * FROM blog join users on blog.userID = id WHERE id = '.Auth::user()->id.' and blogID = '.$blogID.';');
        return view('create_blog', $data);
       
    }

    public function updateBlog(Request $request){
        $title      = $request->input('title');
        $content    = $request->input('content');
        $writer     = $request->input('userID');
    
        DB::update('UPDATE blog SET title = ?, content = ?, status = ? WHERE blogID = ?;',[$title, $status, $blogID]);
        echo "blog has been Updated <br>";
        echo '<a href = "/">Click Here</a> go back to the home page.'; 
    }

    public function changeBlodStatus(Request $request){
        $blogID     = $request->input('blogID');
        $status     = $request->input('status');
        DB::update('UPDATE blog SET status = ? WHERE blogID = ?;',[$status, $blogID]);
        echo "blog has been ".$status."<br>";
        if($status === "Spam"){
            echo '<a href = "/">Click Here</a> go back to the home page.'; 
        } else if($status !== "spam"){
            echo '<a href = "/my_blog/'.$status.'">Click Here</a> go back to the home page.'; 
        }  
    }
    
    public function spamBlog(){
        $blogID     = $request->input('blogID');
    }   
    
    public function insertComment(Request $request){
        $this->validate($request,[
            'content' =>'required',
        ]);

        $blogID     = $request->input('blogID');
        $content    = $request->input('content');
        DB::insert('INSERT INTO comments (content, blogID, status) VALUES (?, ?, "view");',[$content, $blogID]);
        echo 'comment has been placed <br>';
        echo '<a href = "/view_blog/'.$blogID.'">Click Here</a> to go back.';
    }

    public function spamComment(Request $request){
        $blogID     = $request->input('blogID');
        $commentID = $request->input('commentID');
        DB::update('UPDATE comments SET status="spam" WHERE commentsID=?;',[$commentID]);
        echo 'comment has been spamed <br>';
        echo '<a href = "/view_blog/'.$blogID.'">Click Here</a> to go back.';
    }

}

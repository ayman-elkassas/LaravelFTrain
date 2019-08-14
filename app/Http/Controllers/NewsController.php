<?php

namespace App\Http\Controllers;

use App\Comments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;
use View;
use App\News;

class NewsController extends Controller
{
    //train how to get data and send it to view********
    public function test()
    {
        //return "Hello Controller";

	    //manual created request object
	    //$id=$request->input('id');

	    //using helper class function request

	    //$id=request()->input('id');
	    //or

	    if(\request()->has('id'))
	    {
		    //$id=request('id');
		    //or
		    //$id=\request()->input('id');
		    $id=\request()->get('id');
	    }

	    //dump and die
	    //return dd($id);

	    $username="Ayman Elkassas";
	    //how to send array
	    $news=['n1'=>'happy application','n2'=>'welcome laravel'];

	    //first method
        //return view('layout.test',['id'=>$id]);

	    //second method
	    return view('layout.test')->with('id',$id)
		    ->with('username',$username)
		    ->with('news',$news);

	    //old method using View class
	    //return View::make('layout.test',compact('id','username','news'));
    }

    //*************How to get data from model***********
	public function news()
	{
		//remove all sessions
		//\Session::flush();

		//to get all sessions create
//		return \Session::all();

		//to get all dataphp
		//$all_news=News::all(); equivalent to but in get can determine what column
		//want to get it as following....
		//$all_news=News::get(['id','title']);

		//to get data with pagination
		$all_news=News::withTrashed()->orderBy('id','desc')->paginate(5);
		$soft_deletes=News::onlyTrashed()->orderBy('id','desc')->paginate(5);
		return view('layout.news',compact('all_news','soft_deletes'));
	}

	public function insert()
	{
		//if request is sent from ajax
		if(\request()->ajax())
		{
			// method to sending data to model and then from model to save in DB
//		$add=new News;
//		$add->title=\request('title');
//		$add->desc=\request('desc');
//		$add->content=\request('content');
//		$add->user_id=\request('user_id');
//		$add->status=\request('status');
//		$add->save();

			//second method to insert new record using create static method
//		News::create([
//			'title'=>\request('title'),
//			'desc'=>\request('desc'),
//			'content'=>\request('content'),
//			'status'=>\request('status'),
//			'user_id'=>\request('user_id'),
//		]);

			//create record first time
//		News::firstOrCreate([
//			'title'=>\request('title'),
//			'desc'=>\request('desc'),
//			'content'=>\request('content'),
//			'status'=>\request('status'),
//			'user_id'=>\request('user_id'),
//		]);

			//create if no record match with it or update if already inserted
//		News::updateOrCreate([
//			'title'=>\request('title'),
//			'desc'=>\request('desc'),
//			'content'=>\request('content'),
//			'status'=>\request('status'),
//			'user_id'=>\request('user_id'),
//		]);

			//old way for validation use validator class

//		$validator=Validator::make(\request()->all(),[
//			'title'=>'required',
//			'desc'=>'required',
//			'user_id'=>'required',
//			'content'=>'required',
//			'status'=>'required',
//		]);
//
//		$validator->setAttributeNames([
//			'title'=>'Title News',
//			'desc'=>'Description News',
//			'user_id'=>'Who Add by',
//			'content'=>'Content News',
//			'status'=>'Status News',
//		]);
//
//		if($validator->fails())
//		{
//			return back()->withInput()->withErrors($validator);
//		}

			//New way validate and insert

			$attributeNames=[
				'title'=>trans('errorMessages.title'),
				'desc'=>trans('errorMessages.desc'),
				'user_id'=>trans('errorMessages.user_id'),
				'content'=>trans('errorMessages.content'),
				'status'=>trans('errorMessages.status'),
			];

			$this->validate(\request(),[
				'title'=>'required',
				'desc'=>'required',
				'user_id'=>'required',
				'content'=>'required',
				'status'=>'required',
			],[],$attributeNames);

			//insert using eloquent model class
			//News::create(\request()->all());

			//more and more functions and operations
//		https://laravel.com/docs/5.8/queries
			//insert using DB class in fluent query builder
//		DB::table('news')->insert(\request()->except('_token'));

//		$id=DB::table('news')->insertGetId(
//			\request()->except('_token')
//		);

//		return dd($id);

//		session()->put('message','New Record Added successfully');
//		session()->flash('message','New Record Added successfully');
//		\Session::push('message',['key1'=>'val1','key2'=>'val2']);

			//insert by ajax
			$news=News::create(\request()->all());
			$html=view('layout.rows_news',['news'=>$news])->render();
			return response(['status'=>true,'result'=>$html]);
		}

		return redirect('all/news');
	}

	public function deleteById($id=null)
	{
		if($id!=null)
		{
			$del=News::find($id);
			$del->delete();
		}
		else if(\request()->has('id') and \request()->has('restore') )
		{
			News::whereIn('id',\request('id'))->restore();
		}
		else if(\request()->has('id') and \request()->has('force_delete') )
		{
			News::whereIn('id',\request('id'))->forceDelete();
		}
		else if(\request()->has('id') and \request()->has('Soft_delete') )
		{
			News::destroy(\request('id'));
		}
		return redirect('all/news');
	}

	public function show($id)
	{
		$news=News::with('user')->with('comments')->find($id);
//		return $news;
		return view('news.news_show',compact('news'));
	}

	public function add_comment($news_id)
	{
		$this->validate(\request(),[
			'comment'=>'required',
		]);
		$data=\request()->all();
		$data['user_id']=auth()->user()->id;
		$data['news_id']=$news_id;
		Comments::create($data);

		return back();
	}
}

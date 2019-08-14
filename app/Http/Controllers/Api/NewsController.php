<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\News;
use App\Comments;
use App\Rules\CheckExistNews;
use function GuzzleHttp\Promise\all;
use Illuminate\Validation\Rule;
use function Sodium\add;

class NewsController extends Controller
{
    public function all_news()
    {
        $all_news=News::withCount('comments')->orderBy('id','desc')->paginate(2);
        return response(['all_news'=>$all_news]);
    }

	public function news($id)
	{
		//to get news with all comments (worst case)
//		$news=News::with('comments')->find($id);

		//But this way get in each comment news
//		$news=News::find($id)->comments()->with('news_id')
//			->paginate(10);

		//The best way separate news and comments
		$news=News::find($id);
		$comments=$news->comments()->paginate(1);

		return !empty($news) ?
			response(['status'=>true,compact('news','comments')])
			:response(['status'=>false]);
	}

	public function add_comment()
	{
		$rules=[
			'comment'=>'required',
			'news_id'=>
				['required','numeric',Rule::exists('news','id')],
		];

		$validate=\Validator::make(request()->all(),$rules);

		if($validate->fails())
		{
			return response(['status'=>false,'message'=>$validate->messages()]);
		}
		else{
			$data=request()->except('api_token');
			$data['user_id']=auth()->user()->id;
//			$data=array_add($data,'user_id',auth()->user()->id);
			Comments::create($data);

			//OoooooooooooooooooooooooR

//			$addComment=new Comments;
//
//			$addComment->user_id=auth()->user()->id;
//			$addComment->comment=request()->input('comment');
//			$addComment->news_id=request()->input('id');
//
//			$addComment->save();

			return response(['status'=>true,'message'=>'Comment is added successfully']);

		}
	}
}

<?php

namespace App\Http\Controllers;

use App\File;
use App\News;
use Illuminate\Http\Request;

//CRUD CONTROLLER
class NewsCRUDController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
	    $all_news=News::OrderBy('id','desc')
		    ->paginate(10);
	    $title='News';
	    return view('news.index',compact('all_news','title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
	    $title='Create or Add News';
	    return view('news.create',compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
	    $rules=[
		    'title'=>'required',
		    'photo'=>'required|image',
		    'files.*'=>'image',
		    'desc'=>'required',
		    'content'=>'required'
	    ];

	    //equal to 'files'=>'array|image'

//	    if($request->hasFile('files'))
//	    {
//		    foreach ($request->File('files') as $file) {
//			    $rules[$file]='image';
//	    	}
//	    }

	    $this->validate($request,$rules,[],[
		    'title'=>'Title is required',
		    'photo'=>'Photo is required',
		    'desc'=>'Description is required',
		    'content'=>'Content is required'
	    ]);

	    $data=$request->all();

	    //create temp folder
	    $tempfolder=time();

	    $data['photo']=$request->photo->store('image/'.$tempfolder);
	    $data['user_id']=auth()->user()->id;

	    $news=News::create($data);

	    if($request->hasFile('files')) {
		    //Store multiple image
		    foreach ($request->file('files') as $file) {
			    \Storage::makeDirectory('image/' . $news->id);

			    $uploadFile = $file->store('image/' . $news->id);

			    File::create([
				    'user_id' => auth()->user()->id,
				    'news_id' => $news->id,
				    'path' => 'image/' . $news->id,
				    'file' => $uploadFile,
				    'file_name' => $file->getClientOriginalName(),
				    'size' => \Storage::size($uploadFile)

			    ]);
		    }
	    }

	    //add single image to folder image(news_id)
	    $newName=str_replace($tempfolder,$news->id,$news['photo']);
	    \Storage::rename($news['photo'],$newName);

	    News::where('id',$news->id)->update(['photo'=>$newName]);
	    \Storage::deleteDirectory('image/'.$tempfolder);

	    //create session value for check if added successfully or not
	    session()->flash('success','News Added Successfully');

	    return redirect('news');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
	    $news=News::find($id);
	    return view('news.show',['news'=>$news,'title'=>$news->title]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
	    $news=News::find($id);

	    return view('news.edit',['news'=>$news,'title'=>'Edit']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
	    if($request->has('delete_photo') and $request->has('file_id'))
	    {
	    	foreach ($request->input('file_id') as $id)
		    {
		    	$file=File::find($id);
		    	\Storage::delete($file->file);
		    	$file->delete();
		    }
		    session()->flash('success','Photo Is Deleted');

		    return redirect('news/'.$id.'/edit');
	    }
	    else
	    {
		    $rules=[
			    'title'=>'required',
			    'photo'=>'image',
			    'files.*'=>'image',
			    'desc'=>'required',
			    'content'=>'required'
		    ];

		    $this->validate($request,$rules,[],[
			    'title'=>'Title is required',
			    'photo'=>'Photo is required',
			    'desc'=>'Description is required',
			    'content'=>'Content is required'
		    ]);

		    $data=$request->except(['files','_method','_token']);

		    $news=News::find($id);

		    if($request->hasFile('photo'))
		    {
			    \Storage::delete($news->photo);
			    $data['photo']=$request->photo->store('image/'.$id);
		    }
		    $data['user_id']=auth()->user()->id;

		    if($request->hasFile('files'))
		    {
			    //Store multiple image
			    foreach ($request->file('files') as $file)
			    {
				    \Storage::makeDirectory('image/'.$news->id);

				    $uploadFile=$file->store('image/'.$news->id);

				    File::create([
					    'user_id'=>auth()->user()->id,
					    'news_id'=>$news->id,
					    'path'=>'image/'.$news->id,
					    'file'=>$uploadFile,
					    'file_name'=>$file->getClientOriginalName(),
					    'size'=>\Storage::size($uploadFile)
				    ]);
			    }
		    }

		    News::where('id',$news->id)->update($data);

		    //create session value for check if added successfully or not
		    session()->flash('success','News Updated Successfully');

		    return redirect('news');
	    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
	    //forced because news is a softdelete model
	    News::find($id)->forceDelete();

	    //create session value for check if added successfully or not
	    session()->flash('success','News Was Deleted Successfully');

	    \Storage::deleteDirectory('image/'.$id);
	    return redirect('news');
    }
}

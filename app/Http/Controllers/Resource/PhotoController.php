<?php

namespace App\Http\Controllers\Resource;

use App\Http\Controllers\Controller;
use App\Models\Photo;
use App\Searches\PhotoSearch;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    /**
     * @param PhotoSearch $photoSearch
     * @return \Illuminate\Contracts\View\Factory
     */
    public function index(PhotoSearch $photoSearch)
    {
        $query = $photoSearch->search(request()->all());
        $photos = $query->paginate(Photo::PER_PAGE)
            ->appends(request()->query());
        return view('photo.index',compact('photos'))
            ->with('i', (request()->input('page', 1) - 1) * Photo::PER_PAGE);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory
     */
    public function create(Photo $photo)
    {
        $photo->isNew = true;
        return view('photo.create',compact('photo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request,Photo $photo)
    {
        $photo->loadAttributes($request->all());
        $photo->setScenario(Photo::SCENARIO_CREATE);
        $photo->setAttribute('file',$request->file);
        if( $photo->validate() ){
            $link = $photo->uploadFile($photo->fill,'images');
            $photo->link = $link;
            $photo->save();
            return redirect()->route('photo.index')
                ->with('success','You have successfully create photo.');
        }
        return redirect()->back()
            ->withErrors($photo->validator)
            ->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function show(Photo $photo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Contracts\View\Factory
     */
    public function edit(Photo $photo)
    {
        $photo->isNew = false;
        return view('photo.update',compact('photo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Photo $photo)
    {
        $photo->loadAttributes($request->all());
        $photo->setScenario(Photo::SCENARIO_UPDATE);
        if( $request->hasFile('file') ){
            $photo->setAttribute('file',$request->file);
        }
        if( $photo->validate() ){
            if( $request->hasFile('file') ){
                $link = $photo->uploadFile($photo->file,'images');
                $photo->link = $link;
            }
            $photo->update();
            return redirect()->route('photo.index')
                ->with('success','You have successfully Update photo.');
        }
        return redirect()->back()
            ->withErrors($photo->validator)
            ->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Photo $photo)
    {
        //
    }

}

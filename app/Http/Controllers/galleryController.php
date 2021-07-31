<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class galleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id=null)
    {
        if($id){
            $data = Category::join('gallery', 'gallery.cat_id', 'category.id')
                            ->where('category.id',$id)
                            ->get();
        }
        else{
            $data = Category::join('gallery', 'gallery.cat_id', 'category.id')
            ->get();
        }
        
        return $data;
    }
    public function getAll(){
            $data =  Category::has('gallery', '>=' , 1)->with('gallery')
            ->get();

            return $data;
            
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'cat_id'=>'required'
        );
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return response()->json($validator->errors(), 401);
        }
        if(!$request->hasFile('image')) {
            return response()->json(['upload_file_not_found'], 400);
        }
        $file = $request->file('image');
        if(!$file->isValid()) {
            return response()->json(['invalid_file_upload'], 400);
        }
        $image = $request->file('image'); 
        $name= Str::random(10).$image->getClientOriginalName();
        $path = 'public/images';
        $request->file('image')->move($path, $name);
        $Gallery = new Gallery();
        $Gallery->image = asset('/public/images/'.$name);
        $Gallery->cat_id = $request->cat_id;
        $result = $Gallery->save();
        if($result){
            return ['Result'=>'Data uploaded successfully'];
        }
        else
        {
            return ['Result'=>'Operation Failed'];
        }
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
    }
}

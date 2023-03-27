<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mall;
use DB;
use Auth;

class MallController extends Controller
{

  public function __construct()
  {
      $this->middleware('auth');
      $this->middleware('revalidate');
      $this->middleware('timeout');
  }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $malls = Mall::all();
      return view('malls.viewmall', compact(['malls']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('malls.createmall');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $request->validate([
        'region'=>'required',
        'mall_name'=> 'required',
        'mall_code' => 'required',
        'mall_logo' => 'file|max:1024'
      ]);

      if($request->hasfile('mall_logo'))
       {
      $fileName = request()->mall_logo->getClientOriginalName();
      $unique_id = uniqid();
      $fileName = $unique_id.'-'.$fileName;

      $request->mall_logo->storeAs('public/uploads',$fileName);
      }
      else {
        $fileName = '';
      }
      $mall = new Mall([
        'region' => $request->get('region'),
        'mall_name'=> $request->get('mall_name'),
        'mall_code'=> $request->get('mall_code'),
        'mall_logo'=> $fileName
      ]);
      $mall->save();

      DB::table('logs')->insert(
    ['user_id' => Auth::user()->id,'form' => 'Create Mall','query' => $mall,'created_at'=>now()]
);
      return redirect('/malls')->with('success', 'Mall has been added');
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
      $mall = Mall::find($id);

      return view('malls.editmall', compact('mall'));
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
      $request->validate([
        'region'=>'required',
        'mall_name'=> 'required',
        'mall_code' => 'required',
        'mall_logo' => 'image|mimes:jpg,png|max:1024'
      ]);

      if($request->hasfile('mall_logo'))
       {
      $fileName = request()->mall_logo->getClientOriginalName();
      $unique_id = uniqid();
      $fileName = $unique_id.'-'.$fileName;

      $request->mall_logo->storeAs('public/uploads',$fileName);
      }
      else {
        $fileName = '';
      }
      $mall = Mall::find($id);
      $mall->region = $request->get('region');
      $mall->mall_name = $request->get('mall_name');
      $mall->mall_code = $request->get('mall_code');
      if ($fileName !== '')
      {
      $mall->mall_logo = $fileName;
      }
      $mall->save();

      DB::table('logs')->insert(
    ['user_id' => Auth::user()->id,'form' => 'Update Mall','query' => $mall,'created_at'=>now()]
);
      return redirect('/malls')->with('success', 'Mall has been updated');
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

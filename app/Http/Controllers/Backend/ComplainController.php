<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Complain;
use Illuminate\Http\Request;

class ComplainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'title' => 'Complains'
        ];

        $complains = Complain::with(['user','department'])->where('status',2)->get();

        return view('backend.pages.complains.index',$data, compact('complains'));
    }

    public function pending()
    {
        $data = [
            'title' => 'Complains-pendings'
        ];

        $complains = Complain::with(['user','department'])->where('status',1)->get();

        return view('backend.pages.complains.pending',$data, compact('complains'));
    }

    public function declined()
    {
        $data = [
            'title' => 'Complains-pendings'
        ];

        $complains = Complain::with(['user','department'])->where('status',3)->get();

        return view('backend.pages.complains.declined',$data, compact('complains'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = [
            'title' => 'Complain-show'
        ];

        $complain = Complain::with(['department', 'user'])->find($id);

        return view('backend.pages.complains.show', $data , compact('complain'));
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
        $complain_status_update = Complain::where('id',$id)->update(['status' => $request->input('status'), 'updated_at' => $request->input('update_date')]);

        if($complain_status_update){
            return back()->with('success','Complain status updated successfully');
        }else{
            return back()->with('error','Complain status could not be updated');
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
        if(Complain::find($id)->delete()){
            return back()->with('danger','Item deleted successfully');
        }else{
            return back()->with('error','Item can not be deleted');
        }
    }
}

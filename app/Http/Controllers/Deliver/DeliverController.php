<?php

namespace App\Http\Controllers\Deliver;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Deliver;
use Illuminate\Database\QueryException;

class DeliverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $deliver = Deliver::with('order')->paginate(10);
        
         return view('Deliver.deliverPage')->with('deliver', $deliver);
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
        $deliver = Deliver::with('order')->find($id);

        if(!$deliver){
            return abort(404);
        }

        return view('Deliver.deliverView')->with('deliver', $deliver );
        
        
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
        try{
            $validated = $request->validate([
                'deliverNotice' => 'nullable|max:10|unique:delivers,notice_no,' .$id,
            ],[
                'deliverNotice.unique' => 'The Deliver Notice No  has already been taken.' 
            ]);
    
            $update = Deliver::where('id', $id)
            ->update([
                'notice_no' => $request->input('deliverNotice'),
                'deliver_status' => $request->input('deliverStatus'),
                'settlement_status' => $request->input('settlementStatus')
            ]);
    
            if($update){
                return redirect()->back()->with('success-update','Deliver update successfully.');
            }else{
                return redirect()->back();
            }
        }
        catch(QueryException $ex){
            return redirect()->back()->with('exception-error','An error occurred, please try again later');
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
    }
}

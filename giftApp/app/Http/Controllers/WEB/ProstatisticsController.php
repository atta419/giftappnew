<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WEB\Statistic;

class ProstatisticsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $statistic=Statistic::latest()->paginate(10);

        return view('statistic.index',compact('statistic'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('statistic.create');
        
           
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
           
            ('user_id')=>'required',
            ('gift_id')=>'required',
            ('total_amount')=>'required',
            ('bank_transaction_id')=>'required',
    
    
    
            ]);
            $statistic=Statistic::create($request->all());
            return redirect()->route('statistic.index')->with('succes','satistic add successiflly');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show( Statistic  $statistic )
    {
        return view('statistic.show',compact('statistic'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit( Statistic  $statistic)
    {
        return view('statistic.edit',compact('statistic'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Statistic  $statistic )
    {
        $request->validate([
           
            ('user_id')=>'required',
            ('gift_id')=>'required',
            ('total_amount')=>'required',
            ('bank_transaction_id')=>'required',
    
    
    
            ]);
            $statistic->update($request->all());
            return redirect()->route('statistic.index')->with('succes','satistic add successiflly');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $statistic->delete();
        return redirect()->route('statistic.index')->with('succes','satistic add successiflly');

    }
}

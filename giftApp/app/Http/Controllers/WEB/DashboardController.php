<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WEB\Dashboard;

class DashboardController extends Controller
{
    public function index()
    {
        $dashboard=Dashboard::latest()->paginate(10);

        return view('dashboard.index',compact('dashboard'));
    }
    public function create()
    {
        return view('dashboard.create');
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
           
        ('total_sales')=>'required',
        ('new_users')=>'required',
        ('total_orders')=>'required',
       



        ]);
        $dashboard=Dashboard::create($request->all());
        return redirect()->route('dashboard.index')->with('succes','product add successiflly');
        

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Dashboard $dashboard)
    {
        return view('dashboard.show',compact('dashboard'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Dashboard $dashboard)
    {
        return view('dashboard.edit',compact('dashboard'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Dashboard $dashboard )
    {
        $request->validate([
            ('total_sales')=>'required',
        ('new_users')=>'required',
        ('total_orders')=>'required',


        ]);
        $dashboard->update($request->all());
        return redirect()->route('dashboard.index')->with('succes','product update successiflly');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dashboard->delete();
        return redirect()->route('dashboard.index')->with('succes','product delete successiflly');

    }
}






<?php

namespace App\Http\Controllers;

use App\Table;
use Illuminate\Http\Request;

class tableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Table::all();
        return view('theme.tables.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('theme.tables.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new Table;
        $user->user_id = $request->input('id');
        $user->name = $request->input('username');
        $user->position = $request->input('position');
        $user->office = $request->input('office');
        $user->age = $request->input('age');
        $user->start_date = $request->input('start_date');
        $user->salary = $request->input('salary');
        $user->save();

        return redirect('tables/index')->with('success','Data Entered Successfully');
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
        $data = Table::find($id);
        return view('theme.tables.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $table = Table::find($request->record);
        $data = $table->update([
            'user_id' => $request->input('id'),
            'name' => $request->input('username'),
            'position' => $request->input('position'),
            'office' => $request->input('office'),
            'age' => $request->input('age'),
            'start_date' => $request->input('start_date'),
            'salary' => $request->input('salary'),
        ]);

        return redirect('tables/index')->with('success','Data updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $table = Table::find($id);
        $table->delete();

        return redirect('tables/index');
    }
}

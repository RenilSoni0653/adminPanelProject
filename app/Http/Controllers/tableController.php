<?php

namespace App\Http\Controllers;

use App\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        $request->validate([
            'name' => 'required',
            'position' => 'required',
            'office' => 'required',
            'age' => 'required|min:1',
            'start_date' => 'required|date',
            'salary' => 'required'
        ],
        [
            'name.required' => 'Name field is required',
            'position.required' => 'Position field is required',
            'office.required' => 'Office field is required',
            'age.required' => 'Age field is required',
            'start_date.required' => 'Start date field is required',
            'salary.required' => 'Salary field is required'
        ]);

        $user = Table::create([
            'user_id' => $request->input('id'),
            'name' => $request->input('name'),
            'position' => $request->input('position'),
            'office' => $request->input('office'),
            'age' => $request->input('age'),
            'start_date' => $request->input('start_date'),
            'salary' => $request->input('salary')
        ]);

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

        $request->validate([
            'user_id' => [auth()->user()->id],
            'username' => 'required',
            'position' => 'required',
            'office' => 'required',
            'age' => 'required',
            'start_date' => 'required|date',
            'salary' => 'required',
        ],
        [
            'username.required' => 'Name field is required',
            'position.required' => 'Position field is required',
            'office.required' => 'Office field is required',
            'age.required' => 'Age field is required',
            'start_date.required' => 'Start date field is required',
            'salary.required' => 'Salary field is required',
        ]
    );

        $data = $table->update([
            'user_id' => auth()->user()->id,
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

        return redirect('tables/index')->with('success','Data deleted successfully');
    }

    public function trash()
    {
        $table = Table::onlyTrashed()->get();
        
        return view('theme.tables.trash')->with(compact('table'));
    }
    
    public function restoreData($id)
    {
        $table = Table::where('id','=',$id)->withTrashed()->first();
        $table->restore();

        return redirect('tables/index')->with('success','Data restored successfully');
    }

    public function deletePermenantly($id)
    {
        $table = Table::where('id','=',$id)->withTrashed()->first();
        $table->forceDelete();

        return redirect('tables/index')->with('success','Data deleted successfully');
    }
}

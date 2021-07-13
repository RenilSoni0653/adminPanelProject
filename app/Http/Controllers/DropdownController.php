<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DropdownController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = \DB::table('countries')->get();
        
        return view('theme.dropdown.create',compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function store($id,Request $request)
     {
        $countryID = $request->input('country');
        $country = \DB::table('countries')
        ->where('id','=',$countryID)
        ->pluck('name');

        $stateID = $request->input('state');
        $state = \DB::table('states')
        ->where('id','=',$stateID)
        ->pluck('name');

        $cityID = $request->input('city');
        $city = \DB::table('cities')
        ->where('id','=',$cityID)
        ->pluck('name');

        $request->validate([
            'user_id' => 'null',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
        ],
        [
            'country_name.required' => 'Country field is required',
            'state_name.required' => 'State field is required',
            'city_name.required' => 'City field is required',
        ]);

        $query = \DB::table('countrycitystates')->insert([
            'user_id' => auth()->user()->id,
            'country_name' => $country[0],
            'country_id' => $request->input('country'),
            'state_name' => $state[0],
            'state_id' => $request->input('state'),
            'city_name' => $city[0],
            'city_id' => $request->input('city'),
        ]);
 
        return redirect('dropdown/showList/'.auth()->user()->id)->with('success','Data entered successfully');
     }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = \DB::table('countrycitystates')
        ->where('user_id','=',$id)
        ->orderBy('id','DESC')
        ->get();

        return view('theme.dropdown.showList',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $countries = \DB::table('countries')
        ->select('name','id')
        ->get();

        $countriesValue = \DB::table('countrycitystates')
        ->where('id','=',$id)
        ->select('country_id','country_name','state_id','city_id')
        ->get();

        $states = \DB::table('states')
        ->where('country_id','=',$countriesValue[0]->country_id)
        ->select('name','id')
        ->get();

        $statesValue = \DB::table('countrycitystates')
        ->where('state_id','=',$countriesValue[0]->state_id)
        ->select('state_name')
        ->get();

        $cities = \DB::table('cities')
        ->where('state_id','=',$countriesValue[0]->state_id)
        ->select('id','name')
        ->get();

        $citiesValue = \DB::table('countrycitystates')
        ->where('city_id','=',$countriesValue[0]->city_id)
        ->select('city_name')
        ->get();

        return view('theme.dropdown.edit',compact('countries','countriesValue','states','statesValue','cities','citiesValue'));
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
        $countryID = $request->input('country');
        $country = \DB::table('countries')
        ->where('id','=',$countryID)
        ->pluck('name');

        $stateID = $request->input('state');
        $state = \DB::table('states')
        ->where('id','=',$stateID)
        ->pluck('name');
        

        $cityID = $request->input('city');
        $city = \DB::table('cities')
        ->where('id','=',$cityID)
        ->pluck('name');

        $request->validate([
            'country' => 'required',
            'state' => 'required',
            'city' => 'required'
        ],
        [
            'country.required' => 'Country field is required',
            'state.required' => 'State field is required',
            'city.required' => 'City field is required'
        ]);


        $data = \DB::table('countrycitystates')
        ->where('id','=',$id)
        ->update([
            'country_name' => $country[0],
            'country_id' => $request->input('country'),
            'state_name' => $state[0],
            'state_id' => $request->input('state'),
            'city_name' => $city[0],
            'city_id' => $request->input('city')
        ]);

        return redirect('dropdown/showList/'.auth()->user()->id)->with('success','Data updated successfully');
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

    public function getStates(Request $request)
    {   
        $states = \DB::table('states')
        ->where('country_id','=',$request->input('country_id'))
        ->select('name','id')
        ->get();
        
        return response()->json($states);
    }

    public function getCities(Request $request)
    {
        $cities = \DB::table('cities')
        ->where('state_id','=',$request->input('state_id'))
        ->select('name','id')
        ->get();

        return response()->json($cities);
    }
}

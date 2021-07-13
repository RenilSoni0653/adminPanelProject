<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mapper;

class MapsController extends Controller
{
    public function index()
    {
        // Mapper::map(52.381128999999990000, 0.470085000000040000, ['markers' => ['icon' => ['symbol' => 'CIRCLE', 'scale' => 10], 'animation' => 'DROP', 'label' => 'Marker', 'title' => 'Marker']])->marker(53.381128999999990000, -1.470085000000040000);
        // Mapper::streetview(53.381128999999990000, -1.470085000000040000, 1, 1);

        return view('theme.maps.index');
    }
}

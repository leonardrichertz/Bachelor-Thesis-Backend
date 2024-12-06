<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class LocationController extends Controller
{
    public function index(Request $request)
    {
       return auth()->user()->locations;
    }

    public function store(Request $request)
    {
        $data = $request->validate(rules: [
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $location = auth()->user()->locations()->create(attributes: $data);

        return response()->json(data: [
            'status' => 200,
            'message' => 'Location saved successfully',
            'data' => $location,
        ], status: 200);
    }

    public function remove($id){        
        $location = auth()->user()->locations()->find($id);
        $location->delete();

        return response()->json(data: [
            'status' => 200,
            'message' => 'Location removed successfully',
        ], status: 200);
    }
    
}
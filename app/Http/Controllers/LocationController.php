<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Models\Location;

class LocationController extends Controller
{
    public function index(Request $request)
    {
        try{
            $user = $request->user();

            $locations = Location::where('user_id', $user->id)->get();
    
            return $locations;
        }
        catch(\Exception $e){
            return response()->json(['message' => $e->getMessage()], 500);
        }
       
    }

    public function store(Request $request)
    {
        $data = $request->validate(rules: [
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $user = $request->user();
        $location = $user->locations()->create($data);

        return response()->json(data: [
            'status' => 200,
            'message' => 'Location saved successfully',
            'data' => $location,
        ], status: 200);
    }

    public function remove(Request $request)
    {
        $id = $request->query('id');
        $user = $request->user();
        if (!$user) {
            return response()->json(['message' => 'Unauthenticated'], 401);
        }
        $location = $user->locations()->find($id);

        if ($location) {
            $location->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Location removed successfully',
            ], 200);
        }

        return response()->json(['message' => 'Location not found'], 404);
    }
    
}
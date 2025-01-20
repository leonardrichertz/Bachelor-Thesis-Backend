<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Laravel\Sanctum\PersonalAccessToken;

class AuthenticationController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
 
            return response()->json(['message' => 'Authenticated'], 204);
        }
        return response()->json(['message' => 'Invalid credentials'], 401);
    }
}
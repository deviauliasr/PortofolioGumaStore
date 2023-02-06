<?php

namespace App\Http\Controllers;
use Auth;
use App\User;
use Alert;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $user = User::where('id', Auth::user()->id)->first();
        return view('profile.index', compact('user'));
    }

    public function edit(Request $request)
    {
        $this->validate($request,[
            'password' => 'confirmed'
        ]);

        $user = User::where('id', Auth::user()->id)->first();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->no_hp = $request->number;
        $user->alamat = $request->add1;

        if(!empty($request->password))
        {
            $user->password = Hash::make($request->password);
        }
        
        $user->update();

        alert()->success('Profile updated', 'Success');
        return redirect('profile');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\User;
use Hash;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index(Request $request)
    {
         if ($user = Auth::user()) {
                if ($user->level == 'admin') {
                    if($user->status == 'Aktif'){
                    return redirect()->intended('admin');
                    }
                } elseif ($user->level == 'petugas') {
                    if($user->status == 'Aktif'){
                    return redirect()->intended('petugas');
                    }
                }
        }
          return view('login');
    }


   public function proses_login(Request $request)
    {
        request()->validate(
            [
                'email' => 'required',
                'password' => 'required',
            ]);

        $kredensil = $request->only('email','password');

            if (Auth::attempt($kredensil)) {
                $user = Auth::user();
                        if ($user->level == 'admin') {
                            if ($user->status == 'Aktif') {
                                return redirect()->intended('home');
                            }
                        } elseif ($user->level == 'petugas') {
                            if ($user->status == 'Aktif') {
                                return redirect()->intended('petugas');
                            }
                        }

                    // return redirect()->intended('/');
            }
        return redirect('login')
                                ->withInput()
                                ->withErrors(['login_gagal' => 'These credentials do not match our records.']);
    }

    
    public function logout(Request $request)
    {
       $request->session()->flush();
       Auth::logout();
       return Redirect('login');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
<?php

namespace App\Http\Controllers\Auth;

use App\Kasir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = Kasir::findOrFail(Auth::id());
        $title = 'Account';
        $aim = 'Account';

        return view('auth.account.accountForm', compact('title', 'model', 'aim'));
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
        //
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
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:kasirs,email,'.$id.',id_kasir',
            'telepon' => 'required|string|min:10|max:15',
            'alamat' => 'required|string|max:255',
            'photo' => 'image|mimes:jpeg,jpg,png|max:3092',
        ]);

        $model = Kasir::findOrFail($id);

        if ($request->hasFile('photo'))
        {
            $img = $request->file('photo');
            $new_name = rand(). '.' .$img->getClientOriginalExtension();

            if (unlink(public_path('images').'/'.$model->photo))
            {
                if ($img->move(public_path('images'), $new_name))
                {
                    $model->update([
                        'photo' => $new_name,
                    ]);
                }
            }
        }

        $sql = $model->update([
                'nama' => $request->get('nama'),
                'email' => $request->get('email'),
                'alamat' => $request->get('alamat'),
                'telepon' => $request->get('telepon'),
            ]);
        
        if ($sql)
        {
            $request->session()->flash('success', 'Profile berhasil diperbaharui!');
        }            
        
    }

    public function password()
    {
        $title = 'Ganti Password';
        $aim = 'Ganti Password';
        return view('auth.account.accountPassword', compact('title', 'aim'));
    }

    public function passwordUpdate(Request $request)
    {
        $request->validate([
            'password_lama' => 'required|string|min: 6',
            'password'=> 'required|string|min:6|confirmed'
        ]);

        if (Hash::check($request->get('password_lama'), Auth::user()->password))
        {
            $sql = Kasir::findOrFail(Auth::id())->update([
                'password' => Hash::make($request->get('password')),
            ]);

            if ($sql)
            {
                $request->session()->flash('success', 'Password berhasil dirubah!');
            } else {
                $request->session()->flash('error', 'Password gagal dirubah!');
            }
        }else {
            $request->session()->flash('error', 'Password Salah!');
        }
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
}

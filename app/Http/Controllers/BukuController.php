<?php

namespace App\Http\Controllers;

use App\Buku;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BukuController extends Controller
{
    /**
     *
     * @return void
     */
    public function __construct()
    {        
        $this->middleware(['auth', 'verified']);

        $this->middleware(function ($request, $next) {
            if (Auth::user()->akses !== 'admin')
            {
                return redirect()->route('home');
            }
    
            return $next($request);
        });        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tb = 'buku';
        $title = 'Buku';
        $aim = "Buku";
        
        return view('buku.bukuTable', compact('title', 'aim', 'tb'));
    }

    protected function dataTables()
    {
        $model = Buku::query();

        return DataTables::of($model)
                ->addColumn('action', function($model) {
                    return '<a href="'. route('buku.show', $model->id_buku) .'" class="btn btn-primary btn-show btn-detail" data-toggle="tooltip" data-placement="left" title="Detail Data"><i class="fa fa-eye"></i></a>

                    <a href="'. route('buku.edit', $model->id_buku) .'" class="btn btn-warning btn-show btn-edit" data-toggle="tooltip" data-placement="bottom" title="Update Data"><i class="fa fa-edit"></i></a>
                    
                    <a href="'. route('buku.destroy', $model->id_buku) .'" class="btn btn-danger btn-delete" data-toggle="tooltip" data-placement="right" title="Delete Data"><i class="fa fa-trash"></i></a>';
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $model = new Buku();

        return view('buku.bukuForm', compact('model'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'cover'       => 'required|image|mimes:jpeg,jpg,png|max:4096',
            'judul'       => 'required|string|max:256',
            'noisbn'      => 'required|numeric|max:9999999999999999999999|unique:bukus',
            'penulis'     => 'required|string|max:256',
            'penerbit'    => 'required|string|max:256',
            'tahun'       => 'required|integer|max:999999999999',
            'stok'        => 'required|numeric|max:999999999999',
            'harga_pokok' => 'required|integer|max:999999999999',
            'harga_jual'  => 'required|integer|max:999999999999',
            'ppn'         => 'required|numeric|max:999999999999',
            'diskon'      => 'required|numeric|max:999999999999',
        ]);

        $img = $request->file('cover');
        $new_name = rand().'-'.$request->get('judul').'.'.$img->getClientOriginalExtension();

        if ($img->move(public_path('images_buku'), $new_name))
        {
            Buku::create([
                'cover'         => $new_name,
                'judul'         => $request->get('judul'),
                'noisbn'        => $request->get('noisbn'),
                'penulis'       => $request->get('penulis'),
                'penerbit'      => $request->get('penerbit'),
                'tahun'         => $request->get('tahun'),
                'stok'          => $request->get('stok'),
                'harga_pokok'   => $request->get('harga_pokok'),
                'harga_jual'    => $request->get('harga_jual'),
                'ppn'           => $request->get('ppn'),
                'diskon'        => $request->get('diskon'),
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $model = Buku::findOrFail($id);

        return view('buku.bukuDetail', compact('model'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = Buku::findOrFail($id);

        return view('buku.bukuForm', compact('model'));
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
        $this->validate($request, [
            'cover'       => 'image|mimes:jpeg,jpg,png|max:4096',
            'judul'       => 'required|string|max:256',
            'noisbn'      => 'required|numeric|max:999999999999999999999999|unique:bukus,noisbn,'.$id.',id_buku',
            'penulis'     => 'required|string|max:256',
            'penerbit'    => 'required|string|max:256',
            'tahun'       => 'required|integer|max:999999999999',
            'stok'        => 'required|numeric|max:999999999999',
            'harga_pokok' => 'required|integer|max:999999999999',
            'harga_jual'  => 'required|integer|max:999999999999',
            'ppn'         => 'required|numeric|max:999999999999',
            'diskon'      => 'required|numeric|max:999999999999',
        ]);

        if ($request->has('cover'))
        {
            $img = $request->file('cover');
            $new_name = rand().$request->get('noisbn').'.'.$img->getClientOriginalExtension();
            $path = public_path('images_buku');

            if (unlink($path.'/'.Buku::findOrFail($id)->cover))
            {
                if ($img->move($path, $new_name))
                {
                    Buku::findOrFail($id)->update([
                        'cover' => $new_name,
                    ]);
                }
            } 
        }

        Buku::findOrFail($id)->update([
            'judul'         => $request->get('judul'),
            'noisbn'        => $request->get('noisbn'),
            'penulis'       => $request->get('penulis'),
            'penerbit'      => $request->get('penerbit'),
            'tahun'         => $request->get('tahun'),
            'stok'          => $request->get('stok'),
            'harga_pokok'   => $request->get('harga_pokok'),
            'harga_jual'    => $request->get('harga_jual'),
            'ppn'           => $request->get('ppn'),
            'diskon'        => $request->get('diskon'),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Buku::findOrFail($id)->delete();
    }
}

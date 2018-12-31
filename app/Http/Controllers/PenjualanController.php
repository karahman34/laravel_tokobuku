<?php

namespace App\Http\Controllers;

use App\Buku;
use App\Cart;
use App\Penjualan;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenjualanController extends Controller
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
        $aim = 'Penjualan';
        $title = 'List Penjualan';

        return view('penjualan.penjualanTable', compact('title', 'aim'));
    }

    protected function dataTables()
    {
        $model = Penjualan::query();

        return DataTables::of($model)
                    ->addColumn('action', function($model){
                        return '<a href="'. route('penjualan.destroy', $model->id_penjualan) .'" class="btn btn-danger btn-delete" data-toggle="tooltip" data-placement="right" title="Delete Data"><i class="fa fa-trash"></i></a>';
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
        $title = 'Penjualan';
        $model = Buku::all();    

        return view('penjualan.penjualanForm', compact('data', 'title', 'model'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $modelCart = Cart::where('id_kasir', Auth::id())->get();

        foreach($modelCart as $cart)
        {
            Penjualan::create([
                'id_buku' => $cart->id_buku,
                'id_kasir' => Auth::id(),
                'jumlah' => $cart->jumlah,
                'total' => $cart->harga_total,
            ]);

            $modelBuku = Buku::where('id_buku', $cart->id_buku)->get();

            foreach($modelBuku as $buku)
            {
                Buku::where('id_buku', $cart->id_buku)->update([
                    'stok' => $buku->stok-$cart->jumlah,
                ]);
            }

            Cart::where('id_buku', $cart->id_buku)->delete();
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
        $model = Penjualan::findOrFail($id);

        return view('penjualan.penjualanForm', compact('model'));
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
        //
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

<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Buku;
use DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function __construct()
    {        
        $this->middleware(['auth', 'verified']);

        $this->middleware(function ($request, $next) {
            if (Auth::user()->akses !== 'kasir')
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
        $title = 'Cart';
        $model = Buku::all();
        $aim = 'Cart';
        $hartot = 0;

        $total_harga = Cart::select('harga_total', 'jumlah')->where('id_kasir', Auth::id())->get();

        foreach($total_harga as $totga)
        {
            $hartot += $totga->harga_total;
        }

        return view('cart.cartForm', compact('title', 'model', 'hartot', 'aim'));
    }

    protected function dataTables()
    {
        $model = DB::table('carts')
                    ->join('bukus', 'bukus.id_buku', 'carts.id_buku')
                    ->select('bukus.judul', 'bukus.cover', 'bukus.harga_jual', 'carts.id_cart', 'carts.harga_total', 'carts.jumlah')
                    ->where('carts.id_kasir', Auth::id())
                    ->get();                 

        return DataTables::of($model)
                    ->addColumn('action', function($model){
                        return '<a href="'. route('cart.edit', $model->id_cart) .'" class="btn btn-warning btn-show" title="Edit Data"><i class="fa fa-edit"></i></a>
                        <a href="'. route('cart.destroy', $model->id_cart) .'" class="btn btn-danger btn-delete" title="Delete Data"><i class="fa fa-trash"></i></a>';
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
        $this->validate($request, [
            'jumlahB' => 'required|integer|min:1',
            'buku' => 'required|integer|min:1|unique:carts,id_buku',
        ]);

        $buku = Buku::where('id_buku', $request->get('buku'))->get();

        if ($buku[0]->stok == 0)
        {
            return ['status' => false];
        }
        else
        {
            $harga_total = ($buku[0]->harga_jual-($buku[0]->harga_jual*($buku[0]->diskon/100)))*$request->get('jumlahB')+(($buku[0]->harga_jual-($buku[0]->harga_jual*($buku[0]->diskon/100)))*$request->get('jumlahB')*($buku[0]->ppn/100));

            Cart::create([
                'id_buku'       => $request->get('buku'),
                'id_kasir'      => Auth::id(),
                'harga_total'   => $harga_total,
                'jumlah'        => $request->get('jumlahB'),
            ]);
            
            $buku = Buku::findOrFail($request->get('buku'));

            $buku->update([
                'stok' => $buku->stok-$request->get('jumlahB'),
            ]);

            $total_harga = Cart::select('harga_total', 'jumlah')->where('id_kasir', Auth::id())->get();
            $hartot = 0;

            foreach($total_harga as $totga)
            {
                $hartot += $totga->harga_total;
            }

            return $hartot;
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
        $model = Cart::findOrfail($id);

        return view('cart.cartEdit', compact('model'));
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
            'jumlah' => 'required|string|min:1',
        ]);
        
        $carts = DB::table('carts')
                    ->join('bukus', 'bukus.id_buku', 'carts.id_buku')
                    ->select('bukus.harga_jual', 'bukus.ppn', 'bukus.diskon', 'bukus.stok', 'bukus.id_buku', 'carts.jumlah')
                    ->where('carts.id_cart', $id)
                    ->get();    
        
        $harga_total = ($carts[0]->harga_jual-($carts[0]->harga_jual*($carts[0]->diskon/100)))*$request->get('jumlah')+(($carts[0]->harga_jual-($carts[0]->harga_jual*($carts[0]->diskon/100)))*$request->get('jumlah')*($carts[0]->ppn/100));

        Cart::findOrFail($id)->update([
            'jumlah' => $request->get('jumlah'),
            'harga_total' => $harga_total,
        ]);

        Buku::findOrFail($carts[0]->id_buku)->update([
            'stok' => $carts[0]->stok+($carts[0]->jumlah-$request->get('jumlah')),
        ]);

        return $harga_total;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $carts = DB::table('carts')
                    ->join('bukus', 'bukus.id_buku', 'carts.id_buku')
                    ->select('bukus.id_buku', 'bukus.stok', 'carts.jumlah')
                    ->where('carts.id_cart', $id)
                    ->get();                   

        Buku::find($carts[0]->id_buku)->update([
            'stok' => $carts[0]->stok+$carts[0]->jumlah,
        ]);

        Cart::findOrFail($id)->delete();
    }

    public function clearAll()
    {  
        $carts = DB::table('carts')
                    ->join('bukus', 'bukus.id_buku', 'carts.id_buku')
                    ->select('bukus.id_buku', 'bukus.stok', 'carts.jumlah')
                    ->where('carts.id_kasir', Auth::id())
                    ->get();

        for($i = 0; $i < count($carts); $i ++)
        {
            Buku::find($carts[$i]->id_buku)->update([
                'stok' => $carts[$i]->stok+$carts[$i]->jumlah,
            ]);
        }                            

        Cart::where('id_kasir', Auth::id())->delete();
    }
}

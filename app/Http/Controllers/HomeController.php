<?php
namespace App\Http\Controllers;

use App\User;
use App\Buku;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
     /**
     *
     * @return void
     */
    public function __construct()
    {        
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->akses == 'kasir')
        {
            return redirect()->route('cart.index');
        }

        $aim = 'Home Panel';
        return view('home', compact('aim'));
    }

    protected function dataTables()
    {
        $model = Buku::query(); 
        
        return DataTables::of($model)
                ->addColumn('action', function($model) {
                    return view('layouts._action', [
                        'url_detail' => route('buku.show', $model->id_buku),
                        'url_edit' => route('buku.edit', $model->id_buku),
                        'url_delete' => route('buku.destroy', $model->id_buku),
                    ]);    
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
    }
    
    protected function hai()
    {
        return "hallo";
    }
}

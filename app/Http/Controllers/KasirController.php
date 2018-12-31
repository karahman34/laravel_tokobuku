<?php

namespace App\Http\Controllers;

use App\Kasir;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KasirController extends Controller
{
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
        $title = 'List Kasir';
        $aim = 'Kasir';

        return view('kasir.kasirTable', compact('title', 'aim'));
    }

    protected function dataTables()
    {
        $model = Kasir::query();

        return DataTables::of($model)
                ->addColumn('action', function($model) {
                    return '<a href="'. route('kasir.show', $model->id_kasir) .'" class="btn btn-show btn-primary btn-detail" data-toggle="tooltip" data-placement="left" title="Detail Data"><i class="fa fa-eye"></i></a>
                            <a href="'. route('kasir.destroy', $model->id_kasir) .'" class="btn btn-danger btn-delete" data-toggle="tooltip" data-placement="right" title="Delete Data"><i class="fa fa-trash"></i></a>';  
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
        $model = Kasir::findOrFail($id);

        return view('kasir.kasirDetail', compact('model'));
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
        Kasir::findOrFail($id)->delete();
    }
}

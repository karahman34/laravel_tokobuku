<?php

namespace App\Http\Controllers;

use App\Pasok;
use DataTables;
use Illuminate\Http\Request;

class PasokController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'List Pasok';
        $aim = 'Pasok';

        return view('pasok.pasokTable', compact('title', 'aim'));
    }

    protected function dataTables()
    {
        $model = Pasok::query();

        return DataTables::of($model)
                    ->addColumn('action', function($model){
                        return '<a href="'. route('pasok.edit', $model->id_pasok) .'" class="btn btn-warning btn-show btn-edit" data-toggle="tooltip" data-placement="bottom" title="Update Data"><i class="fa fa-edit"></i></a>

                        <a href="'. route('pasok.destroy', $model->id_pasok) .'" class="btn btn-danger btn-delete" data-toggle="tooltip" data-placement="right" title="Delete Data"><i class="fa fa-trash"></i></a>';
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
        $model = new Pasok();

        return view('pasok.pasokForm', compact('model'));
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
            'id_distributor' => 'required|string',
            'id_buku' => 'required|string',
            'jumlah' => 'required|numeric|max:9999999',
        ]);

        Pasok::create([
            'id_distributor' => $request->get('id_distributor'),
            'id_buku' => $request->get('id_buku'),
            'jumlah' => $request->get('jumlah'),
        ]);
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
        $model = Pasok::findOrFail($id);

        return view('pasok.pasokForm', compact('model'));
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
            'id_distributor' => 'required|string',
            'id_buku' => 'required|string',
            'jumlah' => 'required|numeric|max:9999999',
        ]);

        Pasok::findOrFail($id)->update([
            'id_distributor' => $request->get('id_distributor'),
            'id_buku' => $request->get('id_buku'),
            'jumlah' => $request->get('jumlah'),
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
        Pasok::findOrFail($id)->delete();
    }
}

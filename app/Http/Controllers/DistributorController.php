<?php

namespace App\Http\Controllers;

use App\Distributor;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DistributorController extends Controller
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
        $tb = 'distributor';
        $title = 'List Distributor';
        $aim = 'Distributor';

        return view('distributor.distributorTable', compact('title', 'tb', 'aim'));
    }

    protected function hai()
    {
        return "Hai";
    }

    protected function dataTables()
    {
        $model = Distributor::query();

        return DataTables::of($model)
                    ->addColumn('action', function($model){
                        return '<a href="'. route('distributor.edit', $model->id_distributor) .'" class="btn btn-warning btn-show btn-edit" data-toggle="tooltip" data-placement="bottom" title="Update Data"><i class="fa fa-edit"></i></a>

                        <a href="'. route('distributor.destroy', $model->id_distributor) .'" class="btn btn-danger btn-delete" data-toggle="tooltip" data-placement="right" title="Delete Data"><i class="fa fa-trash"></i></a>';
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
        $model = new Distributor();

        return view('distributor.distributorForm', compact('model'));
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
            'nama_distributor'  => 'required|string|max: 255',
            'alamat'            => 'required|string|max:255',
            'telepon'           => 'required|string|min:10|max:15'
        ]);

        Distributor::create([
            'nama_distributor'  => $request->get('nama_distributor'),
            'alamat'            => $request->get('alamat'),
            'telepon'           => $request->get('telepon')
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
        $model = Distributor::findOrFail($id);

        return view('distributor.distributorForm', compact('model'));
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
            'nama_distributor' => 'required|string|max:256',
            'alamat' => 'required|string|max:256',
            'telepon' => 'required|string|min:10|max:15',
        ]);

        Distributor::create([
            'nama_distributor' => $request->get('nama_distributor'),
            'alamat' => $request->get('alamat'),
            'telepon' => $request->get('telepon'),
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
        Distributor::findOrFail($id)->delete();
    }
}

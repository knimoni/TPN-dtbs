<?php

namespace App\Http\Controllers;

use App\Models\Farm;
use App\Models\Supervisor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class FarmController extends Controller
{
    public function index() {
        $datas = DB::select('select * from Farm');

        return view('Supervisor.index')
            ->with('datas', $datas);
    }

    public function create() {
        $Supervisor = Supervisor::all();
        return view('Farm.add',compact('Supervisor'));
    }

    public function store(Request $request) {
        $request->validate([
            'farm_id' => 'required',
            'farm_name' => 'required',
            'farm_identifier' => 'required',
            'supervisor_id' => 'required',
        ]);

        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::insert('INSERT INTO Farm(farm_id, farm_name, farm_identifier,supervisor_id ) VALUES (:farm_id, :farm_name, :farm_identifier, :supervisor_id)',
        [
            'farm_id' => $request->farm_id,
            'farm_name' => $request->farm_name,
            'farm_identifier' => $request->farm_identifier,
            'supervisor_id' => $request->supervisor_id,
        ]
        );
        return redirect()->route('Supervisor.index')->with('success', 'Farm data saved successfully');
    }

    public function edit($id) {
        $data = DB::table('Farm')->where('farm_id', $id)->first();
        $Supervisor = Supervisor::all();
        return view('Farm.edit')->with('data', $data,compact('Supervisor'));
    }

    public function update($id, Request $request) {
        $request->validate([
            'farm_id' => 'required',
            'farm_name' => 'required',
            'farm_identifier' => 'required',
            'supervisor_id' => 'required',
        ]);

        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::update('UPDATE Farm SET farm_id = :farm_id, farm_name = :farm_name, farm_identifier = :farm_identifier, supervisor_id = :supervisor_id WHERE farm_id = :id',
        [
            'id' => $id,
            'farm_id' => $request->farm_id,
            'farm_name' => $request->farm_name,
            'farm_identifier' => $request->farm_identifier,
            'supervisor_id' => $request->supervisor_id,
        ]
        );
        return redirect()->route('Supervisor.index')->with('success', 'Farm data successfully changed');
    }

    public function delete($id) {
        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::table('Farm')
        ->where('farm_id', $id)
        ->delete();

        // Menggunakan laravel eloquent
        // Ikan::where('id_ikan', $id)->delete();

        return redirect()->route('Supervisor.index')->with('success', 'Farm data successfully deleted');
    }
    public function softDelete($id)
    {
        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::update('UPDATE Farm SET is_deleted = 1
        WHERE farm_id = :farm_id', ['farm_id' => $id]);
        return redirect()->route('Supervisor.index')->with('success', 'Farm data successfully deleted');
    }

    public function restore()
    {
        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::table('Farm')
        ->update(['is_deleted' => 0]);
        return redirect()->route('Supervisor.index')->with('success', 'Farm data successfully restored');
    }
}
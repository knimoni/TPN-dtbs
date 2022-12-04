<?php

namespace App\Http\Controllers;

use App\Models\Farm;
use App\Models\supervisor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class FarmController extends Controller
{
    public function index() {
        $datas = DB::select('select * from farm');

        return view('supervisor.index')
            ->with('datas', $datas);
    }

    public function create() {
        $supervisor = supervisor::all();
        return view('farm.add',compact('supervisor'));
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
        return redirect()->route('supervisor.index')->with('success', 'Farm data saved successfully');
    }

    public function edit($id) {
        $data = DB::table('farm')->where('farm_id', $id)->first();
        $supervisor = supervisor::all();
        return view('farm.edit')->with('data', $data,compact('supervisor'));
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
        return redirect()->route('supervisor.index')->with('success', 'Farm data successfully changed');
    }

    public function delete($id) {
        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::table('farm')
        ->where('farm_id', $id)
        ->delete();

        // Menggunakan laravel eloquent
        // Ikan::where('id_ikan', $id)->delete();

        return redirect()->route('supervisor.index')->with('success', 'Farm data successfully deleted');
    }
    public function softDelete($id)
    {
        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::update('UPDATE farm SET is_deleted = 1
        WHERE farm_id = :farm_id', ['farm_id' => $id]);
        return redirect()->route('supervisor.index')->with('success', 'Farm data successfully deleted');
    }

    public function restore()
    {
        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::table('farm')
        ->update(['is_deleted' => 0]);
        return redirect()->route('supervisor.index')->with('success', 'Farm data successfully restored');
    }
}
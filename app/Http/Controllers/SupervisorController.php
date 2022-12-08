<?php

namespace App\Http\Controllers;

use App\Models\Children;
use App\Models\Farm;
use App\Models\Supervisor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SupervisorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }   

    public function index(Request $request)
    {
        $katakunci = $request->katakunci;
        if (strlen($katakunci)) {
            $datas = DB::table('supervisor')
                ->where('supervisor_name', 'like', "%$katakunci%")
                ->orWhere('supervisor_identifier', 'like', "%$katakunci%")
                ->paginate(5);
        } else {
            $datas = DB::select('select * from supervisor where is_deleted=0');
        }
        if (strlen($katakunci)) {
            $childrens = DB::table('children')
                ->where('children_name', 'like', "%$katakunci%")
                ->orWhere('children_identifier', 'like', "%$katakunci%")
                ->paginate(3);
        } else {
            $childrens = DB::select('select * from children where is_deleted=0');
        }
        if (strlen($katakunci)) {
            $farms = DB::table('farm')
                ->where('farm_name', 'like', "%$katakunci%")
                ->orWhere('farm_identifier', 'like', "%$katakunci%")
                ->paginate(3);
        } else {
            $farms = DB::select('select * from farm where is_deleted=0');
        }
        $joins = DB::table('children')
            ->join('supervisor', 'supervisor.supervisor_id', '=', 'children.supervisor_id')
            ->select('children.*', 'supervisor.*')
            ->where('children.is_deleted', '0')
            ->where('supervisor.is_deleted', '0')
            ->get();
        $joins2 = DB::table('farm')
            ->join('supervisor', 'supervisor.supervisor_id', '=', 'farm.supervisor_id')
            ->select('farm.*', 'supervisor.*')
            ->where('farm.is_deleted', '0')
            ->where('supervisor.is_deleted', '0')
            ->get();
        $joins3 = DB::table('children')
        ->join('supervisor', 'supervisor.supervisor_id', '=', 'children.supervisor_id')
        ->join('farm', 'farm.supervisor_id', '=', 'supervisor.supervisor_id')
        ->select('children.*', 'supervisor.*', 'farm.*')
        ->where('supervisor.is_deleted', '0')
        ->where('children.is_deleted', '0')
        ->where('farm.is_deleted', '0')
        ->get();
        return view('supervisor.index')
            ->with('datas', $datas)
            ->with('childrens', $childrens)
            ->with('farms', $farms)
            ->with('joins',$joins)
            ->with('joins2',$joins2)
            ->with('joins3',$joins3);
    }

    public function create()
    {
        return view('supervisor.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'supervisor_id' => 'required',
            'supervisor_name' => 'required',
            'supervisor_identifier' => 'required',
        ]);

        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::insert(
            'INSERT INTO supervisor(supervisor_id, supervisor_name, supervisor_identifier ) VALUES (:supervisor_id, :supervisor_name, :supervisor_identifier)',
            [
                'supervisor_id' => $request->supervisor_id,
                'supervisor_name' => $request->supervisor_name,
                'supervisor_identifier' => $request->supervisor_identifier,
            ]
        );
        return redirect()->route('supervisor.index')->with('success', 'The supervisor data has been successfully saved');
    }

    public function edit($id)
    {
        $data = DB::table('supervisor')->where('supervisor_id', $id)->first();

        return view('supervisor.edit')->with('data', $data);
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'supervisor_id' => 'required',
            'supervisor_name' => 'required',
            'supervisor_identifier' => 'required',


        ]);

        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::update(
            'UPDATE supervisor SET supervisor_id = :supervisor_id, supervisor_name = :supervisor_name, supervisor_identifier = :supervisor_identifier WHERE supervisor_id = :id',
            [
                'id' => $id,
                'supervisor_id' => $request->supervisor_id,
                'supervisor_name' => $request->supervisor_name,
                'supervisor_identifier' => $request->supervisor_identifier,
            ]
        );
        return redirect()->route('supervisor.index')->with('success', 'Data supervisor berhasil diubah');
    }

    public function delete($id)
    {
        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::table('supervisor')
        ->where('supervisor_id', $id)
        ->delete();
        return redirect()->route('supervisor.index')->with('success', 'Supervisor data has been successfully deleted');
    }

    public function softDelete($id)
    {
        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::update('UPDATE supervisor SET is_deleted = 1
        WHERE supervisor_id = :supervisor_id', ['supervisor_id' => $id]);
        return redirect()->route('supervisor.index')->with('success', 'Supervisor data has been successfully deleted');
    }

    public function restore()
    {
        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::table('supervisor')
        ->update(['is_deleted' => 0]);
        return redirect()->route('supervisor.index')->with('success', 'Supervisor data was successfully restored');
    }
}

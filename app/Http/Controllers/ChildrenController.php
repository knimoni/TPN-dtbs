<?php

namespace App\Http\Controllers;

use App\Models\Children;
use App\Models\supervisor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ChildrenController extends Controller
{
    public function index(){
        $datas = DB::select('select * from children');
        return view('supervisor.index')
            ->with('datas', $datas);
    }
    public function create() {
        $supervisor = supervisor::all();
        return view('children.add',compact('supervisor'));
    }

    public function store(Request $request) {
        $request->validate([
            'children_id' => 'required',
            'children_name' => 'required',
            'children_identifier' => 'required',
            'children_bloodtype' => 'required',
            'children_birthday' => 'required',
            // 'images' => 'required',
            'supervisor_id' => 'required'
        ]);
        DB::insert('INSERT INTO children(children_id, children_name, children_identifier, children_bloodtype, children_birthday, supervisor_id) VALUES (:children_id, :children_name, :children_identifier, :children_bloodtype, :children_birthday, :supervisor_id)',
        [
            'children_id' => $request->children_id,
            'children_name' => $request->children_name,
            'children_identifier' => $request->children_identifier,
            'children_bloodtype' => $request->children_bloodtype,
            'children_birthday' => $request->children_birthday,
            'supervisor_id' => $request->supervisor_id,
            // 'images' => $request->images,
        ]);
        return redirect()->route('supervisor.index')->with('success', 'The child data has been successfully saved');
    }
    public function edit($id) {
        $data = DB::table('children')->where('children_id', $id)->first();
        $supervisor = supervisor::all();
        return view('children.edit')->with('data', $data,compact('supervisor'));
    }
    public function update($id, Request $request) {
        $request->validate([
            'children_id' => 'required',
            'children_name' => 'required',
            'children_identifier' => 'required',
            'children_bloodtype' => 'required',
            'children_birthday' => 'required',
            // 'images' => 'required',
            'supervisor_id' => 'required',
        ]);
 // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
 DB::update('UPDATE children SET children_id = :children_id, children_name = :children_name,  children_identifier = :children_identifier, children_bloodtype = :children_bloodtype, children_birthday = :children_birthday, supervisor_id = :supervisor_id WHERE children_id = :id',
 [
     'id' => $id,
     'children_id' => $request->children_id,
     'children_name' => $request->children_name,
     'children_identifier' => $request->children_identifier,
     'children_bloodtype' => $request->children_bloodtype,
     'children_birthday' => $request->children_birthday,

     'supervisor_id' => $request->supervisor_id,
 ]
 );
 return redirect()->route('supervisor.index')->with('success', 'Child data has been changed successfully');
}
public function delete($id) {
    // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
    DB::table('children')
    ->where('children_id', $id)
    ->delete();

    return redirect()->route('supervisor.index')->with('success', 'Data has been successfully deleted');
}
public function softDelete($id)
    {
        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::update('UPDATE children SET is_deleted = 1
        WHERE children_id = :children_id', ['children_id' => $id]);
        return redirect()->route('supervisor.index')->with('success', 'Data has been successfully deleted');
    }
    public function restore()
    {
        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::table('children')
        ->update(['is_deleted' => 0]);
        return redirect()->route('supervisor.index')->with('success', 'Data successfully restored');
    }

}

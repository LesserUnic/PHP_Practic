<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;
use App\Http\Resources\NoteResource;


class NoteController extends Controller
{
    //
    public function index(){
        return "Good";
    }

    public function show(){
        return new NoteResource(Note::all());
    }

    public function create(Request $request){
        $validated = $request->validate([
            'name' => 'required|string', 
            'note' => 'required|string', 
            'status' => 'integer'
        ]);

        $notes = Note::Create([
            'name' => $validated['name'], 
            'note' => $validated['note'], 
            'status' => $validated['status']
        ]);
        return redirect()->route("notes");
    }

    public function destroy(Int $id){
        $note=Note::query()->find($id);
        if($note!=null){
            $note->delete();
            return redirect()->route("notes");
        }
        else{
            return "Error, incorrect id";
        }
    }

    public function update(Request $request, int $id){
        $note=Note::query()->find($id);
        $request->validate([
            'name' => 'nullable|string',
            'note' => 'nullable|string', 
            'status' => 'nullable|integer'
        ]);
        if($note!=null){
            if($request['name']!=null){
                $note->name=$request['name'];
            }
            if($request['note']!=null){
                $note->note=$request['note'];
            }
            if($request['status']!=null){
                $note->status=$request['status'];
            }
            $note->save();
        }
        return redirect()->route('notes');

    }
}

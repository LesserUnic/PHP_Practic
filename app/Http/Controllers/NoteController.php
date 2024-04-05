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
        //$notes=Note::all()->first();
        return new NoteResource(Note::all());
    }

    public function create(Request $request){
        $notes=Note::updateOrCreate([
            "Name" => $request->input('name'),
            "Note" => $request->input('note'),
            "Status" => $request->input('status'),
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
        if($note!=null){
            if($request->input('name')!=null){
                $note->Name=$request->input('name');
            }
            if($request->input('note')!=null){
                $note->Note=$request->input('note');
            }
            if($request->input('status')!=null){
                $note->Status=$request->input('status');
            }
            $note->save();
        }
        return redirect()->route('notes');

    }
}

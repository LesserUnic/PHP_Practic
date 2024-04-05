<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ToDos;
use App\Http\Resources\ToDosResource;

class TodosController extends Controller
{
    public function index(){
        return "Good";
    }

    public function show(Int $id){
        $todos=ToDos::query()->where("note_id", $id)->get();
        return new ToDosResource($todos);
    }

    public function create(Request $request, Int $id){
        $todos = ToDos::Create(
            ['note_id' => $id, 'description' => $request->input('description'), 'is_complete'=>0]
        );
        return redirect()->route('todos', $id);
    }

    public function destroy(Request $request, Int $note_id){
        if($note_id==null){
            return "Error, incorrect note_id";
        }
        if($request->input('todo_id')==-1){
            $todos=ToDos::query()
                ->where('note_id', $note_id);
            foreach($todos as $todo)
                $todo->delete();    
            return redirect()->route("notes");
        }
        else{
            $todo=ToDos::query()
                ->where('note_id', $note_id)
                ->find($request->input('todo_id'));
            if($todo!=null){
                $todo->delete();
                return redirect()->route("todos", $note_id);
            }
            else{
                return "Error, incorrect todo_id";
            }
        }
    }

    public function update(Request $request, Int $note_id, Int $todo_id){
        $todo=ToDos::query()->where('note_id', $note_id)->find($todo_id);
        if($todo!=null){
            if($request->input('description')!=null){
                $todo->description=$request->input('description');
            }
            if($request->input('is_complete')!=null){
                $todo->is_complete=$request->input('is_complete');
            }
            $todo->save();
        }
        return redirect()->route('todos', $note_id);

    }
}

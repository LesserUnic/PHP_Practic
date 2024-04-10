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
        $request->validate([
            'description' => 'required|String',
        ]);
        $todos = ToDos::Create(
            ['note_id' => $id, 'description' => $request['description'], 'is_complete'=>0]
        );
        return redirect()->route('todos', $id);
    }

    public function destroy(Request $request, Int $note_id){
        if($note_id==null){
            return "Error, incorrect note_id";
        }

        $request->validate(['todo_id' => 'integer']);

        if($request['todo_id'] == 0){
            $todos=ToDos::query()
                ->where('note_id', $note_id);

            foreach($todos->get() as $todo){
                $todo->delete();    
            }

            return redirect()->route("notes");
        }
        else{
            $todo=ToDos::query()
                ->where('note_id', $note_id)
                ->find($request['todo_id']);
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
        $request->validate([
            'description' => 'nullable|string',
            'is_complete' => 'nullable|bollean'
        ]);
        if($todo != null){
            if($request['description'] != null){
                $todo->description = $request['description'];
            }
            if($request['is_complete'] != null){
                $todo->is_complete = $request['is_complete'];
            }
            $todo->save();
        }
        return redirect()->route('todos', $note_id);

    }
}

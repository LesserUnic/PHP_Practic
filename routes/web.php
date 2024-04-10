<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\TodosController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::get('/', [NoteController::class, 'index']);                                                          //Base return
//Мб проапдейтить последние руты чтобы вызывался один контроллер, ? после имени переменной и значение по умолчанию
Route::get('/api/notes', [NoteController::class, 'show'])->name("notes");                             //list of notes
Route::get('/api/notes/{id}/todos', [TodosController::class, 'show'])->name('todos');                  //list of todos
Route::post('/api/notes/{id}/todos', [TodosController::class, 'create']);                              //create todos in note
Route::post('/api/notes', [NoteController::class, 'create']);                                          //create note
Route::patch('/api/notes/{id}', [NoteController::class, 'update']);                                    //update note
Route::patch('/api/notes/{note_id}/todos/{todo_id}', [TodosController::class, 'update']);              //update todos
Route::delete('/api/notes/{id}', [NoteController::class, 'destroy']);                                   //delete note
//Route::delete('/api/notes/{note_id}/todos', [TodosController::class, 'destroy']);                       //delete all todos
Route::delete('/api/notes/{note_id}/todos/{todo_id}', [TodosController::class, 'destroy']);             //delete todos



    /*
- GET /api/notes - список всех заметок;
- GET /api/notes/{id}/todos - список всех задач заметки;
- POST /api/notes - создание заметки;
- PATCH /api/notes/{id} - обновление заметки;
- POST /api/notes/{id}/todos - добавление задач(-и);
- PATCH /api/notes/{note_id}/todos/{todo_id} - обновление задачи;
- PATCH /api/notes/{id}/todos - обновление задач;
- DELETE /api/notes/{id} - удаление заметки;
- DELETE /api/notes/{note_id}/todos/{todo_id} - удаление задачи;
- DELETE /api/notes/{id}/todos - удаление задач.
    */
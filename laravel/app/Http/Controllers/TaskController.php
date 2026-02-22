<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function destroy(Task $task)
    {
        //
    }

    public function getAllTasks()
    {
        return Task::with([
                'users' => function($qry) {
                    $qry->select('id', 'name as nameUser', 'email as emailUser');
                },
                'comments',
                'columns' => function($qry) {
                    $qry->select('id', 'name as nameColumn', 'position as positionColumn', 'project_id');
                }
            ])
            ->orderBy('columns_id')
            ->orderBy('position')
            ->get();
    }

    public static function getTasksByIdColumn($id)
    {
        return Task::where('columns_id', $id)->get();
    }

    public static function getTasksById($id)
    {
        return Task::where('id', $id)
            ->with('users')
            ->with('comments')
            ->get();
    }

    public function setStatusTask($id, Request $request)
    {
        $newStatus      = $request->status;
        $task           = Task::find($id);

        if(!$task)
        {
            return response()->json(['error' => 'Erro ao editar status da task'], 401);
        }
        
        $task->status   = $newStatus;
        $task->save();
        return response()->json(['success' => 'Task atualizada com sucesso'], 200);
    }
}

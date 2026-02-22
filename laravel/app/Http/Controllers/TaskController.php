<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function store(Request $request)
    {
        try
        {
            $name       = $request->name;
            $columns_id = $request->columns_id;
            $status     = $request->status;
            $position   = (int)$this->getLastPosition($columns_id) + 1;
            // echo $position;exit;

            Task::create([
                'name'          => $name,
                'description'   => $request->description ?? '',
                'position'      => $position,
                'status'        => $status,
                'columns_id'    => $columns_id,
                'created_by'    => $request->user_id,
            ]);

            return response()->json(['success' => 'Task salvo com sucesso!'], 201);
        }
        catch (\Throwable $th)
        {
            return response()->json(['success' => $th->getMessage()], 401);
        }
    }
        
    public function destroy($id)
    {
        if (!Task::find($id))
        {
            return response()->json(['error' => 'Erro ao deletar Task!'], 501);
        }
        
        Task::destroy($id);
        return response()->json(['success' => 'Task deletada com sucesos!'], 200);
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

    public function editTask($id, Request $request)
    {
        $task           = Task::find($id);

        if(!$task)
        {
            return response()->json(['error' => 'Erro ao editar task'], 401);
        }
        
        $task->name         = $request->name;
        $task->description  = $request->description;
        $task->status       = $request->status;
        $task->columns_id   = $request->columns_id;
        $task->created_by   = $request->created_by;
        
        $task->save();
        return response()->json(['success' => 'Task atualizada com sucesso'], 200);
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

    private function getLastPosition($idColumn)
    {
        return (Task::where('columns_id', $idColumn)->max('position'));
    }

    public function reorder(Request $request)
    {
        foreach ($request->ordered_ids as $index => $taskId) {

            Task::where('id', $taskId)
                ->update(['position' => $index]);
        }

        return response()->json(['success' => true]);
    }
}

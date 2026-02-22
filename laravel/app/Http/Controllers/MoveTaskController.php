<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MoveTaskController extends Controller
{
    public function __invoke(Request $request)
    {
        DB::transaction(function () use ($request) {

            $task = Task::findOrFail($request->task_id);

            // muda de coluna se necessário
            if ($task->column_id != $request->column_id) {
                $task->update([
                    'column_id' => $request->column_id
                ]);
            }

            // reordena tudo
            foreach ($request->positions as $index => $taskId) {
                Task::where('id', $taskId)->update([
                    'position' => $index
                ]);
            }
        });

        return response()->json(['success' => true]);
    }
}

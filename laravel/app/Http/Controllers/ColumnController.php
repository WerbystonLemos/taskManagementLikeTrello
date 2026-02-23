<?php

namespace App\Http\Controllers;

use App\Models\Column;
use Exception;
use Illuminate\Http\Request;

class ColumnController extends Controller
{
    public function getAllColumns()
    {
        return Column::All();
    }

    public static function getColumnById($id)
    {
        return Column::where('project_id', $id)->get();
    }

    public static function getColumnsWithTasksByProjectId($projectId)
    {
        return Column::where('project_id', $projectId)
            ->with('tasks')
            ->orderBy('position')
            ->get();
    }

    public static function getColumnsWithTasksByIdProject($projectId)
    {
        return Column::where('project_id', $projectId)
            ->with(['tasks' => function($qry) {
                $qry->select()->orderBy('position');
            }])
            ->orderBy('position')
            ->get();
    }

    public static function saveColumn(Request $request)
    {
        try
        {
            $lastPosition = count(self::getColumnsWithTasksByProjectId($request->project_id));

            // print_r($lastPosition);exit;

            Column::create([
                'name'          => $request->name,
                'project_id'    => $request->project_id,
                'position'      => (int) $lastPosition ?? '',
            ]);
            
            return response()->json(['success' => 'Coluna salva com sucesso!'], 201);
        }
        catch (\Throwable $th)
        {
            return response()->json(['error' => $th->getMessage()], 501);
        }
    }

    public static function destroyColumn($id)
    {
        $idProject = Column::find($id)->project_id;

        if(!Column::find($id)->first())
        {
            throw new Exception("Erro ao deletar coluna.", 1);                
        }
        Column::destroy($id);
        redirect("dashboard/".$idProject);
    }

    public function reorder(Request $request)
    {
        foreach ($request->ordered_ids as $index => $columnId) {

            Column::where('id', $columnId)
                ->update(['position' => $index]);
        }

        return response()->json(['success' => true]);
    }
}

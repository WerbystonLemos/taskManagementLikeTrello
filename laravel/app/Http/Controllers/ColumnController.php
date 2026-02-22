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

    public static function saveColumn(Request $request)
    {
        $lastPosition = count(self::getColumnsWithTasksByProjectId($request->project_id));
        Column::create([
            'name'          => $request->name,
            'project_id'    => $request->project_id,
            'position'      => $lastPosition,
        ]);
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
}

<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    /**
     * Remove the specified resource from storage.
     */
    public static function destroy(Request $request)
    {
        $id = $request->id;

        if (!Project::find($id))
        {
            throw new Exception("Projeto não encontrado", 1);
            return redirect('/projects');
        }

        Project::destroy($id);
    }

    public function getAllProjects()
    {
        return Project::All();
    }

    public function saveProject(Request $request)
    {
        $nameProject    = $request->nameProject;
        $description    = $request->description;
        $user_id        = $request->user_id;

        Project::create([
            'name'          => $nameProject,
            'description'   => $description,
            'user_id'      => $user_id
        ]);
    }
}

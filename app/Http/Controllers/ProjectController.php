<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddProjectRequest;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function get_projects(){
        $projects=Project::get()->all();
        foreach($projects as $project){
            $project->author=$project->user;
        }
        return response()->json($projects);
    }

    public function add_project(AddProjectRequest $request){
        $project=Project::create([
            'name' => $request->name,
            'user_id' => Auth::user()->id
        ]);

        return response()->json($project);
    }
    public function delete_project($id){
        $project=Project::find($id);
        $project->modules->delete();
        Project::delete($id);
        $projects=Project::get()->all();
        foreach($projects as $project){
            $project->author=$project->user;
        }
        return response()->json($projects);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddModuleRequest;
use App\Http\Requests\AddProjectRequest;
use App\Http\Requests\AddTaskRequest;
use App\Models\Module;
use App\Models\Task;
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
            $project->modules=$project->modules()->get();
            if($project->modules) {
                foreach ($project->modules as $module){
                    $module->tasks=$module->tasks()->get();
                }
            }
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

    public function add_module(AddModuleRequest $request)
    {
        $module = Module::create([
            'name' => $request->name,
            'project_id' => $request->project_id
        ]);

        $project = Project::find($request->project_id);
        $project->modules = $project->modules()->get();
        if($project->modules) {
            foreach ($project->modules as $module){
                $module->tasks=$module->tasks()->get();
            }
        }


        return response()->json($project);
    }


        public function add_task(AddTaskRequest $request){
        $hours=$request->best_hours+$request->worst_hours;
        $minutes=$request->best_minutes+$request->worst_minutes;
        $average_hours=$hours/2;
        $average_minutes=$minutes/2;
            $task=Task::create([
                'name' => $request->name,
                'module_id' => $request->module_id,
                'best_hours' => $request->best_hours,
                'best_minutes' => $request->best_minutes,
                'worst_hours' => $request->worst_hours,
                'worst_minutes' => $request->worst_minutes,
                'average_hours' => $average_hours,
                'average_minutes' => $average_minutes
            ]);

            $module=Module::find($request->module_id);
            $module_tasks=$module->tasks()->get();
            $module_best_hours=0;
            $module_best_minutes=0;
            $module_worst_hours=0;
            $module_worst_minutes=0;
            foreach($module_tasks as $task){
                $module_best_hours+=$task->best_hours;
                $module_best_minutes+=$task->best_minutes;
                $module_worst_hours+=$task->worst_hours;
                $module_worst_minutes+=$task->worst_minutes;
            }
            while($module_best_minutes>59){
                $module_best_hours++;
                $module_best_minutes-=60;
            }
            while($module_worst_minutes>59){
                $module_worst_hours++;
                $module_worst_minutes-=60;
            }
            $module_hours=$module_best_hours+$module_worst_hours;
            $module_minutes=$module_best_minutes+$module_worst_minutes;
            $module_average_hours=$module_hours/2;
            $module_average_minutes=$module_minutes/2;

            $module->average_hours=$module_average_hours;
            $module->average_minutes=$module_average_minutes;
            $module->best_hours=$module_best_hours;
            $module->worst_hours=$module_worst_hours;
            $module->best_minutes=$module_best_minutes;
            $module->worst_minutes=$module_worst_minutes;
            $module->save();

            $project=Project::find($module->project_id);
            $project_modules=$project->modules()->get();
            $project_best_hours=0;
            $project_best_minutes=0;
            $project_worst_hours=0;
            $project_worst_minutes=0;
            foreach($project_modules as $mod){
                $project_best_hours+=$mod->best_hours;
                $project_best_minutes+=$mod->best_minutes;
                $project_worst_hours+=$mod->worst_hours;
                $project_worst_minutes+=$mod->worst_minutes;
            }
            while($project_best_minutes>59){
                $project_best_hours++;
                $project_best_minutes-=60;
            }
            while($project_worst_minutes>59){
                $project_worst_hours++;
                $project_worst_minutes-=60;
            }
            $project_hours=$project_best_hours+$project_worst_hours;
            $project_minutes=$project_best_minutes+$project_worst_minutes;
            $project_average_hours=$project_hours/2;
            $project_average_minutes=$project_minutes/2;

            $project->average_hours=$project_average_hours;
            $project->average_minutes=$project_average_minutes;
            $project->best_hours=$project_best_hours;
            $project->worst_hours=$project_worst_hours;
            $project->best_minutes=$project_best_minutes;
            $project->worst_minutes=$project_worst_minutes;

            $project->modules=$project->modules()->get();
            if($project->modules) {
                foreach ($project->modules as $module){
                    $module->tasks=$module->tasks()->get();
                }
            }
            return response()->json($project);
        }
}

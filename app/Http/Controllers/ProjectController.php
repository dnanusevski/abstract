<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Provider;
use App\Models\Template;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|unique:projects',
            'smtp1' => 'required_without_all:smtp2',
            'smtp2' => 'required_without_all:smtp1',
        ]);


        // Refactor -> begin transaction
        $project = new Project();
        $project->name = $request->input('name');
        $project->save();

        //Refactor -> move to separated function for clarity
        if ($request->has('smtp1')) {
            $smtp = new Provider();
            $smtp->provider = $request->input('smtp1');
            $project->providers()->save($smtp);
        }

        if ($request->has('smtp2')) {
            $smtp = new Provider();
            $smtp->provider = $request->input('smtp2');
            $project->providers()->save($smtp);
        }


        //Refactor -> move to separated function for clarity
        //Refactor -> check to see if one is default
        for ($x = 1; $x < 6; $x++) {
            $template = 'template_' . $x;
            if ($request->has($template)) {
                $tmp = new Template();
                $tmp->content = $request->input($template);
                if ($request->input('default_tamplate') === $template) {
                    $tmp->project_default = true;
                }
                $project->templates()->save($tmp);
            }
        }

        // Refactor -> Commit transaction
        return back()->with('status', 'Project created!');
    }

    public function sendEmail()
    {
        // Selecting the first project
        // I guess there should be like select project for which to send email or something
        $project = Project::first();

        if (!$project) {
            return back()->withErrors(['missing project']);
        }

        $drivers = $project->providers()->get()->map(function ($driver) {
            return $driver->provider;
        });

        $template = $project->templates()->where(['project_default' => 1])->first();
        $content = $template->pluck('content')->first();

        return view('project.send-email')->with([
            'driver' => $drivers->toArray(),
            "template" => $content,
            'params' => [
                "to" => "max-musterman@max.com",
                "webhook_url" => auth()->user()->webhook_url,
                "webhook_url_format_type" => auth()->user()->webhook_url_format_type,
            ]
        ]);
    }
}

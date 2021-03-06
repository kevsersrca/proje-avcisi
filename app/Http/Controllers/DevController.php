<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Point;
use App\Models\Project;
use App\Models\ProjectTool;
use App\Models\Tag;
use App\Models\Tool;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class DevController extends Controller
{
    public function index()
    {

        dd(Cache::store('redis')->get('categories'));
        dd(Project::search('sosyal ağ')->get());
            dd(ProjectTool::populars());
        $tools = Project::leftJoin('project_tools', 'project_tools.project_id', '=', 'projects.id')
            ->groupBy('project_tools.project_id')->get();
        dd($tools);
        dd(Project::search("laravel api *asd*ad*sa*ads*")->paginate(5));
        $user = User::find(1);
        dd($user->followers()->pluck('follower_id'));

//        $user = Project::find(1);
//        dd($user->points->sum('point'));
        dd(Storage::url("public/project_medias/24/fDGJrBP70QkyawM9yGTeZFD44BcxxOi4n0ddqgYX.jpeg"));
        $project = Project::find(18);
        dd($project->points->sum('point'));
        dd($project->tags);
        $tag = Tag::find(1);
        dd($tag->projects);

    }
}

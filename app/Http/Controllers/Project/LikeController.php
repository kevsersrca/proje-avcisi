<?php

namespace App\Http\Controllers\Project;

use App\Jobs\AddFeed;
use App\Jobs\AddNotification;
use App\Jobs\AddProjectPoint;
use App\Jobs\AddUserPoint;
use App\Models\Like;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LikeController extends Controller
{
    public function store($id)
    {
        $project = Project::findOrFail($id);
        /*
         * did you like it before
         */
        if (Like::where('user_id', auth()->user()->id)->where('project_id', $id)->exists()) {
            return redirect()->back()->with('error', 'Already liked!');
        }
        $like = new Like();
        $like->user_id = auth()->user()->id;
        $like->project_id = $project->id;

        if ($like->save()) {
            AddNotification::dispatch(auth()->user()->id, $project->user_id, 'Bir beğeni ateşledi!', $project->id);
            AddUserPoint::dispatch(auth()->user()->id, 'add_like_user', $id);
            AddProjectPoint::dispatch($id, 'add_like_project', auth()->user()->id);
            AddFeed::dispatch($id, auth()->user()->id, 'Projesini Beğendi.');
            return redirect()->back()->with('message', 'Successful');
        }
        return redirect()->back()->with('error', 'something went wrong!');
    }

    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        if (!Like::where('user_id', auth()->user()->id)->where('project_id', $id)->exists()) {
            return redirect()->back()->with('error', 'Do not like it anyway!');
        }
        $like = Like::where('project_id', $id)->where('user_id', auth()->user()->id)->delete();
        if ($like) {
            AddUserPoint::dispatch(auth()->user()->id, 'delete_like_user', $id);
            AddProjectPoint::dispatch($id, 'delete_like_project', auth()->user()->id);
            return redirect()->back()->with('message', 'Successful');
        }
        return redirect()->back()->with('error', 'something went wrong!');
    }
}

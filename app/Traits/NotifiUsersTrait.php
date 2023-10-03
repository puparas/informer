<?php

namespace App\Traits;

use App\Models\Post;
use App\Models\Role;
use App\Notifications\NewPostNotifi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

trait NotifiUsersTrait
{
    public function notifiUsers(Post $post)
    {
        $users = $post->project->users
            ->filter(fn ($user) => $user->id != Auth::user()->id)
            ->filter(fn ($user) => $user->roles->pluck('id')
                ->contains($post->role_id));
        if($users->count()) {
            $roleCurrentPost = Role::where('id' , '=' , $post->role_id )->first();
            Notification::send($users, new NewPostNotifi($post, $roleCurrentPost));
        }
    }
}

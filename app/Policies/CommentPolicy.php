<?php

namespace App\Policies;

// Models
use App\Models\User;
use App\Models\Comment;

// Laravel
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy {
    use HandlesAuthorization;

    public function edit(User $user, Comment $comment) {
        return $user->id === $comment->user_id;
    }

    public function delete(User $user, Comment $comment) {
        if ($user->moderator) return true;
        return $user->id === $comment->user_id;
    }
}

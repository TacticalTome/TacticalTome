<?php

namespace App\Policies;

// Models
use App\Models\User;
use App\Models\StrategyGuide;

// Laravel
use Illuminate\Auth\Access\HandlesAuthorization;

class StrategyGuidePolicy {
    use HandlesAuthorization;

    public function edit(User $user, StrategyGuide $strategyGuide) {
        return $user->id === $strategyGuide->user_id;
    }

    public function favorite(User $user, StrategyGuide $strategyGuide) {
        return $user->id !== $strategyGuide->user_id;
    }

    public function delete(User $user, StrategyGuide $strategyGuide) {
        if ($user->moderator) return true;
        return $user->id === $strategyGuide->user_id;
    }
}

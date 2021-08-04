<?php

namespace App\Models;

// Models
use App\Models\Game;
use App\Models\StrategyGuide;

// Laravel
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable implements MustVerifyEmail {
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /*
        Returns all the games the user is currently following
    */
    public function followedGames() {
        return $this->belongsToMany('App\Models\Game', 'follows', 'user_id', 'game_id');
    }

    /*
        Returns all strategy guides the user is current favoriting
    */
    public function favoriteStrategyGuides() {
        return $this->belongsTomany('App\Models\StrategyGuide', 'favorites', 'user_id', 'strategy_guide_id');
    }

    /*
        Returns if the user is following a game
    */
    public function isFollowingGame(Game $game) {
        return !! $this->followedGames()->where('game_id', $game->id)->count();
    }

    /*
        Returns if the user is favoritng a strategy guide
    */
    public function isFavoritingStrategyGuide(StrategyGuide $strategyGuide) {
        return Favorite::where('user_id', '=', $this->id)->where('strategy_guide_id', '=', $strategyGuide->id)->exists();
    }

    /*
        Returns all the user's strategy guides
    */
    public function strategyGuides() {
        return $this->hasMany('App\Models\StrategyGuide');
    }
}

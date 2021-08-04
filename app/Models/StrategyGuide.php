<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StrategyGuide extends Model {
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'game_id',
        'title',
        'content'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        
    ];

    /*
        Always load with user and game (because more than likely both will be used)
    */
    protected $with = ['game', 'user'];

    /*
        Returns the game this strategy guide corresponds to
    */
    public function game() {
        return $this->belongsTo('App\Models\Game', 'game_id');
    }

    /*
        Returns the user this strategy guide corresponds to
    */
    public function user() {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    /*
        Returns a preview of the contents
    */
    public function getPreview(): string {
        return substr(strip_tags($this->content), 0, 100) . "--";
    }

    /*
        Returns all the comments that are under this strategy guide
    */
    public function comments() {
        return $this->hasMany('App\Models\Comment');
    }
}

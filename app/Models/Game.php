<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model {
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'developer',
        'tags',
        'banner',
        'cover',
        'steamappid',
        'news'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'tags' => 'array',
        'cover' => 'array',
        'news' => 'boolean'
    ];

    /*
        Returns the game's follows
    */
    public function follows() {
        return $this->hasMany('App\Models\Follow');
    }

    /*
        Returns the game's strategy guides
    */
    public function strategyGuides() {
        return $this->hasMany('App\Models\StrategyGuide');
    }

    /*
        Returns the all time most popular strategy guides
    */


    /*
        Returns the most recent strategy guides
        Returns a maximum of 5
    */
    public function recentStrategyGuides() {
        return $this->hasMany('App\Models\StrategyGuide')->limit(5)->orderBy('created_at', 'DESC');
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model {
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'strategy_guide_id',
        'content'
    ];

    /*
        Always load with the user
    */
    protected $with = ['user'];

    /*
        Returns the user this comment corresponds to
    */
    public function user() {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}

<?php

namespace App\Http\Controllers;

// Models
use App\Models\StrategyGuide;
use App\Models\Game;
use App\Models\User;
use App\Models\Favorite;

// Laravel
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StrategyGuideController extends Controller {
    /*
        The strategy guide view page
    */
    public function view(StrategyGuide $strategyGuide) {
        // Display
        return view("strategyguide.view")->with("strategyGuide", $strategyGuide);
    }

    /*
        The strategy guide creation screen
    */
    public function create(Game $game) {
        // Display
        return view("strategyguide.create")->with("game", $game);
    }

    /*
        The strategy guide edit page
    */
    public function edit(StrategyGuide $strategyGuide) {
        // Authorize the user
        $this->authorize("edit", $strategyGuide);

        // Display
        return view("strategyguide.edit")->with("strategyGuide", $strategyGuide);
    }

    /*
        The strategy guide favorite page
    */
    public function favorite(StrategyGuide $strategyGuide) {
        // Authorize
        $this->authorize("favorite", $strategyGuide);

        // Create the favorite
        Favorite::firstOrCreate([
            "user_id" => Auth::user()->id,
            "strategy_guide_id" => $strategyGuide->id
        ]);

        // Display
        return view("strategyguide.favorite")->with("strategyGuide", $strategyGuide);
    }

    /*
        The strategy guide unfavorite page
    */
    public function unfavorite(StrategyGuide $strategyGuide) {
        // Authorize
        $this->authorize("favorite", $strategyGuide);

        // Delete the favorite
        Favorite::where([
            "user_id" => Auth::user()->id,
            "strategy_guide_id" => $strategyGuide->id
        ])->delete();

        // Display
        return view("strategyguide.unfavorite")->with("strategyGuide", $strategyGuide);
    }
}
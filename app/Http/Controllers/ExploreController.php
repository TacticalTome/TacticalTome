<?php

namespace App\Http\Controllers;

// Models
use App\Models\Game;
use App\Models\StrategyGuide;

// Laravel
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ExploreController extends Controller {
    /**
     * Displays generic games and strategy guides based on popularity. 
     * This method of exploration does not require the user to be logged in
     * 
     * @param int $offset
     * @return Illuminate\View\View
     */
    public function popular(int $offset = 0) {
        // Get ten random games
        $randomGames = Game::inRandomOrder()->skip($offset * 10)->limit(10)->get();
        
        // Get ten strategy guides from the last 24 hours
        // Also make sure the strategy guides are not written by the user themself
        $randomStrategyGuides = StrategyGuide::inRandomOrder()->where("created_at", ">=", Carbon::now()->subDays(1))
                                                              ->where("user_id", "!=", Auth::user()->id)
                                                              ->skip($offset * 10)
                                                              ->limit(10)
                                                              ->get();

        // Display
        return view("explore.index")->with([
            "games" => $randomGames,
            "strategyGuides" => $randomStrategyGuides,
            "offset" => $offset,
            "routeName" => "explore.popular.offset"
        ]);
    }

    /**
     * Displays generic games but along side strategy guides that are from games
     * the user is currently following
     * 
     * @param int $offset
     * @return Illuminate\View\View
     */
    public function recommended(int $offset = 0) {
        // Get ten random games
        $randomGames = Game::inRandomOrder()->skip($offset * 10)->limit(10)->get();

        // Get ten strategy guides from the last 24 hours from games the user is following
        // Also make sure the strategy guides are not written by the user themself
        $randomStrategyGuides = StrategyGuide::inRandomOrder()->where("created_at", ">=", Carbon::now()->subDays(1))
                                                              ->where("user_id", "!=", Auth::user()->id)
                                                              ->whereIn("game_id", Auth::user()->followedGames->pluck('id')->toArray())
                                                              ->skip($offset * 10)
                                                              ->limit(10)
                                                              ->get();

        // Display
        return view("explore.index")->with([
            "games" => $randomGames,
            "strategyGuides" => $randomStrategyGuides,
            "offset" => $offset,
            "routeName" => "explore.recommended.offset"
        ]);
    }
}

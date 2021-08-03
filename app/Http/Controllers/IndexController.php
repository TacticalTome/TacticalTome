<?php

namespace App\Http\Controllers;

// Models
use App\Models\StrategyGuide;
use App\Models\Game;
use App\Models\Follow;

// Laravel
use Illuminate\Http\Request;
use Carbon\Carbon;

class IndexController extends Controller {
    /*
        Main Page
    */
    public function index() {
        // Get the most followed games
        $topGames = Game::selectRaw("games.*, COUNT(follows.id) AS follows_count")
                        ->leftJoin("follows", "follows.game_id", "=", "games.id")
                        ->groupBy("games.id")
                        ->orderBy("follows_count", "DESC")
                        ->paginate(6); // Only get top 6

        $topStrategyGuides = StrategyGuide::selectRaw("strategy_guides.*, COUNT(favorites.id) AS favorites_count")
                                          ->where("strategy_guides.created_at", ">=", Carbon::now()->subDays(1))
                                          ->leftJoin("favorites", "favorites.strategy_guide_id", "=", "strategy_guides.id")
                                          ->groupBy("strategy_guides.id")
                                          ->orderBy("favorites_count", "DESC")
                                          ->paginate(5); // Only get top 5

        return view("index")->with([
            "topGames" => $topGames, 
            "topStrategyGuides" => $topStrategyGuides
        ]);
    }
}

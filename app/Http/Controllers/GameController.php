<?php

namespace App\Http\Controllers;

// Models
use App\Models\Game;
use App\Models\StrategyGuide;
use App\Models\Follow;

// Laravel
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class GameController extends Controller {
    /**
     * Displays information about a game
     * Also does API calls if the game is a steam game
     */
    public function view(Game $game) {
        // Define Variables
        $currentPlayerCount = 0;
        $news = Array();

        // If the game is a steam game or not
        if($game->steamappid != 0) {
            // Get data from the Steam API
            $currentPlayerCount = Http::get("https://api.steampowered.com/ISteamUserStats/GetNumberOfCurrentPlayers/v1/?appid=" . $game->steamappid)["response"]["player_count"];
            $steamNews = Http::Get("https://api.steampowered.com/ISteamNews/GetNewsForApp/v2/?appid=" . $game->steamappid)["appnews"]["newsitems"];
        }

        // Get the game's all time most popular strategy guides
        $topStrategyGuides = StrategyGuide::selectRaw("strategy_guides.*, COUNT(favorites.id) AS favorites_count")
                                          ->where("strategy_guides.game_id", "=", $game->id)
                                          ->leftJoin("favorites", "favorites.strategy_guide_id", "=", "strategy_guides.id")
                                          ->groupBy("strategy_guides.id")
                                          ->orderBy("favorites_count", "DESC")
                                          ->paginate(5); // Only get top 5

        // Display
        return view("game.view")->with([
            "game" => $game,
            "topStrategyGuides" => $topStrategyGuides,
            "currentPlayerCount" => $currentPlayerCount,
            "steamNews" => $steamNews
        ]);
    }

    /*
        The user desires to follow a game
    */
    public function follow(Game $game) {
        // Create the follow if it does not already exist
        Follow::firstOrCreate([
            "user_id" => Auth::user()->id,
            "game_id" => $game->id
        ]);

        // Display
        return view("game.follow")->with("game", $game);
    }

    /*
        The user desires to unfollow a game
    */
    public function unfollow(Game $game) {
        // Delete the follow
        Follow::where([
            "user_id" => Auth::user()->id,
            "game_id" => $game->id
        ])->delete();

        // Display
        return view("game.unfollow")->with("game", $game);
    }
}

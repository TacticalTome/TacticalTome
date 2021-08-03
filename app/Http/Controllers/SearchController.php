<?php

namespace App\Http\Controllers;

// Models
use App\Models\Game;
use App\Models\StrategyGuide;

// Laravel
use Illuminate\Http\Request;

class SearchController extends Controller {
    /**
     * The main search functionality of the site
     * 
     * @param string $searchQuery
     */
    public function index(string $searchQuery) {
        // Remove all speical characters from the search query
        $searchQuery = preg_replace("/[^A-Za-z0-9 ]/", '', $searchQuery);

        // Get the related games to the search query
        $relatedGames = Game::where("name", "LIKE", "%" . $searchQuery. "%")
                            ->where("description", "LIKE", "%" . $searchQuery . "%")
                            ->get();

        // Get the related strategy guides to the search query
        $relatedStrategyGuides = StrategyGuide::where("title", "LIKE", "%" . $searchQuery . "%")
                                              ->orWhere("content", "LIKE", "%" . $searchQuery . "%")
                                              ->get();

        // Get the amount of results found
        $resultsFound = count($relatedGames) + count($relatedStrategyGuides);

        // Display
        return view("search")->with([
            "searchQuery" => $searchQuery,
            "resultsFound" => $resultsFound,
            "relatedGames" => $relatedGames,
            "relatedStrategyGuides" => $relatedStrategyGuides
        ]);
    }
}

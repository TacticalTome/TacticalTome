<?php

namespace App\Http\Controllers;

// Models
use App\Models\Game;

// Rules
use App\Rules\SteamStoreLink;

// Laravel
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SteamGameController extends Controller {
    /*
        Displays the form for submiting a steam game to the server
    */
    public function index() {
        return view("submitsteamgame");
    }

    /*
        When the steam game form is submitted
    */
    public function store(Request $request) {
        // Process form data
        $this->validate($request, [
            "g-recaptcha-response" => ["required", "captcha"],
            "steamLink" => ["required", "url", new SteamStoreLink]
        ]);

        // Get the steam app id from the provided URL
        $appId = explode("/", str_replace("https://store.steampowered.com/app/", "", $request->get("steamLink")))[0];

        // Send an API call to the Steam API
        $response = Http::get("https://store.steampowered.com/api/appdetails/?appids=$appId");

        // Decode Result
        $steamGame = json_decode($response->body());

        // If the API call was a success
        if (!is_null($steamGame) && $steamGame->$appId->success) {

            // Grab all the game tags
            $tags = Array();
            foreach ($steamGame->$appId->data->genres as $genre) {
                array_push($tags, $genre->description);
            }

            // Grab all the cover paths
            $covers = Array();
            $currentIndex = 0;
            foreach ($steamGame->$appId->data->screenshots as $screenshot) {
                array_push($covers, $screenshot->path_full);
                if (++$currentIndex == 5) break;
            }

            // Store the game information (if it already exists then just grab it)
            $newGame = Game::firstOrCreate(
                [
                    "name" => $steamGame->$appId->data->name
                ],
                [
                    "description" => $steamGame->$appId->data->short_description,
                    "developer" => $steamGame->$appId->data->developers[0],
                    "tags" => $tags,
                    "banner" => $steamGame->$appId->data->header_image,
                    "cover" => $covers,
                    "steamappid" => $appId,
                    "news" => true
                ]
            );

            // Redirect to the new game page
            return redirect(route("game.view", $newGame->id));

        } else {

            // The API call was not a success
            $error = ValidationException::withMessages([
                "gamenotfound" => ["The steam game URL you have provided did not work"]
            ]);
            throw $error;

        }
    }
}

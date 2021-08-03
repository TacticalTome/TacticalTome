<?php

namespace App\Http\Controllers;

// Models
use App\Models\StrategyGuide;
use App\Models\Comment;

// Laravel
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller {
    /*
        AJAX Call that requests a post to be posted
    */
    public function createStrategyGuide(Request $request) {
        // Validate
        $validator = Validator::Make($request->all(), [
            "game_id" => ["required", "integer", "exists:games,id"],
            "title" => ["required", "string", "not_in:Post Title"],
            "content" => ["required", "string", "not_in:Post Content"]
        ]);

        // Check to see if the validator failed or not
        if ($validator->fails()) {
            // Send an error if it did
            return response()->json([
                "success" => false,
                "errors" => $validator->errors()->all()
            ], 400);
        }

        // Create a strategy guide 
        $newStrategyGuide = StrategyGuide::Create([
            "user_id" => Auth::user()->id,
            "game_id" => $request->get("game_id"),
            "title" => $request->get("title"),
            "content" => $request->get("content")
        ]);

        // Return response with strategy guide id
        return response()->json([
            "success" => true,
            "strategyguide_url" => route("strategyguide.view", $newStrategyGuide->id)
        ], 200);
    }

    /*
        AJAX call that requests a strategy guide to be edited
    */
    public function editStrategyGuide(Request $request) {
        // Validate
        $validator = Validator::Make($request->all(), [
            "strategy_guide_id" => ["required", "integer", "exists:strategy_guides,id"],
            "title" => ["required", "string", "not_in:Post Title"],
            "content" => ["required", "string", "not_in:Post Content"]
        ]);

        // Check to see if the validator failed or not
        if ($validator->fails()) {
            // Send an error if it did
            return response()->json([
                "success" => false,
                "errors" => $validator->errors()->all()
            ], 400);
        }

        // Find the strategy guide
        $strategyGuide = StrategyGuide::find($request->get("strategy_guide_id"));

        // Authorize the user can edit it
        $this->authorize("edit", $strategyGuide);

        // Update the strategy guide
        $strategyGuide->update($request->all());

        // Return response with success
        return response()->json(["success" => true], 200);
    }

    /*
        AJAX call that requests a strategy guide to be deleted
    */
    public function deleteStrategyGuide(Request $request) {
        // Get the Strategy Guide and delete it
        $strategyGuide = StrategyGuide::find($request->get("strategy_guide_id"));

        // Authorize the user can delete it
        $this->authorize("delete", $strategyGuide);

        // Delete the strategy guide
        $strategyGuide->delete();

        // Return response
        return response()->json(["success" => true], 200);
    } 

    /*
        AJAX call that request to post a comment to a strategy guide
    */
    public function createComment(Request $request) {
        // Validate
        $validator = Validator::Make($request->all(), [
            "strategy_guide_id" => ["required", "integer", "exists:strategy_guides,id"],
            "reply_id" => ["nullable"],
            "content" => ["required", "string", "min:6"]
        ]);

        // Check to see if the validator failed or not
        if ($validator->fails()) {
            // Send an error if it did
            return response()->json([
                "success" => false,
                "errors" => $validator->errors()->all()
            ], 400);
        }

        // Create the comment
        Comment::Create([
            "user_id" => Auth::user()->id,
            "strategy_guide_id" => $request->get("strategy_guide_id"),
            "content" => $request->get("content")
        ]);

        // Return response
        return response()->json(["success" => true], 200);
    }

    /*
        AJAX call that request to delete a comment to a strategy guide
    */
    public function deleteComment(Request $request) {
        // Get the Strategy Guide and delete it
        $comment = Comment::find($request->get("reply_id"));

        // Authorize the user can delete it
        $this->authorize("delete", $comment);

        // Delete the strategy guide
        $comment->delete();

        // Return response
        return response()->json(["success" => true], 200);
    }
}

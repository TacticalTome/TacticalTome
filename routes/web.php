<?php

// Laravel
use Illuminate\Support\Facades\Route;

// Auth Controllers
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\VerificationController;

// Controllers
use App\Http\Controllers\IndexController;
use App\Http\Controllers\SteamGameController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StrategyGuideController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\ExploreController;
use App\Http\Controllers\SearchController;

/**
 * Other Routes
 */
Route::get("/", [IndexController::class, "index"])->name("index");
Route::get("/search/{searchQuery}", [SearchController::class, "index"])->name("search.index");

/**
 * Auth Routes (Authentication)
 */
Route::name("auth.")->group(function() {
    /**
     * Pages that require the user to not be logged in
     */
    Route::middleware(["guest"])->group(function() {
        Route::get("/register", [RegisterController::class, "index"])->name("register"); // auth.register
        Route::post("/register", [RegisterController::class, "store"]);
        Route::get("/login", [LoginController::class, "index"])->name("login"); // auth.login
        Route::post("/login", [LoginController::class, "store"]);
    });

    /**
     * Pages thare require the user to be logged in
     */
    Route::middleware(["auth"])->group(function() {
        Route::post("/logout", [LogoutController::class, "store"])->name("logout"); // auth.logout
    });
});

/**
 * Verification Routes
 * (Pages that require the user to be logged in)
 */
Route::name("verification.")->middleware("auth")->group(function() {
    Route::get("/notice/email-verify/", [VerificationController::class, "emailNotice"])->name("notice"); // verification.notice
    Route::get("/email/verify/{id}/{hash}", [VerificationController::class, "verifyEmail"])->middleware("signed")->name("verify"); // verification.verify
});

/**
 * Game Routes
 */
Route::name("game.")->group(function() {
    Route::get("/game/{game}", [GameController::class, "view"])->name("view"); // game.view

    /**
     * Pages that require the user to be logged in
     */
    Route::middleware(["auth"])->group(function() {
        Route::get("/game/follow/{game}", [GameController::class, "follow"])->name("follow"); // game.follow
        Route::get("/game/unfollow/{game}", [GameController::class, "unfollow"])->name("unfollow"); // game.unfollow
    });
});

/**
 * Strategy Guide Routes
 */
Route::name("strategyguide.")->group(function() {
    Route::get("/strategy-guide/{strategyGuide}", [StrategyGuideController::class, "view"])->name("view"); // strategyguide.view

    /**
     * Pages that require the user to be logged in
     */
    Route::middleware(["auth"])->group(function() {
        /**
         * Pages that require the user to have a verified email
         */
        Route::middleware(["verified"])->group(function() {
            Route::get("/strategy-guide/create/{game}", [StrategyGuideController::class, "create"])->name("create"); // strategyguide.create
            Route::get("/strategy-guide/edit/{strategyGuide}", [StrategyGuideController::class, "edit"])->name("edit"); // strategyguide.edit
        });
        Route::get("/strategy-guide/favorite/{strategyGuide}", [StrategyGuideController::class, "favorite"])->name("favorite"); // strategyguide.favorite
        Route::get("/strategy-guide/unfavorite/{strategyGuide}", [StrategyGuideController::class, "unfavorite"])->name("unfavorite"); // strategyguide.unfavorite
    });
});

/**
 * User Routes
 */
Route::name("user.")->group(function() {
    Route::get("/profile/{user}", [UserController::class, "profile"])->name("profile"); // user.profile
    Route::get("/account", [UserController::class, "account"])->name("account"); // user.account
    Route::post("/account", [UserController::class, "update"]);
});

/**
 * Steam Routes
 */
Route::name("steam.")->middleware("auth", "verified")->group(function() {
    Route::get("/steam/submit-game", [SteamGameController::class, "index"])->name("submitgame"); // steam.submitgame
    Route::post("/steam/submit-game", [SteamGameController::class, "store"]);
});

/**
 * Explore Routes
 */
Route::name("explore.")->group(function() {
    Route::get("/explore/popular/{offset?}", [ExploreController::class, "popular"])->name("popular"); // explore.popular

    /**
     * Pages that require the user to be logged in
     */
    Route::middleware(["auth"])->group(function() {
        Route::get("/explore/recommended/{offset?}", [ExploreController::class, "recommended"])->name("recommended"); // explore.recommended
    });
});

/**
 * AJAX Routes
 * (Pages that require the user to be logged in)
 */
Route::prefix("ajax")->middleware("auth", "verified")->group(function() {
    /**
     * Strategy Guide Routes (AJAX)
     */
    Route::name("ajax.strategyguide.")->group(function() {
        Route::post("/strategy-guide/create", [AjaxController::class, "createStrategyGuide"])->name("create"); // ajax.strategyguide.create
        Route::post("/strategy-guide/edit", [AjaxController::class, "editStrategyGuide"])->name("edit"); // ajax.strategyguide.edit
        Route::post("/strategy-guide/delete", [AjaxController::class, "deleteStrategyGuide"])->name("delete"); // ajax.strategyguide.delete
    });

    /**
     * Comment Routes (AJAX)
     */
    Route::name("ajax.comment.")->group(function() {
        Route::post("/comment/create", [AjaxController::class, "createComment"])->name("create"); // ajax.comment.create
        Route::post("/comment/delete", [AjaxController::class, "deleteComment"])->name("delete"); // ajax.comment.delete
    });
});

/**
 * Legal Routes
 */
Route::name("legal.")->prefix("legal")->group(function() {
    Route::get("/terms-of-service", function() { return view("legal.termsofservice"); })->name("termsofservice"); // legal.termsofservice
    Route::get("/privacy-policy", function() { return view("legal.privacypolicy"); })->name("privacypolicy"); // legal.privacypolicy
    Route::get("/posting-guidelines", function() { return view("legal.postingguidelines"); })->name("postingguidelines"); // legal.postingguidelines
});

/**
 * About Routes
 */
Route::name("about.")->prefix("about")->group(function() {
    Route::get("/", function() { return view("about.index"); })->name("index"); // about.index
    Route::get("/frequently-asked-questions", function() { return view("about.faq"); })->name("faq"); // about.faq
    Route::get("/contact", function() { return view("about.contact"); })->name("contact"); // about.contact
});
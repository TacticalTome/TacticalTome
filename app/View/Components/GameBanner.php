<?php

namespace App\View\Components;

// Models
use App\Models\Game;

// Laravel
use Illuminate\View\Component;

class GameBanner extends Component {
    /**
     * The game this banner repersents
     * 
     * @var Game
     */
    public Game $game;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Game $game) {
        $this->game = $game;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render() {
        return view('components.game-banner');
    }
}

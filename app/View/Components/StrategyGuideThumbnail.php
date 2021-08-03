<?php

namespace App\View\Components;

// Models
use App\Models\StrategyGuide;

// Laravel
use Illuminate\View\Component;

class StrategyGuideThumbnail extends Component {
    /**
     * The strategy guide this thumbnail represents
     * 
     * @var StrategyGuide
     */
    public StrategyGuide $strategyGuide;

    /**
     * Whether to show the author in the thumbnail or not
     * 
     * @var bool
     */
    public bool $showAuthor;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(StrategyGuide $strategyGuide, bool $showAuthor = false) {
        $this->strategyGuide = $strategyGuide;
        $this->showAuthor = $showAuthor;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render() {
        return view('components.strategy-guide-thumbnail');
    }
}

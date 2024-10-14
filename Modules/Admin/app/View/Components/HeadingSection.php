<?php

namespace Modules\Admin\App\View\Components;

use Illuminate\Contracts\Support\Htmlable;
use Illuminate\View\Component;
use Modules\Admin\Helpers\Concerns\HasQuickAction;

class HeadingSection extends Component
{
    use HasQuickAction;
    public array $breadcrumbs = [];
    public string $heading;

    public bool $headerAction = false;
    public bool|array $canQuickAction;

    public ?string $quicAction = null;


    public function __construct(
        array $breadcrumbs,
        string $heading,
        bool $headerAction,
        $metodQuickAction
    ) {
        $this->breadcrumbs = $breadcrumbs;
        $this->heading = $heading;
        $this->headerAction = $headerAction;

        $this->quicAction = $metodQuickAction;
        $ref = $metodQuickAction;
        $this->canQuickAction = $ref ? true : false;
    }

    public function render()
    {
        return view('admin::components.heading-section', [
            'breadcrumbs' => $this->breadcrumbs,
            'heading' => $this->heading,
            'quickAction' => $this->quicAction,
            'canQuickAction' => $this->canQuickAction
        ]);
    }
}

<?php

namespace Modules\Frontend\App\Livewire\Components;

use App\Models\Product;
use Livewire\Component;

class GlobalSearch extends Component
{
    public string $querySearch = '';
    public $results;

    public function updatedQuerySearch()
    {
        if (empty($this->querySearch)) return;
        $this->results = Product::search($this->querySearch)->get();
    }
    public function render()
    {
        return view('frontend::components.global-search');
    }
}

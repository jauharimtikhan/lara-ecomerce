<?php

namespace Modules\Admin\Components;

use App\Models\CuratorMedia;
use Illuminate\View\Component;

class MediaPicker extends Component
{
    protected function getData()
    {
        try {
            $medias = CuratorMedia::paginate(10);
        } catch (\Exception $th) {
            return [
                'error' => $th->getMessage(),
            ];
        }
        return $medias;
    }

    protected function shouldIgnore($name)
    {
        return false;
    }
    public function render()
    {

        return view('admin::components.media-picker', [
            'medias' => $this->getData()
        ]);
    }
}

<?php

namespace ConfrariaWeb\PhotoSale\Components\Components;

use Illuminate\View\Component;

class TemplateLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('photoSale::layouts.template');
    }
}

<?php

namespace ConfrariaWeb\PhotoSale\Components\Buttons;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class Socialite extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        $data['buttons'] = $this->socialitesButtons();
        return view('photoSale::components.buttons.socialite', $data);
    }

    public function socialitesButtons()
    {
        $data = [];
        $socialitesLists = ['Upload', 'Facebook', 'Instagram'];
        foreach ($socialitesLists as $socList) {
            $driver = Str::slug($socList);
            $data[$driver] = [
                "id" => NULL,
                'title' => $socList,
                'url' => route('socialite.redirect', ['driver' => $driver]),
                "data-toggle" => "",
                "data-target" => ""
            ];
        }
        $socialitesDrivers = Auth::user()->socialites()->get();
        if ($socialitesDrivers->isNotEmpty()) {
            foreach ($socialitesDrivers as $socListDriver) {
                $driver = Str::slug($socListDriver->driver);
                $data[$driver]['id'] = $socListDriver->id;
                $data[$driver]['url'] = route('photos.socialite.update', ['driver' => $driver]);
            }
        }
        return $data;
    }
}

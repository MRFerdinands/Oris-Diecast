<?php

namespace App\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;

#[Layout('components.layouts.app')]
#[Title('Oris Diecast')]
class Home extends Component
{
    public $aboutus = [
        'contact_person' => '',
        'phone_number' => '',
        'email' => '',
        'description' => '',
    ];

    public $events;

    public function mount()
    {
        $about = \App\Models\AboutUs::get();
        $this->aboutus = $about;

        $today = Carbon::today();

        $this->events = \App\Models\Exhibition::where(function ($query) use ($today) {
            $query->where('tgl_mulai_event', '>=', $today->copy()->subDay())
                  ->where('tgl_mulai_event', '<=', $today->copy()->addDay());
        })->orWhere(function ($query) use ($today) {
            $query->where('tgl_selesai_event', '>=', $today->copy()->subDay())
                  ->where('tgl_selesai_event', '<=', $today->copy()->addDay());
        })->orWhere(function ($query) use ($today) {
            $query->where('tgl_mulai_event', '<=', $today)
                  ->where('tgl_selesai_event', '>=', $today);
        })->first();
    }

    #[Computed()]
    public function storelocations()
    {
        return \App\Models\StoreLocation::all();
    }

    #[Computed()]
    public function brands()
    {
        return \App\Models\Brands::all();
    }

    #[Computed()]
    public function links()
    {
        return \App\Models\OtherLinks::all();
    }

    public function render()
    {
        return view('livewire.home');
    }
}
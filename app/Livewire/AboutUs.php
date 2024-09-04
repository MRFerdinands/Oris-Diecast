<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.dashboard')]
#[Title('Dashboard - About Us')]
class AboutUs extends Component
{
    #[Rule('required|max:255')]
    public $contact_person;
    #[Rule('required|max:12')]
    public $phone_number;
    #[Rule('required|email|max:255')]
    public $email;
    #[Rule('required')]
    public $description;

    public function mount()
    {
        $data = \App\Models\AboutUs::get();
        $this->contact_person = $data[0]->contact_person;
        $this->phone_number = $data[0]->phone_number;
        $this->email = $data[0]->email;
        $this->description = $data[0]->description;
    }

    public function submit() {
        $this->validate();

        $data = \App\Models\AboutUs::get();
        $data[0]->update(
            [
                'contact_person' => $this->contact_person,
                'phone_number' => $this->phone_number,
                'email' => $this->email,
                'description' => $this->description
            ]
        );

        if ($data) {
            $this->dispatch('alert', data: [
                'type' => 'success',
                'message' => 'Data telah diupdate!',
            ]);
        }
    }

    public function render()
    {
        return view('livewire.about-us');
    }
}
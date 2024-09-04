<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.app')]
class Login extends Component
{
    #[Rule('required')]
    public $name;
    #[Rule('required|min:8')]
    public $password;

    public function mount()
    {
        if (auth()->check()) {
            return redirect()->route('jneawbcenter');
        }
    }

    public function login()
    {
        $credentials = $this->validate([
            'name' => 'required',
            'password' => 'required|min:8',
        ]);

        if (auth()->attempt($credentials)) {
            return redirect()->route('jneawbcenter');
        } else {
            $this->addError('error', trans('auth.failed'));
        }
    }

    public function render()
    {
        return view('livewire.login');
    }
}
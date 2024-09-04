<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Rule;
use Livewire\WithFileUploads;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\Storage;

#[Layout('components.layouts.dashboard')]
#[Title('Oris Diecast - Other Links')]
class OtherLinks extends Component
{
    use WithFileUploads;

    #[Rule('required|max:255')]
    public $nama_link;
    #[Rule('required|max:255')]
    public $alamat_link;
    #[Rule('required')]
    public $gambar_link;

    #[Computed()]
    public function links()
    {
        return \App\Models\OtherLinks::all();
    }

    public function submit()
    {
        $this->validate();
        $photoName = uniqid() . '.' . $this->gambar_link->getClientOriginalExtension();
        $data = \App\Models\OtherLinks::create([
            'nama_link' => $this->nama_link,
            'alamat_link' => $this->alamat_link,
            'gambar_link' => $photoName,
        ]);
        if ($data) {
            $this->gambar_link->storeAs('img/links/', $photoName, 'public');
            $this->dispatch('alert', data:[
                'type' => 'success',
                'message' => 'Data telah ditambahkan!',
            ]);
            $this->reset(['nama_link', 'alamat_link', 'gambar_link']);
        }
    }

    public function delete($id)
    {
        $data = \App\Models\OtherLinks::find($id);
        if ($data) {
            Storage::disk('public')->delete('img/links/' . $data->gambar_link);
            $data->delete();
            $this->dispatch('alert', data:[
                'type' => 'success',
                'message' => 'Data telah dihapus!',
            ]);
        }
    }

    public function clearLogo()
    {
        $this->reset(['gambar_link']);
    }

    public function render()
    {
        return view('livewire.other-links');
    }
}
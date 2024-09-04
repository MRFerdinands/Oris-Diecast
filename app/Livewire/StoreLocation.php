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
#[Title('Store Location')]
class StoreLocation extends Component
{
    use WithFileUploads;

    public $gambar_name = [];
    #[Rule('required')]
    public $gambar = [];
    #[Rule('required|max:255')]
    public $nama_toko;
    #[Rule('required')]
    public $alamat_toko;
    #[Rule('required|max:255')]
    public $contact_person;
    #[Rule('required|max:12')]
    public $phone_number;

    #[Computed()]
    public function locations()
    {
        return \App\Models\StoreLocation::all();
    }

    public function submit()
    {
        $this->validate();
        $data = new \App\Models\StoreLocation();
        $data->nama_toko = $this->nama_toko;
        $data->alamat_toko = $this->alamat_toko;
        $data->contact_person = $this->contact_person;
        $data->phone_number = $this->phone_number;
        $photoNames = [];

        foreach ($this->gambar as $index => $photo)
        {
            $photoName = uniqid() . '.' . $photo->getClientOriginalExtension();
            $photo->storeAs('img/store/', $photoName, 'public');
            $photoNames[] = $photoName;
        }

        $data->gambar_toko_1 = $photoNames[0] ?? null;
        $data->gambar_toko_2 = $photoNames[1] ?? null;
        $data->gambar_toko_3 = $photoNames[2] ?? null;
        $data->gambar_toko_4 = $photoNames[3] ?? null;

        if ($data->save())
        {
            $this->dispatch('alert', data: [
                'type' => 'success',
                'message' => 'Data telah ditambahkan!'
            ]);
            $this->reset(['gambar', 'nama_toko', 'alamat_toko', 'contact_person', 'phone_number']);
        }
    }

    public function delete($id)
    {
        $data = \App\Models\StoreLocation::find($id);
        if ($data)
        {
            Storage::disk('public')->delete('img/store/' . $data->gambar_toko_1);
            Storage::disk('public')->delete('img/store/' . $data->gambar_toko_2);
            Storage::disk('public')->delete('img/store/' . $data->gambar_toko_3);
            Storage::disk('public')->delete('img/store/' . $data->gambar_toko_4);
            $data->delete();
            $this->dispatch('alert', data: [
                'type' => 'success',
                'message' => 'Data telah dihapus!'
            ]);
        }
    }

    public function render()
    {
        return view('livewire.store-location');
    }
}
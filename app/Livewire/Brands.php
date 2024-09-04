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
#[Title('Oris Diecast - Brands')]
class Brands extends Component
{
    use WithFileUploads;

    #[Rule('required')]
    public $logo;
    #[Rule('required')]
    public $gambar = [];
    #[Rule('required|max:10')]
    public $kode_brand;
    #[Rule('required|max:255')]
    public $nama_brand;

    #[Computed()]
    public function brands()
    {
        return \App\Models\Brands::all();
    }

    public function clearLogo()
    {
        $this->logo = null;
    }

    public function submit()
    {
        $this->validate();
        $data = new \App\Models\Brands();
        $data->kode_brand = $this->kode_brand;
        $data->nama_brand = $this->nama_brand;
        $photoNames = [];

        if ($this->logo)
        {
            $logoName = uniqid() . '.' . $this->logo->getClientOriginalExtension();
            $data->logo_brand = $logoName;
            $this->logo->storeAs('img/brands/logo/', $logoName, 'public');
        }

        foreach ($this->gambar as $index => $photo)
        {
            $photoName = uniqid() . '.' . $photo->getClientOriginalExtension();
            $photo->storeAs('img/brands/product/', $photoName, 'public');
            $photoNames[] = $photoName;
        }

        $data->gambar_produk_1 = $photoNames[0] ?? null;
        $data->gambar_produk_2 = $photoNames[1] ?? null;
        $data->gambar_produk_3 = $photoNames[2] ?? null;
        $data->gambar_produk_4 = $photoNames[3] ?? null;

        if ($data->save())
        {
            $this->dispatch('alert', data: [
                'type' => 'success',
                'message' => 'Data telah ditambahkan!'
            ]);
            $this->reset(['gambar', 'kode_brand', 'nama_brand', 'logo']);
        }
    }

    public function delete($kode_brand)
    {
        $data = \App\Models\Brands::find($kode_brand);
        if ($data)
        {
            Storage::disk('public')->delete('img/brands/logo/' . $data->logo_brand);
            Storage::disk('public')->delete('img/brands/product/' . $data->gambar_produk_1);
            Storage::disk('public')->delete('img/brands/product/' . $data->gambar_produk_2);
            Storage::disk('public')->delete('img/brands/product/' . $data->gambar_produk_3);
            Storage::disk('public')->delete('img/brands/product/' . $data->gambar_produk_4);
            $data->delete();
            $this->dispatch('alert', data: [
                'type' => 'success',
                'message' => 'Data telah dihapus!'
            ]);
        }
    }

    public function render()
    {
        return view('livewire.brands');
    }
}
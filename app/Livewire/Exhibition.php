<?php

namespace App\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use Livewire\Attributes\Rule;
use Livewire\WithFileUploads;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\Storage;

#[Layout('components.layouts.dashboard')]
#[Title('Oris Diecast - Exhibition')]
class Exhibition extends Component
{
    use WithFileUploads;

    #[Rule('required|max:255')]
    public $nama_event;
    #[Rule('required')]
    public $tanggal;
    #[Rule('required')]
    public $alamat_event;
    #[Rule('required')]
    public $lokasi_booth;
    #[Rule('required')]
    public $nama_eo;
    #[Rule('required')]
    public $banner = [];

    #[Computed()]
    public function events()
    {
        return \App\Models\Exhibition::all();
    }

    public function submit()
    {
        $this->validate();

        list($startDate, $endDate) = explode(' - ', $this->tanggal);

        $data = new \App\Models\Exhibition();
        $data->nama_event = $this->nama_event;
        $data->tgl_mulai_event = Carbon::parse($startDate);
        $data->tgl_selesai_event = Carbon::parse($endDate);
        $data->alamat_event = $this->alamat_event;
        $data->lokasi_booth = $this->lokasi_booth;
        $data->nama_eo = $this->nama_eo;
        $photoNames = [];

        foreach ($this->banner as $index => $photo)
        {
            $photoName = uniqid() . '.' . $photo->getClientOriginalExtension();
            $photo->storeAs('img/event/', $photoName, 'public');
            $photoNames[] = $photoName;
        }

        $data->gambar_banner_1 = $photoNames[0] ?? null;
        $data->gambar_banner_2 = $photoNames[1] ?? null;

        if ($data->save())
        {
            $this->dispatch('alert', data: [
                'type' => 'success',
                'message' => 'Data telah ditambahkan!'
            ]);
            $this->reset(['banner', 'nama_event', 'tanggal', 'alamat_event', 'lokasi_booth', 'nama_eo']);
        }
    }

    public function delete($id)
    {
        $data = \App\Models\Exhibition::find($id);
        if ($data)
        {
            Storage::disk('public')->delete('img/event/' . $data->gambar_banner_1);
            Storage::disk('public')->delete('img/event/' . $data->gambar_banner_2);
            $data->delete();
            $this->dispatch('alert', data: [
                'type' => 'success',
                'message' => 'Data telah dihapus!'
            ]);
        }
    }

    public function render()
    {
        return view('livewire.exhibition');
    }
}
<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;

#[Layout('components.layouts.dashboard')]
#[Title('Buat Pembayaran')]
class CreatePayment extends Component
{
    #[Rule('required|max:10')]
    public $kode_bayar;
    #[Rule('required|string|max:50')]
    public $nama_bayar;
    #[Rule('required|numeric:5,0')]
    public $potongan;

    #[Computed()]
    public function payments()
    {
        return \App\Models\MetodePembayaran::all();
    }

    public function submit()
    {
        $this->validate();

        $data = \App\Models\MetodePembayaran::create([
            'kode_bayar' => $this->kode_bayar,
            'nama_bayar' => $this->nama_bayar,
            'potongan' => $this->potongan,
        ]);

        if ($data) {
            $this->reset(['kode_bayar', 'nama_bayar', 'potongan']);
            $this->dispatch('alert', data: ['type' => 'success', 'message' => 'Data Berhasil disimpan!']);
        }
    }

    public function delete($id)
    {
        $data = \App\Models\MetodePembayaran::find($id);
        $penjualan = \App\Models\Penjualan::where('kode_bayar', $id)->count();
        if ($data) {
            if ($penjualan > 0) {
                $this->dispatch('alert', data: ['type' => 'error', 'message' => 'Pembayaran ini sedang digunakan!']);
                return false;
            }
            $data->delete();
            $this->dispatch('alert', data: ['type' => 'success', 'message' => 'Data Berhasil dihapus!']);
        }
    }


    public function render()
    {
        return view('livewire.create-payment');
    }
}
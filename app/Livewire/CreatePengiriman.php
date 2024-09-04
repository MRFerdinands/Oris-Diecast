<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Penerima;
use App\Models\Pengirim;
use App\Models\Pengiriman;
use Livewire\Attributes\Rule;
use App\Livewire\JNEAwbCenter;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;

#[Layout('components.layouts.dashboard')]
#[Title('Buat Pengiriman')]
class CreatePengiriman extends Component
{
    #[Rule('required|max:40')]
    public $nama_pengirim;
    #[Rule('required')]
    #[Rule('regex:/^(?:(?:\+|62|0)(?:\d{2,3})?\d{7,8})$/')]
    #[Rule('min:9')]
    #[Rule('max:14')]
    public $telp_pengirim;
    public $telp_pengirim_enable = true;
    #[Rule('required|max:40')]
    public $nama_penerima;
    #[Rule('required')]
    #[Rule('regex:/^(?:(?:\+|62|0)(?:\d{2,3})?\d{7,8})$/')]
    #[Rule('min:9')]
    #[Rule('max:14')]
    public $telp_penerima;
    public $telp_penerima_enable = true;
    #[Rule('required')]
    public $alamat_penerima_1;
    public $alamat_penerima_1_enable = true;
    #[Rule('required')]
    public $alamat_penerima_2;
    public $alamat_penerima_2_enable = true;
    #[Rule('required')]
    public $alamat_penerima_3;
    public $alamat_penerima_3_enable = true;
    #[Rule('required')]
    public $alamat_penerima_4;
    public $alamat_penerima_4_enable = true;
    #[Rule('required|digits_between:0,7')]
    public $kode_pos_penerima;
    public $kode_pos_penerima_enable = true;
    #[Rule('sometimes')]
    public $catatan;
    #[Rule('sometimes')]
    public $simpandb = false;

    public function mount()
    {
        $nama_pengirim = '';
        $telp_pengirim = '';
        $telp_pengirim_enable = true;
        $nama_penerima = '';
        $telp_penerima = '';
        $telp_penerima_enable = true;
        $alamat_penerima_1 = '';
        $alamat_penerima_1_enable = true;
        $alamat_penerima_2 = '';
        $alamat_penerima_2_enable = true;
        $alamat_penerima_3 = '';
        $alamat_penerima_3_enable = true;
        $alamat_penerima_4 = '';
        $alamat_penerima_4_enable = true;
        $kode_pos_penerima = '';
        $kode_pos_penerima_enable = true;
        $catatan = '';
        $simpandb = false;
    }

    public function submit()
    {
        $this->validate();

        $pengiriman = [];
        $input_pengirim = \App\Models\Pengirim::where('kode_pengirim', $this->nama_pengirim)->first();
        $input_penerima = \App\Models\Penerima::where('kode_penerima', $this->nama_penerima)->first();

        if ($input_pengirim == null) {
            $pengirim = Pengirim::create([
                'nama_pengirim' => $this->nama_pengirim,
                'telp_pengirim' => $this->telp_pengirim,
            ]);
            $pengiriman['kode_pengirim'] = $pengirim->kode_pengirim;
        } else {
            $pengiriman['kode_pengirim'] = $this->nama_pengirim;
        }

        if($this->simpandb) {
            if ($input_penerima == null) {
                $penerima = Penerima::create([
                    'nama_penerima' => $this->nama_penerima,
                    'telp_penerima' => $this->telp_penerima,
                    'alamat_penerima_1' => $this->alamat_penerima_1,
                    'alamat_penerima_2' => $this->alamat_penerima_2,
                    'alamat_penerima_3' => $this->alamat_penerima_3,
                    'alamat_penerima_4' => $this->alamat_penerima_4,
                    'kode_pos_penerima' => $this->kode_pos_penerima,
                ]);
                $pengiriman['kode_penerima'] = $penerima->kode_penerima;
                $pengiriman['catatan'] = $this->catatan;
            } else {
                $pengiriman['kode_penerima'] = $this->nama_penerima;
                $pengiriman['catatan'] = $this->catatan;
            }
        } else {
            if ($input_penerima == null) {
                $pengiriman['nama_penerima'] = $this->nama_penerima;
                $pengiriman['telp_penerima'] = $this->telp_penerima;
                $pengiriman['alamat_penerima_1'] = $this->alamat_penerima_1;
                $pengiriman['alamat_penerima_2'] = $this->alamat_penerima_2;
                $pengiriman['alamat_penerima_3'] = $this->alamat_penerima_3;
                $pengiriman['alamat_penerima_4'] = $this->alamat_penerima_4;
                $pengiriman['kode_pos_penerima'] = $this->kode_pos_penerima;
                $pengiriman['catatan'] = $this->catatan;
            } else {
                $pengiriman['kode_penerima'] = $this->nama_penerima;
                $pengiriman['catatan'] = $this->catatan;
            }
        }

        if (Pengiriman::create($pengiriman)) {
            $this->reset(['nama_penerima', 'telp_penerima', 'alamat_penerima_1', 'alamat_penerima_2', 'alamat_penerima_3', 'alamat_penerima_4', 'kode_pos_penerima', 'catatan', 'simpandb']);
            return redirect()->route('jneawbcenter');
            $this->dispatch('alert', data: [
                'type' => 'success',
                'message' => 'Data berhasil ditambahkan.',
            ])->to(JNEAwbCenter::class);
        }
    }

    #[Computed()]
    public function pengirims()
    {
        return \App\Models\Pengirim::all();
    }

    public function updatedNamaPengirim()
    {
        $pengirim = \App\Models\Pengirim::where('kode_pengirim', $this->nama_pengirim)->first();
        if ($pengirim == null) {
            $this->reset(['telp_pengirim']);
            $this->telp_pengirim_enable = true;
        } else {
            $this->telp_pengirim = $pengirim->telp_pengirim;
            $this->telp_pengirim_enable = false;
        }
    }

    #[Computed()]
    public function penerimas()
    {
        return \App\Models\Penerima::all();
    }

    public function updatedNamaPenerima()
    {
        $penerima = \App\Models\Penerima::where('kode_penerima', $this->nama_penerima)->first();
        if ($penerima == null) {
            $this->reset(['telp_penerima', 'alamat_penerima_1', 'alamat_penerima_2', 'alamat_penerima_3', 'alamat_penerima_4', 'kode_pos_penerima']);
            $this->telp_penerima_enable = true;
            $this->alamat_penerima_1_enable = true;
            $this->alamat_penerima_2_enable = true;
            $this->alamat_penerima_3_enable = true;
            $this->alamat_penerima_4_enable = true;
            $this->kode_pos_penerima_enable = true;
        } else {
            $this->telp_penerima = $penerima->telp_penerima;
            $this->alamat_penerima_1 = $penerima->alamat_penerima_1;
            $this->alamat_penerima_2 = $penerima->alamat_penerima_2;
            $this->alamat_penerima_3 = $penerima->alamat_penerima_3;
            $this->alamat_penerima_4 = $penerima->alamat_penerima_4;
            $this->kode_pos_penerima = $penerima->kode_pos_penerima;
            $this->telp_penerima_enable = false;
            $this->alamat_penerima_1_enable = false;
            $this->alamat_penerima_2_enable = false;
            $this->alamat_penerima_3_enable = false;
            $this->alamat_penerima_4_enable = false;
            $this->kode_pos_penerima_enable = false;
        }
    }

    public function render()
    {
        return view('livewire.create-pengiriman');
    }
}

<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;

#[Layout('components.layouts.dashboard')]
#[Title('Buat Produk')]
class CreateProduct extends Component
{
    use WithPagination;
    public $paginationTheme = 'bootstrap';

    #[Rule('required|max:50')]
    public $kode_product;
    #[Rule('required|max:500')]
    public $nama_product;
    #[Rule('required|numeric:15,2')]
    public $harga_beli;
    #[Rule('required|numeric:15,2')]
    public $harga_jual;

    public $kode;

    #[Computed()]
    public function products()
    {
        return \App\Models\Product::paginate(10);
    }

    public function submit()
    {
        $this->validate();

        $data = \App\Models\Product::create([
            'kode_product' => $this->kode_product,
            'nama_product' => $this->nama_product,
            'harga_beli' => $this->harga_beli,
            'harga_jual' => $this->harga_jual,
        ]);

        if ($data) {
            $this->reset(['kode_product', 'nama_product', 'harga_beli', 'harga_jual']);
            $this->dispatch('alert', data: ['type' => 'success', 'message' => 'Data Berhasil disimpan!']);
        }
    }

    public function delete($id)
    {
        $data = \App\Models\Product::where('kode_product', $id);
        $penjualan = \App\Models\Penjualan::where('kode_product', $id)->count();
        if ($data) {
            if ($penjualan > 0) {
                $this->dispatch('alert', data: ['type' => 'error', 'message' => 'Produk ini sedang dijual!']);
                return false;
            }
            $data->delete();
            $this->dispatch('alert', data: ['type' => 'success', 'message' => 'Data Berhasil dihapus!']);
        }
    }



    public function render()
    {
        return view('livewire.create-product');
    }
}
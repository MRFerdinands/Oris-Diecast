<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Penjualan;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Livewire\Attributes\Rule;
use Livewire\WithFileUploads;
use App\Imports\ProductImport;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use App\Exports\PenjualanExport;
use Livewire\Attributes\Computed;
use Maatwebsite\Excel\Facades\Excel;

#[Layout('components.layouts.dashboard')]
#[Title('Pameran')]
class Pameran extends Component
{
    use WithPagination, WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    public $kode_product;
    public $harga_beli;
    public $harga_jual;
    public $qty = 1;
    public $kode_bayar;

    public $edit_kode_product;
    public $edit_harga_beli;
    public $edit_harga_jual;
    public $edit_qty = 1;
    public $edit_kode_bayar;

    public $total = 0;
    public $edit_total = 0;
    public $selectedID;
    public $selected = [];
    public $clear = false;
    public $total_selected_qty = 0;
    public $total_selected_harga = 0;

    public $file_import;

    #[Computed()]
    public function penjualans()
    {
        return \App\Models\Penjualan::paginate(10);
    }
    #[Computed()]
    public function products()
    {
        return \App\Models\Product::all();
    }
    #[Computed()]
    public function metodepembayarans()
    {
        return \App\Models\MetodePembayaran::all();
    }

    public function updatedSelected()
    {
        $this->clear = true;
        $this->total_selected_qty = 0;
        $this->total_selected_harga = 0;
        foreach ($this->selected as $key => $value) {
            $penjualan = \App\Models\Penjualan::where('no_urut', $value)->first();
            if ($penjualan) {
                $total = $penjualan->qty * $penjualan->harga_jual;
                $this->total_selected_qty += $penjualan->qty;
                $this->total_selected_harga += $total;
            }
        }
        if (empty($this->selected)) {
            $this->clear = false;
        }
    }

    public function updatedClear()
    {
        $this->selected = [];
        $this->clear = false;
        $this->total_selected_qty = 0;
        $this->total_selected_harga = 0;
    }

    public function updatedKodeProduct()
    {
        $product = \App\Models\Product::where('kode_product', $this->kode_product)->first();
        if ($product) {
            $this->harga_beli = $product->harga_beli;
            $this->harga_jual = $product->harga_jual;
            $this->total = $this->qty * $product->harga_jual;
        }
    }
    public function updatedQty()
    {
        if (is_numeric($this->qty)) {
            $this->total = $this->qty * $this->harga_jual;
        }
    }
    public function updatedHargaJual()
    {
        if (is_numeric($this->harga_jual)) {
            $this->total = $this->qty * $this->harga_jual;
        }
    }
    public function updatedEditKodeProduct()
    {
        $product = \App\Models\Product::where('kode_product', $this->edit_kode_product)->first();
        if ($product) {
            $this->edit_harga_beli = $product->harga_beli;
            $this->edit_harga_jual = $product->harga_jual;
            $this->edit_total = $this->edit_qty * $product->harga_jual;
        }
    }
    public function updatedEditQty()
    {
        if (is_numeric($this->edit_qty)) {
            $this->edit_total = $this->edit_qty * $this->edit_harga_jual;
        }
    }
    public function updatedEditHargaJual()
    {
        if (is_numeric($this->edit_harga_jual)) {
            $this->edit_total = $this->edit_qty * $this->edit_harga_jual;
        }
    }

    public function submit()
    {
        $this->validate([
            'kode_product' => 'required',
            'harga_beli' => 'required|decimal:2',
            'harga_jual' => 'required|decimal:2',
            'qty' => 'required|integer',
            'kode_bayar' => 'required',
        ]);

        $data = \App\Models\Penjualan::create([
            'kode_product' => $this->kode_product,
            'harga_jual' => $this->harga_jual,
            'qty' => $this->qty,
            'kode_bayar' => $this->kode_bayar,
        ]);

        if ($data) {
            $this->dispatch('alert', data: [
                'type' => 'success',
                'message' => 'Data Berhasil disimpan!',
            ]);
            $this->dispatch('clearSelect2');
            $this->reset(['kode_product', 'harga_jual', 'harga_beli', 'qty', 'total', 'kode_bayar']);
        }
    }

    public function edit()
    {
        $this->validate([
            'edit_kode_product' => 'required',
            'edit_harga_beli' => 'required|decimal:2',
            'edit_harga_jual' => 'required|decimal:2',
            'edit_qty' => 'required|integer',
            'edit_kode_bayar' => 'required',
        ]);

        $data = \App\Models\Penjualan::find($this->selectedID)->first();
        $data->update([
            'kode_product' => $this->edit_kode_product,
            'harga_jual' => $this->edit_harga_jual,
            'qty' => $this->edit_qty,
            'kode_bayar' => $this->edit_kode_bayar,
        ]);

        if ($data) {
            $this->dispatch('alert', data: [
                'type' => 'success',
                'message' => 'Data Berhasil disimpan!',
            ]);
            $this->dispatch('clearSelect2');
            $this->reset(['edit_kode_product', 'edit_harga_jual', 'edit_harga_beli', 'edit_qty', 'edit_total', 'edit_kode_bayar']);
        }
    }

    #[On('deleteConfirmed')]
    public function delete($id = null) {
        $penjualan = \App\Models\Penjualan::find($id);
        if ($penjualan) {
            $penjualan->delete();
            $this->dispatch('alert', data: [
                'type' => 'success',
                'message' => 'Data berhasil dihapus!',
            ]);
        }
    }

    public function setData($no_urut)
    {
        $this->selectedID = $no_urut;
        $penjualan = \App\Models\Penjualan::find($no_urut);

        if ($penjualan) {
            $this->edit_kode_product = $penjualan->kode_product;
            $this->edit_harga_beli = $penjualan->product->harga_beli;
            $this->edit_harga_jual = $penjualan->harga_jual;
            $this->edit_qty = $penjualan->qty;
            $this->edit_kode_bayar = $penjualan->kode_bayar;
            $this->edit_total = $penjualan->qty * $penjualan->harga_jual;
        }
    }

    public function resetForm()
    {
        $this->kode_product = null;
        $this->harga_beli = null;
        $this->harga_jual = null;
        $this->qty = 0;
        $this->total = 0;
        $this->kode_bayar = null;
        $this->dispatch('clearSelect2');
    }

    #[On('downloadConfirmed')]
    public function download()
    {
        $this->dispatch('alert', data: [
            'type' => 'success',
            'message' => 'Data berhasil diexport!',
        ]);
        return Excel::download(new PenjualanExport, 'pameran-' . date('Y-m-d H:i') . '.xlsx');
    }

    public function import()
    {
        $this->validate([
            'file_import' => 'required|file|mimes:xls,xlsx,csv',
        ]);

        Excel::import(new ProductImport, $this->file_import->getRealPath());

        $this->dispatch('alert', data: [
            'type' => 'success',
            'message' => 'Data berhasil dimport!',
        ]);
    }

    public function render()
    {
        return view('livewire.pameran');
    }
}
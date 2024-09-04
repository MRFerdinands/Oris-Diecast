<?php

namespace App\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\Pengiriman;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;

#[Layout('components.layouts.dashboard')]
#[Title('JNE Awb Center')]
class JNEAwbCenter extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $filter_resi = 'noresi';
    public $filter_tanggal = 'bulan_ini';
    public $search = '';

    public $setedID;
    public $no_resi;
    public $viewData = [];

    #[Computed()]
    public function datas()
    {
        $now = Carbon::now();
        $query = Pengiriman::query();

        // Filter Resi
        if ($this->filter_resi == 'noresi') {
            $query->whereNull('no_resi');
            $this->filter_tanggal = '';
        } else {
            $query->whereNotNull('no_resi');

            if (empty($this->filter_tanggal)) {
                $this->filter_tanggal = 'bulan_ini';
            }
        }

        // Filter Search
        if (!empty($this->search)) {
            $query->where(function ($subQuery) {
                $subQuery->whereHas('pengirim', function ($query) {
                    $query->where('nama_pengirim', 'LIKE', "%{$this->search}%");
                })
                ->orWhereHas('penerima', function ($query) {
                    $query->where('nama_penerima', 'LIKE', "%{$this->search}%");
                })
                ->orWhere('nama_penerima', 'LIKE', "%{$this->search}%")
                ->orWhere('no_resi', 'LIKE', "%{$this->search}%");
            });
        }

        // Filter Tanggal
        if ($this->filter_tanggal == 'bulan_ini') {
            $query->whereYear('updated_at', $now->year)
                    ->whereMonth('updated_at', $now->month);
        } elseif ($this->filter_tanggal == 'tahun_ini') {
            $query->whereYear('updated_at', $now->year);
        } elseif ($this->filter_tanggal == 'bulan_lalu') {
            $lastMonth = $now->copy()->subMonth();
            $query->whereYear('updated_at', $lastMonth->year)
                    ->whereMonth('updated_at', $lastMonth->month);
        }

        return $query->paginate(10);
    }

    public function tambahresi()
    {
        $this->validate([
            'no_resi' => 'required|string|min:10|max:20|unique:pengiriman,no_resi',
        ]);

        $pengiriman = Pengiriman::whereNull('no_resi')
                                ->where('no_trx', $this->setedID);

        if ($pengiriman->update(['no_resi' => $this->no_resi])) {
            $this->dispatch('alert', data: [
                'type' => 'success',
                'message' => 'Resi berhasil ditambahkan',
            ]);
        }
    }

    #[On('deleteConfirmed')]
    public function delete($id = null) {
        $pengiriman = Pengiriman::find($id);
        if ($pengiriman) {
            $pengiriman->delete();
            $this->dispatch('alert', data: [
                'type' => 'success',
                'message' => 'Data berhasil dihapus!',
            ]);
        }
    }

    public function render()
    {
        return view('livewire.jne-awb-center');
    }

    public function setData($id_resi)
    {
        $this->setedID = $id_resi;

        $pengiriman = Pengiriman::find($id_resi);
        $data['no_trx'] = $pengiriman->no_trx;
        $data['nama_pengirim'] = $pengiriman->kode_pengirim ? $pengiriman->pengirim->nama_pengirim : $pengiriman->nama_pengirim;
        $data['telp_pengirim'] = $pengiriman->kode_pengirim ? $pengiriman->pengirim->telp_pengirim : $pengiriman->telp_pengirim;
        $data['nama_penerima'] = $pengiriman->kode_penerima ? $pengiriman->penerima->nama_penerima : $pengiriman->nama_penerima;
        $data['telp_penerima'] = $pengiriman->kode_penerima ? $pengiriman->penerima->telp_penerima : $pengiriman->telp_penerima;
        $data['alamat_penerima_1'] = $pengiriman->kode_penerima ? $pengiriman->penerima->alamat_penerima_1 : $pengiriman->alamat_penerima_1;
        $data['alamat_penerima_2'] = $pengiriman->kode_penerima ? $pengiriman->penerima->alamat_penerima_2 : $pengiriman->alamat_penerima_2;
        $data['alamat_penerima_3'] = $pengiriman->kode_penerima ? $pengiriman->penerima->alamat_penerima_3 : $pengiriman->alamat_penerima_3;
        $data['alamat_penerima_4'] = $pengiriman->kode_penerima ? $pengiriman->penerima->alamat_penerima_4 : $pengiriman->alamat_penerima_4;
        $data['kode_pos_penerima'] = $pengiriman->kode_penerima ? $pengiriman->penerima->kode_pos_penerima : $pengiriman->kode_pos_penerima;
        $data['no_resi'] = $pengiriman->no_resi ? $pengiriman->no_resi : 'Belum Ada Resi';

        $this->viewData = $data;
    }
}

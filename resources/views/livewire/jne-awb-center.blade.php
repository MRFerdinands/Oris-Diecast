<div class="container-xl flex-grow-1 container-p-y w-100">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">JNE Awb Center</h5>
            <p class="card-text">Data Pengiriman dan Resi.</p>
            @if (auth()->user()->role == 'A')
                <div class="d-flex gap-3">
                    <a href="{{ route('create') }}" type="button" class="btn btn-primary">
                        <span class="tf-icons bx bx-plus bx-18px me-md-2"></span>
                        <span>Tambah</span>
                        {{-- <span class="d-none d-md-block">Tambah</span> --}}
                    </a>
                    {{-- @if ($this->selected)
                    <button type="button" class="btn btn-danger">
                        <span class="tf-icons bx bx-trash bx-18px me-md-2"></span>
                        <span class="d-none d-md-block">Hapus</span>
                    </button>
                @endif --}}
                    {{-- <button type="button" class="btn btn-warning">
                        <span class="tf-icons bx bx-history bx-18px me-md-2"></span>
                        <span class="d-none d-md-block">Simpan Pengiriman Ke History</span>
                    </button> --}}
                </div>
            @endif
            <div class="row mt-3">
                <div class="col-12 col-md-8 mb-3 mb-md-0">
                    <div class="row g-1">
                        <div class="col-6 col-md-4">
                            <x-input.select2 nosearch wire:model="filter_resi" :data="collect([
                                (object) ['id' => 'noresi', 'nama' => 'Belum Input Resi'],
                                (object) ['id' => 'resi', 'nama' => 'Telah Input Resi'],
                            ])" dataKey="id"
                                dataLabel="nama" selected="noresi" />
                        </div>
                        @if ($this->filter_resi == 'resi')
                            <div class="col-6 col-md-4">
                                <x-input.select2 nosearch wire:model="filter_tanggal" :data="collect([
                                    (object) ['id' => 'tahun_ini', 'nama' => 'Tahun Ini'],
                                    (object) ['id' => 'bulan_ini', 'nama' => 'Bulan Ini'],
                                    (object) ['id' => 'bulan_lalu', 'nama' => 'Bulan Lalu'],
                                ])" dataKey="id"
                                    dataLabel="nama" selected="bulan_ini" />
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <input type="search" class="form-control" wire:model.live="search" placeholder="Search...">
                </div>
            </div>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table table-striped">
                <thead>
                    <tr>
                        {{-- <th></th> --}}
                        <th>No</th>
                        <th>Pengirim</th>
                        <th>Penerima</th>
                        <th>Alamat</th>
                        <th>Kode Pos</th>
                        <th>Catatan</th>
                        <th>No. Resi</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse ($this->datas as $index => $pengiriman)
                        <tr>
                            {{-- <td>
                                <input type="checkbox" wire:key="{{ $pengiriman->no_trx }}" wire:model.live="selected"
                                    value="{{ $pengiriman->no_trx }}" class="form-check-input">
                            </td> --}}
                            <td>
                                <p class="m-0 p-0 fw-bold">
                                    {{ $pengiriman->no_trx }}
                                </p>
                            </td>
                            <td>
                                <p class="m-0 p-0 fw-semibold">
                                    {{ $pengiriman->kode_pengirim ? $pengiriman->pengirim->nama_pengirim : $pengiriman->nama_pengirim }}
                                </p>
                                <p class="m-0 p-0">
                                    {{ $pengiriman->kode_pengirim ? $pengiriman->pengirim->telp_pengirim : $pengiriman->telp_pengirim }}
                                </p>
                            </td>
                            <td>
                                <p class="m-0 p-0 fw-semibold">
                                    {{ $pengiriman->kode_penerima ? $pengiriman->penerima->nama_penerima : $pengiriman->nama_penerima }}
                                </p>
                                <p class="m-0 p-0">
                                    {{ $pengiriman->kode_penerima ? $pengiriman->penerima->telp_penerima : $pengiriman->telp_penerima }}
                                </p>
                            </td>
                            <td>
                                <span class="m-0 p-0">
                                    {{ $pengiriman->kode_penerima ? $pengiriman->penerima->alamat_penerima_1 : $pengiriman->alamat_penerima_1 }},
                                </span>
                                <span class="m-0 p-0">
                                    {{ $pengiriman->kode_penerima ? $pengiriman->penerima->alamat_penerima_2 : $pengiriman->alamat_penerima_2 }},
                                </span>
                                <br>
                                <span class="m-0 p-0">
                                    {{ $pengiriman->kode_penerima ? $pengiriman->penerima->alamat_penerima_3 : $pengiriman->alamat_penerima_3 }},
                                </span>
                                <span class="m-0 p-0">
                                    {{ $pengiriman->kode_penerima ? $pengiriman->penerima->alamat_penerima_4 : $pengiriman->alamat_penerima_4 }}.
                                </span>
                            </td>
                            <td>
                                <p class="m-0 p-0">
                                    {{ $pengiriman->kode_penerima ? $pengiriman->penerima->kode_pos_penerima : $pengiriman->kode_pos_penerima }}
                                </p>
                            </td>
                            <td>
                                <p class="m-0 p-0 text-wrap">{{ $pengiriman->catatan }}</p>
                            </td>
                            <td>
                                <p class="m-0 p-0">{{ $pengiriman->no_resi ? $pengiriman->no_resi : '' }}</p>
                                @if ($pengiriman->no_resi)
                                    <button data-clipboard-text="{{ $pengiriman->no_resi }}"
                                        class="btn btn-sm btn-success">Copy Resi</button>
                                @else
                                    @if (auth()->user()->role == 'A' || auth()->user()->role == 'JNE')
                                        <button wire:click="setData({{ $pengiriman->no_trx }})"
                                            class="btn btn-sm btn-info" data-bs-target="#tambah_resi"
                                            data-bs-toggle="modal">Tambah Resi</button>
                                    @else
                                        <p class="m-0 p-0">-</p>
                                    @endif
                                @endif
                            </td>
                            <td>
                                <div class="text-center">
                                    <button wire:click="setData({{ $pengiriman->no_trx }})"
                                        class="btn btn-sm btn-warning" data-bs-target="#view_data"
                                        data-bs-toggle="modal">View</button>
                                    @if (auth()->user()->role == 'A')
                                        <button wire:click="$dispatch('delete', { id: '{{ $pengiriman->no_trx }}' })"
                                            class="btn btn-sm btn-danger">Delete</button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9">
                                <div class="d-flex justify-content-center align-items-center py-4">
                                    <i class='bx bx-error-circle fs-2 me-1'></i>
                                    <p class="m-0 p-0 fw-semibold">Tidak ada Data ditemukan!</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="{{ $this->datas->hasPages() ? 'px-3 mt-3' : '' }}">
            {{ $this->datas->links() }}
        </div>
    </div>
    @teleport('body')
        <div>
            <form wire:submit="tambahresi">
                @csrf
                <div wire:ignore.self class="modal fade" id="tambah_resi" data-bs-backdrop="static" data-bs-keyboard="false"
                    tabindex="-1" aria-labelledby="eventLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <div class="modal-title">
                                    <p class="fs-4 m-0 p-0 fw-semibold text-dark" id="eventLabel">Tambah Resi</p>
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label for="no_resi" class="form-label">No. Resi</label>
                                            <input required type="text" class="form-control" id="no_resi"
                                                wire:model.live="no_resi" placeholder="eg. 01234567891011">
                                            @error('no_resi')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-primary w-100" type="submit">Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            @if ($this->viewData)
                <div wire:ignore.self class="modal fade" id="view_data" data-bs-backdrop="static" data-bs-keyboard="false"
                    tabindex="-1" aria-labelledby="eventLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <div class="modal-title">
                                    <p class="fs-4 m-0 p-0 fw-semibold text-dark" id="eventLabel">Detail Pengiriman
                                        {{ $this->viewData['no_trx'] }}</p>
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-12">
                                        <label class="form-label">Nama Pengirim</label>
                                        <div class="input-group mb-3">
                                            <input id="view_nama_pengirim" type="text" class="form-control" readonly
                                                value="{{ $this->viewData['nama_pengirim'] }}" placeholder="Jhon Doe">
                                            <button data-clipboard-action="copy"
                                                data-clipboard-target="#view_nama_pengirim"
                                                class="btn btn-outline-primary" type="button"
                                                id="button-addon2">Copy</button>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Telp Pengirim</label>
                                        <div class="input-group mb-3">
                                            <input id="view_telp_pengirim" type="text" class="form-control" readonly
                                                value="{{ $this->viewData['telp_pengirim'] }}"
                                                placeholder="08**********">
                                            <button data-clipboard-action="copy"
                                                data-clipboard-target="#view_telp_pengirim"
                                                class="btn btn-outline-primary" type="button"
                                                id="button-addon2">Copy</button>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Nama Penerima</label>
                                        <div class="input-group mb-3">
                                            <input id="view_nama_penerima" type="text" class="form-control" readonly
                                                value="{{ $this->viewData['nama_penerima'] }}s" placeholder="Jhon Doe">
                                            <button data-clipboard-action="copy"
                                                data-clipboard-target="#view_nama_penerima"
                                                class="btn btn-outline-primary" type="button"
                                                id="button-addon2">Copy</button>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Telp Penerima</label>
                                        <div class="input-group mb-3">
                                            <input id="view_telp_penerima" type="text" class="form-control" readonly
                                                value="{{ $this->viewData['telp_penerima'] }}"
                                                placeholder="08**********">
                                            <button data-clipboard-action="copy"
                                                data-clipboard-target="#view_telp_penerima"
                                                class="btn btn-outline-primary" type="button"
                                                id="button-addon2">Copy</button>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Alamat #1</label>
                                        <div class="input-group mb-3">
                                            <input id="view_alamat_penerima_1" type="text" class="form-control"
                                                readonly value="{{ $this->viewData['alamat_penerima_1'] }}"
                                                placeholder="Jl Sidoarjo No 09">
                                            <button data-clipboard-action="copy"
                                                data-clipboard-target="#view_alamat_penerima_1"
                                                class="btn btn-outline-primary" type="button"
                                                id="button-addon2">Copy</button>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Alamat #2</label>
                                        <div class="input-group mb-3">
                                            <input id="view_alamat_penerima_2" type="text" class="form-control"
                                                readonly value="{{ $this->viewData['alamat_penerima_2'] }}"
                                                placeholder="Jl Sidoarjo No 09">
                                            <button data-clipboard-action="copy"
                                                data-clipboard-target="#view_alamat_penerima_2"
                                                class="btn btn-outline-primary" type="button"
                                                id="button-addon2">Copy</button>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Alamat #3</label>
                                        <div class="input-group mb-3">
                                            <input id="view_alamat_penerima_3" type="text" class="form-control"
                                                readonly value="{{ $this->viewData['alamat_penerima_3'] }}"
                                                placeholder="Jl Sidoarjo No 09">
                                            <button data-clipboard-action="copy"
                                                data-clipboard-target="#view_alamat_penerima_3"
                                                class="btn btn-outline-primary" type="button"
                                                id="button-addon2">Copy</button>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Alamat #4</label>
                                        <div class="input-group mb-3">
                                            <input id="view_alamat_penerima_4" type="text" class="form-control"
                                                readonly value="{{ $this->viewData['alamat_penerima_4'] }}"
                                                placeholder="Jl Sidoarjo No 09">
                                            <button data-clipboard-action="copy"
                                                data-clipboard-target="#view_alamat_penerima_4"
                                                class="btn btn-outline-primary" type="button"
                                                id="button-addon2">Copy</button>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Kode Pos</label>
                                        <div class="input-group mb-3">
                                            <input id="view_kode_pos_penerima" type="text" class="form-control"
                                                readonly value="{{ $this->viewData['kode_pos_penerima'] }}"
                                                placeholder="6****">
                                            <button data-clipboard-action="copy"
                                                data-clipboard-target="#view_kode_pos_penerima"
                                                class="btn btn-outline-primary" type="button"
                                                id="button-addon2">Copy</button>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">No. Resi</label>
                                        <div class="input-group mb-3">
                                            <input id="view_no_resi" type="text" class="form-control" readonly
                                                value="{{ $this->viewData['no_resi'] }}" placeholder="S*************">
                                            <button data-clipboard-action="copy" data-clipboard-target="#view_no_resi"
                                                class="btn btn-outline-primary" type="button"
                                                id="button-addon2">Copy</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="modal-footer">
                            <button class="btn btn-primary w-100" type="submit">Simpan</button>
                        </div> --}}
                        </div>
                    </div>
                </div>
            @endif
        </div>
    @endteleport
</div>

@script
    <script>
        new ClipboardJS('.btn');
        $(document).ready(function() {
            $('form').on('submit', function(e) {
                $('[type="submit"]').prop('disabled', true);
                $('[type="submit"]').html(
                    '<span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span> Data Diproses...'
                );
                setTimeout(() => {
                    $('[type="submit"]').html('Simpan');
                    $('[type="submit"]').prop('disabled', false);
                }, 1000);
            });
        });
        $wire.on('alert', (data) => {
            if (data.data.type == 'success') {
                toastr.success(data.data.message, 'System');
            } else {
                toastr.error(data.data.message, 'System');
            }
            $('#tambah_resi').modal('hide');
        });
        $wire.on('delete', (event) => {
            Swal.fire({
                icon: "warning",
                html: `
                    <h4>Apakah anda yakin?</h4>
                    <small>Anda tidak akan bisa mengembalikan data yang telah dihapus!</small>
                `,
                showCancelButton: true,
                customClass: {
                    confirmButton: "btn btn-danger",
                    cancelButton: "btn btn-outline-danger"
                },
                confirmButtonText: "Ya, Hapus!",
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.dispatch('deleteConfirmed', {
                        id: event.id
                    });
                }
            });
        });
    </script>
@endscript

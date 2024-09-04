<div class="container-xl flex-grow-1 container-p-y w-100">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Pemeran</h5>
            <p class="card-text">Data Penjualan Pameran.</p>
            <div class="d-flex justify-content-between mb-3">
                <button data-bs-target="#create" data-bs-toggle="modal" type="button" class="btn btn-primary">
                    <span class="tf-icons bx bx-plus bx-18px me-md-2"></span>
                    <span>Tambah</span>
                    {{-- <span class="d-none d-md-block">Tambah</span> --}}
                </button>
                <div class="d-flex gap-3 justify-content-end">
                    <button data-bs-target="#import" data-bs-toggle="modal" class="btn btn-warning">Import
                        Product</button>
                    <button wire:click="$dispatch('download')" class="btn btn-success"
                        {{ $this->penjualans->count() > 0 ? '' : 'disabled' }}>Dowload</button>
                </div>
            </div>
            <div class="d-row d-md-flex gap-3 justify-content-center justify-content-md-end">
                <p class="m-0 p-0 fs-5">Total Qty:
                    {{ $this->total_selected_qty }}</p>
                <p class="m-0 p-0 fs-5">Total Nilai Penjulan:
                    {{ 'Rp ' . number_format($this->total_selected_harga, 0, ',', '.') }}</p>
            </div>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>
                            <input type="checkbox" wire:model.live="clear" {{ $this->clear ? '' : 'disabled' }}
                                class="form-check-input">
                        </th>
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>Harga</th>
                        <th>Qty</th>
                        <th>Sub Total</th>
                        <th>Metode Pembayaran</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse ($this->penjualans as $index => $penjualan)
                        <tr>
                            <td>
                                <input type="checkbox" wire:key="{{ $penjualan->no_urut }}" wire:model.live="selected"
                                    value="{{ $penjualan->no_urut }}" class="form-check-input">
                            </td>
                            <td>
                                <p class="m-0 p-0 fw-bold">
                                    {{ $penjualan->product->kode_product }}
                                </p>
                            </td>
                            <td>
                                <p class="m-0 p-0">
                                    {{ $penjualan->product->nama_product }}
                                </p>
                            </td>
                            <td>
                                <p class="m-0 p-0">
                                    {{ 'Rp ' . number_format($penjualan->harga_jual, 0, ',', '.') }}
                                </p>
                            </td>
                            <td>
                                <p class="m-0 p-0">
                                    {{ $penjualan->qty }}
                                </p>
                            </td>
                            <td>
                                <p class="m-0 p-0">
                                    {{ 'Rp ' . number_format($penjualan->qty * $penjualan->harga_jual, 0, ',', '.') }}
                                </p>
                            </td>
                            <td>
                                <p class="m-0 p-0">
                                    {{ $penjualan->metodepembayaran->nama_bayar }}
                                </p>
                            </td>
                            <td>
                                <div class="text-center">
                                    <button wire:click="setData({{ $penjualan->no_urut }})"
                                        class="btn btn-sm btn-warning" data-bs-target="#edit"
                                        data-bs-toggle="modal">Edit</button>
                                    <button wire:click="$dispatch('delete', { id: '{{ $penjualan->no_urut }}' })"
                                        class="btn btn-sm btn-danger">Delete</button>
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
        <div class="{{ $this->penjualans->hasPages() ? 'px-3 mt-3' : '' }}">
            {{ $this->penjualans->links() }}
        </div>
    </div>
    @teleport('body')
        <div>
            <form wire:submit="submit">
                @csrf
                <div wire:ignore.self class="modal fade" id="create" data-bs-backdrop="static" data-bs-keyboard="false"
                    tabindex="-1" aria-labelledby="eventLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <div class="modal-title">
                                    <p class="fs-4 m-0 p-0 fw-semibold text-dark" id="eventLabel">Tambah Penjualan</p>
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label for="kode_product" class="form-label">Barang</label>
                                            <x-input.select2 wire:model="kode_product" :data="$this->products"
                                                dataKey="kode_product" dataLabel="nama_product" modal="create" />
                                            @error('kode_product')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="mb-3">
                                            <label for="harga_beli" class="form-label">Harga Beli</label>
                                            <input required type="text" class="form-control" id="harga_beli"
                                                wire:model="harga_beli" readonly placeholder="eg. 20.000">
                                            @error('harga_beli')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="mb-3">
                                            <label for="harga_jual" class="form-label">Harga Jual</label>
                                            <input required type="text" class="form-control" id="harga_jual"
                                                wire:model.live="harga_jual" placeholder="eg. 50.000">
                                            @error('harga_jual')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label for="qty" class="form-label">Qty</label>
                                            <input required type="text" class="form-control" id="qty"
                                                wire:model.live="qty" placeholder="eg. 4">
                                            @error('qty')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label for="kode_bayar" class="form-label">Metode Pembayaran</label>
                                            <x-input.select2 wire:model="kode_bayar" :data="$this->metodepembayarans"
                                                dataKey="kode_bayar" dataLabel="nama_bayar" modal="create" />
                                            @error('kode_bayar')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="">
                                            <h3 class="m-0 p-0">Total:
                                                {{ 'Rp ' . number_format($this->total, 0, ',', '.') }}</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <div class="d-flex gap-3 w-100">
                                    <button class="btn btn-primary w-100" type="submit">Simpan</button>
                                    <button wire:click="resetForm" class="btn btn-danger w-100"
                                        type="button">Reset</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <form wire:submit="edit">
                @csrf
                <div wire:ignore.self class="modal fade" id="edit" data-bs-backdrop="static"
                    data-bs-keyboard="false" tabindex="-1" aria-labelledby="eventLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <div class="modal-title">
                                    <p class="fs-4 m-0 p-0 fw-semibold text-dark" id="eventLabel">Edit Penjualan</p>
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label for="edit_kode_product" class="form-label">Barang</label>
                                            <x-input.select2 wire:model="edit_kode_product" :data="$this->products"
                                                dataKey="kode_product" dataLabel="nama_product" modal="edit"
                                                selected="{{ $this->edit_kode_product }}" />
                                            @error('edit_kode_product')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="mb-3">
                                            <label for="edit_harga_beli" class="form-label">Harga Beli</label>
                                            <input required type="text" class="form-control" id="edit_harga_beli"
                                                wire:model="edit_harga_beli" readonly placeholder="eg. 20.000">
                                            @error('edit_harga_beli')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="mb-3">
                                            <label for="edit_harga_jual" class="form-label">Harga Jual</label>
                                            <input required type="text" class="form-control" id="edit_harga_jual"
                                                wire:model.live="edit_harga_jual" placeholder="eg. 50.000">
                                            @error('edit_harga_jual')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label for="edit_qty" class="form-label">Qty</label>
                                            <input required type="text" class="form-control" id="edit_qty"
                                                wire:model.live="edit_qty" placeholder="eg. 4">
                                            @error('edit_qty')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label for="edit_kode_bayar" class="form-label">Metode Pembayaran</label>
                                            <x-input.select2 wire:model="edit_kode_bayar" :data="$this->metodepembayarans"
                                                dataKey="kode_bayar" dataLabel="nama_bayar" modal="edit"
                                                selected="{{ $this->edit_kode_bayar }}" />
                                            @error('edit_kode_bayar')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="">
                                            <h3 class="m-0 p-0">Total:
                                                {{ 'Rp ' . number_format($this->edit_total, 0, ',', '.') }}</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <div class="d-flex gap-3 w-100">
                                    <button class="btn btn-primary w-100" type="submit">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <form wire:submit="import">
                @csrf
                <div wire:ignore.self class="modal fade" id="import" data-bs-backdrop="static"
                    data-bs-keyboard="false" tabindex="-1" aria-labelledby="eventLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <div class="modal-title">
                                    <p class="fs-4 m-0 p-0 fw-semibold text-dark" id="eventLabel">Import Product</p>
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label for="file_import" class="form-label">File Excel</label>
                                            <input required type="file" wire:model="file_import" class="form-control"
                                                id="file_import" />
                                            @error('file_import')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <div class="d-flex gap-3 w-100">
                                    <button class="btn btn-primary w-100" type="submit">Import</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
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
            $('#create').modal('hide');
            $('#edit').modal('hide');
            $('#import').modal('hide');
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
        $wire.on('download', (event) => {
            Swal.fire({
                icon: "warning",
                html: `
                    <h4>Apakah anda yakin?</h4>
                    <small>Anda akan menghapus semua data dan mengexportnya!</small>
                `,
                showCancelButton: true,
                customClass: {
                    confirmButton: "btn btn-warning",
                    cancelButton: "btn btn-outline-danger"
                },
                confirmButtonText: "Ya, Export!",
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.dispatch('downloadConfirmed');
                }
            });
        });
    </script>
@endscript

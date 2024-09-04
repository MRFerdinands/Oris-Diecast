<div class="container-xl flex-grow-1 container-p-y w-100">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="card-title">Metode Pembayaran</h5>
                    <p class="card-text">Data Metode Pembayaran.</p>
                </div>
                <div>
                    <button class="btn btn-primary" data-bs-target="#create" data-bs-toggle="modal"
                        type="button">Tambah</button>
                </div>
            </div>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>Potongan</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom">
                    @forelse ($this->payments as $pay)
                        <tr>
                            <td>{{ $pay->kode_bayar }}</td>
                            <td>{{ $pay->nama_bayar }}</td>
                            <td>{{ $pay->potongan }}</td>
                            <td>
                                <button wire:click="delete('{{ $pay->kode_bayar }}')" class="btn btn-sm btn-danger"><i
                                        class="bx bx-trash me-1"></i>
                                    Delete</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">
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
    </div>
    @teleport('body')
        <form wire:submit="submit">
            @csrf
            <div wire:ignore.self class="modal fade" id="create" data-bs-backdrop="static" data-bs-keyboard="false"
                tabindex="-1" aria-labelledby="eventLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div class="modal-title">
                                <p class="fs-4 m-0 p-0 fw-semibold text-dark" id="eventLabel">Tambah Metode Pembayaran</p>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label for="kode_bayar" class="form-label">Kode Pembayaran</label>
                                        <input required type="text" class="form-control" id="kode_bayar"
                                            wire:model.defer="kode_bayar" placeholder="eg. BRND">
                                        @error('kode_bayar')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label for="nama_bayar" class="form-label">Nama Pembayaran</label>
                                        <input required type="text" class="form-control" id="nama_bayar"
                                            wire:model.defer="nama_bayar" placeholder="eg. Fantech">
                                        @error('nama_bayar')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label for="potongan" class="form-label">Potongan</label>
                                        <input required type="number" class="form-control" id="potongan"
                                            wire:model.defer="potongan" placeholder="eg. 40.000">
                                        @error('potongan')
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
    @endteleport
</div>

@script
    <script>
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
        })
    </script>
@endscript

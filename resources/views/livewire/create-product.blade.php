<div class="container-xl flex-grow-1 container-p-y w-100">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="card-title">Produk</h5>
                    <p class="card-text">Data Produk.</p>
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
                        <th>Harga Beli</th>
                        <th>Harga Jual</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom">
                    @forelse ($this->products as $product)
                        <tr>
                            <td>{{ $product->kode_product }}</td>
                            <td>{{ $product->nama_product }}</td>
                            <td>{{ $product->harga_beli }}</td>
                            <td>{{ $product->harga_jual }}</td>
                            <td>
                                <button wire:click="delete('{{ $product->kode_product }}')"
                                    class="btn btn-sm btn-danger"><i class="bx bx-trash me-1"></i>
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
        <div class="{{ $this->products->hasPages() ? 'px-3 mt-3' : '' }}">
            {{ $this->products->links() }}
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
                                <p class="fs-4 m-0 p-0 fw-semibold text-dark" id="eventLabel">Tambah Produk</p>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label for="kode_product" class="form-label">Kode Produk</label>
                                        <input required type="text" class="form-control" id="kode_product"
                                            wire:model.defer="kode_product" placeholder="eg. BRND">
                                        @error('kode_product')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label for="nama_product" class="form-label">Nama Produk</label>
                                        <input required type="text" class="form-control" id="nama_product"
                                            wire:model.defer="nama_product" placeholder="eg. Fantech">
                                        @error('nama_product')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label for="harga_beli" class="form-label">Harga Beli</label>
                                        <input required type="text" class="form-control" id="harga_beli"
                                            wire:model.defer="harga_beli" placeholder="eg. 40.000">
                                        @error('harga_beli')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label for="harga_jual" class="form-label">Harga Jual</label>
                                        <input required type="text" class="form-control" id="harga_jual"
                                            wire:model.defer="harga_jual" placeholder="eg. Fantech">
                                        @error('harga_jual')
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

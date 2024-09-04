<div class="container-xl flex-grow-1 container-p-y w-100">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="card-title">Other Links</h5>
                    <p class="card-text">Data links.</p>
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
                        <th>Gambar</th>
                        <th>Nama</th>
                        <th>Link</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse ($this->links as $link)
                        <tr>
                            <td>
                                <img src="{{ asset('storage/img/links/' . $link->gambar_link) }}"
                                    alt="{{ $link->gambar_link }}" class="img-fluid" width="70">
                            </td>
                            <td>{{ $link->nama_link }}</td>
                            <td>{{ $link->alamat_link }}</td>
                            <td>
                                <button wire:click="delete('{{ $link->id }}')" class="btn btn-sm btn-danger"><i
                                        class="bx bx-trash me-1"></i>
                                    Delete</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">
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
        <div>
            <form wire:submit="submit">
                @csrf
                <div wire:ignore.self class="modal fade" id="create" data-bs-backdrop="static" data-bs-keyboard="false"
                    tabindex="-1" aria-labelledby="eventLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <div class="modal-title">
                                    <p class="fs-4 m-0 p-0 fw-semibold text-dark" id="eventLabel">Tambah Links</p>
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label class="form-label">Gambar Link</label>
                                            <div class="card-body">
                                                <div class="d-flex align-items-start align-items-sm-center gap-6">
                                                    <img src="{{ $this->gambar_link ? $this->gambar_link->temporaryUrl() : asset('storage/img/logo.png') }}"
                                                        alt="user-avatar"
                                                        class="d-block w-px-150 h-px-120 border object-fit-cover rounded"
                                                        id="uploadedAvatar">
                                                    <div class="button-wrapper">
                                                        <label for="upload" class="btn btn-primary me-3 mb-4"
                                                            tabindex="0">
                                                            <span class="d-none d-sm-block">Upload new photo</span>
                                                            <i class="bx bx-upload d-block d-sm-none"></i>
                                                            <input type="file" id="upload"
                                                                wire:model.defer="gambar_link" class="account-file-input"
                                                                hidden="" accept="image/png, image/jpeg">
                                                        </label>
                                                        <button type="button" wire:click="clearLogo"
                                                            class="btn btn-label-secondary account-image-reset mb-4">
                                                            <i class="bx bx-reset d-block d-sm-none"></i>
                                                            <span class="d-none d-sm-block">Reset</span>
                                                        </button>

                                                        <div><small>Allowed JPG, GIF or PNG. Max size of 800K</small></div>
                                                    </div>
                                                </div>
                                            </div>
                                            @error('gambar_link')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="nama_link" class="form-label">Nama Link</label>
                                            <input required type="text" class="form-control" id="nama_link"
                                                wire:model.defer="nama_link" placeholder="eg. Laravel">
                                            @error('nama_link')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="alamat_link" class="form-label">Url Link</label>
                                            <input required type="text" class="form-control" id="alamat_link"
                                                wire:model.defer="alamat_link" placeholder="eg. http://www.laravel.com">
                                            @error('alamat_link')
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
        </div>
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

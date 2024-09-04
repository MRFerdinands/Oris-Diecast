<div class="container-xl flex-grow-1 container-p-y w-100">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="card-title">Store Locations</h5>
                    <p class="card-text">Data lokasi toko.</p>
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
                        <th>Nama</th>
                        <th>Contact</th>
                        <th>Phone</th>
                        {{-- <th>Address</th> --}}
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse ($this->locations as $location)
                        <tr>
                            <td>{{ $location->nama_toko }}</td>
                            <td>{{ $location->contact_person }}</td>
                            <td>{{ $location->phone_number }}</td>
                            {{-- <td>{{ $location->alamat_toko }}</td> --}}
                            <td>
                                <button wire:click="delete({{ $location->id }})" class="btn btn-sm btn-danger"><i
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
        <form wire:submit="submit">
            @csrf
            <div wire:ignore.self class="modal fade" id="create" data-bs-backdrop="static" data-bs-keyboard="false"
                tabindex="-1" aria-labelledby="eventLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div class="modal-title">
                                <p class="fs-4 m-0 p-0 fw-semibold text-dark" id="eventLabel">Tambah Lokasi Toko</p>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label for="nama_toko" class="form-label">Nama Toko</label>
                                        <input required type="text" class="form-control" id="nama_toko"
                                            wire:model.defer="nama_toko" placeholder="eg. Fantech">
                                        @error('nama_toko')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="contact_person" class="form-label">Contact Person</label>
                                        <input required type="text" class="form-control" id="contact_person"
                                            wire:model.defer="contact_person" placeholder="eg. Jhon doe">
                                        @error('contact_person')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="phone_number" class="form-label">Phone Number</label>
                                        <div class="input-group">
                                            <span class="input-group-text">+62</span>
                                            <input required type="text" id="phone_number" wire:model.defer="phone_number"
                                                class="form-control" placeholder="eg. 8**********">
                                        </div>
                                        @error('phone_number')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="alamat_toko" class="form-label">Alamat Toko</label>
                                        <textarea required class="form-control" id="alamat_toko" rows="3" wire:model.defer="alamat_toko"
                                            placeholder="eg. Lorem ipsum, dolor sit amet consectetur adipisicing elit. Magnam assumenda sapiente officia ratione consequatur quas ipsam nobis reiciendis dolorem sunt?"></textarea>
                                        @error('alamat_toko')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Gambar Toko</label>
                                        <x-input.filepond wire:model="gambar" multiple preview />
                                        @error('gambar')
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

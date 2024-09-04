<div class="container-xl flex-grow-1 container-p-y w-100">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="card-title">Exhibition</h5>
                    <p class="card-text">Data event.</p>
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
                        <th>Nama EO</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Selesai</th>
                        <th>Alamat</th>
                        <th>Lokasi Booth</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse ($this->events as $event)
                        <tr>
                            <td>{{ $event->nama_eo }}</td>
                            <td>{{ $event->tgl_mulai_event }}</td>
                            <td>{{ $event->tgl_selesai_event }}</td>
                            <td>{{ $event->alamat_event }}</td>
                            <td>{{ $event->lokasi_booth }}</td>
                            <td>
                                <button wire:click="delete('{{ $event->id }}')" class="btn btn-sm btn-danger"><i
                                        class="bx bx-trash me-1"></i>
                                    Delete</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">
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
                                    <p class="fs-4 m-0 p-0 fw-semibold text-dark" id="eventLabel">Tambah Event</p>
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label for="nama_eo" class="form-label">Nama EO</label>
                                            <input required type="text" class="form-control" id="nama_eo"
                                                wire:model.defer="nama_eo" placeholder="eg. Jhon Doe"   >
                                            @error('nama_eo')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="nama_event" class="form-label">Nama Event</label>
                                            <input required type="text" class="form-control" id="nama_event"
                                                wire:model.defer="nama_event" placeholder="eg. Laravel">
                                            @error('nama_event')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="flatpickr-date" class="form-label">Rentang Tanggal</label>
                                            <x-input.datepicker wire:model.defer="tanggal" range />
                                            @error('tanggal')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="alamat_event" class="form-label">Alamat Event</label>
                                            <textarea required class="form-control" id="alamat_event" rows="3" wire:model.defer="alamat_event"
                                                placeholder="eg. Lorem ipsum, dolor sit amet consectetur adipisicing elit. Magnam assumenda sapiente officia ratione consequatur quas ipsam nobis reiciendis dolorem sunt?"></textarea>
                                            @error('alamat_event')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="lokasi_booth" class="form-label">Lokasi Booth</label>
                                            <input required type="text" class="form-control" id="lokasi_booth"
                                                wire:model.defer="lokasi_booth" placeholder="eg. Blok 3">
                                            @error('lokasi_booth')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Banner Event</label>
                                            <x-input.filepond wire:model="banner" maxFiles="2" multiple preview />
                                            @error('banner')
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

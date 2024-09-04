<div class="container-xl flex-grow-1 container-p-y w-100">
    <form wire:submit="submit">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Pengirim</h5>
                <p class="card-text">Data Pengirim.</p>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="mb-3 mb-md-0">
                            <x-input.select2 wire:model="nama_pengirim" :data="$this->pengirims" dataKey="kode_pengirim"
                                dataLabel="nama_pengirim" label="Pengirim" :key="$this->pengirims->pluck('id')->join('-')" customValue />
                            @error('nama_pengirim')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div>
                            <label for="telp_pengirim" class="form-label">Telp Pengirim</label>
                            <input required type="text" id="telp_pengirim" wire:model.live="telp_pengirim"
                                class="form-control" placeholder="eg. 08**********"
                                {{ $this->telp_pengirim_enable ? '' : 'disabled' }}>
                            @error('telp_pengirim')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mt-5">
            <div class="card-body">
                <h5 class="card-title">Penerima</h5>
                <p class="card-text">Data Penerima.</p>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="mb-3">
                            <x-input.select2 wire:model="nama_penerima" :data="$this->penerimas" dataKey="kode_penerima"
                                dataLabel="nama_penerima" label="Penerima" :key="$this->penerimas->pluck('id')->join('-')" customValue />
                            @error('nama_penerima')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="mb-3">
                            <label for="telp_penerima" class="form-label">Telp Penerima</label>
                            <input required type="text" id="telp_penerima" wire:model.live="telp_penerima"
                                class="form-control" placeholder="eg. 08**********"
                                {{ $this->telp_penerima_enable ? '' : 'disabled' }}>
                            @error('telp_penerima')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="mb-3">
                            <label for="alamat_penerima_1" class="form-label">Alamat #1</label>
                            <div class="input-group input-group-merge">
                                <input type="text" class="form-control" placeholder="eg. Jl. Sidoarjo, No 09"
                                    wire:model.live="alamat_penerima_1" id="alamat_penerima_1" maxlength="30"
                                    {{ $this->alamat_penerima_1_enable ? '' : 'disabled' }}>
                                <span class="input-group-text" id="basic-addon33">{{ 30 - strlen($alamat_penerima_1) }}
                                    left.</span>
                            </div>
                            @error('alamat_penerima_1')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="mb-3">
                            <label for="alamat_penerima_2" class="form-label">Alamat #2</label>
                            <div class="input-group input-group-merge">
                                <input type="text" class="form-control" placeholder="eg. Jl. Sidoarjo, No 09"
                                    wire:model.live="alamat_penerima_2" id="alamat_penerima_2" maxlength="30"
                                    {{ $this->alamat_penerima_2_enable ? '' : 'disabled' }}>
                                <span class="input-group-text" id="basic-addon33">{{ 30 - strlen($alamat_penerima_2) }}
                                    left.</span>
                            </div>
                            @error('alamat_penerima_2')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="mb-3 mb-md-0">
                            <label for="alamat_penerima_3" class="form-label">Alamat #3</label>
                            <div class="input-group input-group-merge">
                                <input type="text" class="form-control" placeholder="eg. Jl. Sidoarjo, No 09"
                                    wire:model.live="alamat_penerima_3" id="alamat_penerima_3" maxlength="30"
                                    {{ $this->alamat_penerima_3_enable ? '' : 'disabled' }}>
                                <span class="input-group-text" id="basic-addon33">{{ 30 - strlen($alamat_penerima_3) }}
                                    left.</span>
                            </div>
                            @error('alamat_penerima_3')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div>
                            <label for="alamat_penerima_4" class="form-label">Alamat #4</label>
                            <div class="input-group input-group-merge">
                                <input type="text" class="form-control" placeholder="eg. Jl. Sidoarjo, No 09"
                                    wire:model.live="alamat_penerima_4" id="alamat_penerima_4" maxlength="50"
                                    {{ $this->alamat_penerima_4_enable ? '' : 'disabled' }}>
                                <span class="input-group-text" id="basic-addon33">{{ 50 - strlen($alamat_penerima_4) }}
                                    left.</span>
                            </div>
                            @error('alamat_penerima_4')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="mb-3">
                            <label for="kode_pos_penerima" class="form-label">Kode Pos</label>
                            <input required type="text" class="form-control" id="kode_pos_penerima"
                                wire:model.live="kode_pos_penerima" placeholder="eg. 62132"
                                {{ $this->kode_pos_penerima_enable ? '' : 'disabled' }}>
                            @error('kode_pos_penerima')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mt-5">
            <div class="card-body">
                <h5 class="card-title">Informasi Tambahan</h5>
                <p class="card-text">Data Informasi Tambahan.</p>
                <div class="row">
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="catatan" class="form-label">Catatan</label>
                            <textarea class="form-control" id="catatan" rows="3" wire:model.live="catatan"
                                placeholder="eg. Lorem ipsum, dolor sit amet consectetur adipisicing elit. Magnam assumenda sapiente officia ratione consequatur quas ipsam nobis reiciendis dolorem sunt?"></textarea>
                            @error('catatan')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-3">
                            <div class="form-check">
                                <input type="checkbox" wire:model.live="simpandb" class="form-check-input"
                                    id="dbs">
                                <label class="form-check-label" for="dbs">
                                    Simpan penerima ke database
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-3 mb-md-0">
                            <button class="btn btn-primary" type="submit">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
    </form>
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
        });
    </script>
@endscript

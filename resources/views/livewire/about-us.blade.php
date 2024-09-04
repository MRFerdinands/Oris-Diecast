<div class="container-xl flex-grow-1 container-p-y w-100">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">About Us</h5>
            <p class="card-text">Edit halaman about us.</p>

            <form wire:submit="submit">
                <div class="row">
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="contact_person" class="form-label">Contact Person</label>
                            <input required type="text" class="form-control" id="contact_person"
                                wire:model.defer="contact_person" placeholder="eg. Jhon doe">
                            @error('contact_person')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
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
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input required type="email" class="form-control" id="email" wire:model.defer="email"
                                placeholder="eg. example@example.com">
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea required class="form-control" id="description" rows="5" wire:model.defer="description"
                                placeholder="eg. Lorem ipsum, dolor sit amet consectetur adipisicing elit. Magnam assumenda sapiente officia ratione consequatur quas ipsam nobis reiciendis dolorem sunt?"></textarea>
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="">
                            <button class="btn btn-primary w-100" type="submit">Simpan</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
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
        })
    </script>
@endscript

@assets
    <link rel="stylesheet" href="{{ asset('assets/css/pages/page-auth.css') }}">
    <script src="{{ asset('assets/js/pages/page-auth.js') }}"></script>
@endassets

<div>
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <!-- Register -->
                <div class="card">
                    <div class="card-body">
                        <!-- Logo -->
                        <div class="app-brand justify-content-center">
                            <a href="index.html" class="app-brand-link gap-2">
                                <span class="app-brand-logo demo">
                                    <img src="{{ asset('storage/img/logo.png') }}" class="img-fluid" width="70"
                                        alt="">
                                </span>
                                <span class="app-brand-text demo text-primary fw-bold fs-4">Dashboard</span>
                            </a>
                        </div>
                        <!-- /Logo -->
                        {{-- <h4 class="mb-2">Dashboard Oris-Diecast</h4>
                        <p class="mb-4">Login menggunakan akun anda.</p> --}}

                        <form id="formAuthentication" wire:submit="login" class="mb-3">
                            <div class="mb-3">
                                <label for="name" class="form-label">Username</label>
                                <input type="text" class="form-control" id="name" wire:model.defer="name"
                                    placeholder="Masukkan username" autofocus>
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3 form-password-toggle">
                                <label class="form-label" for="password">Password</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" class="form-control"
                                        wire:model.defer="password"
                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                        aria-describedby="password" />
                                    <span class="input-group-text cursor-pointer"><i id="shows"
                                            class="bx bx-hide"></i></span>
                                </div>
                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-primary d-grid w-100" type="submit">Sign in</button>
                            </div>
                            @error('error')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </form>
                    </div>
                </div>
                <!-- /Register -->
            </div>
        </div>
    </div>
</div>

@script
    <script>
        $(document).ready(function() {
            $('#shows').on('click', function() {
                if ($('#password').attr('type') == 'password') {
                    $('#password').attr('type', 'text');
                    $('#shows').attr('class', 'bx bx-show');
                } else {
                    $('#password').attr('type', 'password');
                    $('#shows').attr('class', 'bx bx-hide');
                }
            })
        });
    </script>
@endscript

@assets
    <link rel="stylesheet" href="{{ asset('assets/css/pages/home.css') }}">
@endassets

<div>
    <x-navbar />

    <div id="home" class="d-flex align-items-center min-vh-100 bg-primary"
        style="background-image: url({{ asset('storage/img/bghero.svg') }}); background-size: cover; background-position: center; background-repeat: no-repeat">
        <header class=" container-xl py-5">
            <div class="row align-items-center">
                <div data-aos="fade-right" class="col-12 col-md-6 order-2 order-md-1">
                    <h1 class="text-white fw-bold m-0 p-0 mb-1">Oris Diecast</h1>
                    <p class="m-0 p-0 text-white mb-2">
                        {{ $this->aboutus[0]['description'] }}
                    </p>
                    <div class="mt-3 text-white">
                        <p class="m-0 p-0 mb-1 fw-bold">Contact Person</p>
                        <p class="m-0 p-0">{{ $this->aboutus[0]['contact_person'] }}</p>
                        <div class="d-flex gap-2">
                            <div class="d-flex align-item-center">
                                <i class='bx bxs-phone me-1'></i>
                                <a class="link-light"
                                    href="https://wa.me/{{ '+62' . $this->aboutus[0]['phone_number'] }}"
                                    target="_blank">
                                    <p class="m-0 p-0">{{ '+62' . $this->aboutus[0]['phone_number'] }}</p>
                                </a>
                            </div>
                            <div class="d-flex align-item-center">
                                <i class='bx bx-envelope me-1'></i>
                                <a class="link-light" href="mailto:{{ $this->aboutus[0]['email'] }}" target="_blank">
                                    <p class="m-0 p-0">{{ $this->aboutus[0]['email'] }}</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 order-1">
                    <div data-aos="zoom-out" class="text-center">
                        <img src="{{ asset('storage/img/hero.png') }}"
                            style="filter: drop-shadow(0 0 20px rgba(0, 0, 0, 0.5));" width="400" alt="">
                    </div>
                </div>
            </div>
        </header>
    </div>

    <div id="toko" class="d-flex align-items-center min-vh-100">
        <section class="container-xl my-5">
            <h2 class="text-center text-primary fw-semibold">Toko Kami</h2>
            <div class="row g-3" data-masonry='{"percentPosition": true }'>
                @php
                    $no = 1;
                @endphp
                @foreach ($this->storelocations as $storelocation)
                    @php
                        $no++;
                    @endphp
                    <div class="{{ $storelocation->count() > 1 ? 'col-12 col-md-6' : 'col-12' }}">
                        <div data-aos="{{ $no % 2 == 0 ? 'fade-up-right' : 'fade-up-left' }}" class="card shadow-lg">
                            <div class="row g-0 rounded bg-primary overflow-hidden store-card"
                                style="background-image: url({{ asset('storage/img/tokobg.svg') }}); background-size: cover; background-position: center; background-repeat: no-repeat">
                                <div class="{{ $storelocation->count() > 1 ? 'col-8' : 'col-9' }}">
                                    <div class="p-3 text-white d-flex flex-column justify-content-between h-100">
                                        <div>
                                            <h5 class="card-title fw-bold text-white">{{ $storelocation->nama_toko }}
                                            </h5>
                                            <p class="card-text">
                                                {{ $storelocation->alamat_toko }}
                                            </p>
                                        </div>
                                        <div>
                                            <div class="d-flex align-items-center mt-2 mb-2">
                                                <i class='bx bxs-user-circle me-1'></i>
                                                <p class="m-0 p-0">{{ $storelocation->contact_person }}</p>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <i class='bx bxs-phone me-1'></i>
                                                <p class="m-0 p-0">{{ $storelocation->phone_number }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="px-0 {{ $storelocation->count() > 1 ? 'col-4' : 'col-3' }}">
                                    <div id="storeImageCarousel"
                                        class="carousel slide carousel-fade store-image-container w-100"
                                        data-bs-ride="carousel" data-bs-interval="3000">
                                        <div class="carousel-inner h-100">
                                            @if ($storelocation->gambar_toko_1)
                                                <div class="carousel-item active h-100">
                                                    <img src="{{ asset('storage/img/store/' . $storelocation->gambar_toko_1) }}"
                                                        class="bg-secondary store-image" alt="Store Logo 1">
                                                </div>
                                            @endif
                                            @if ($storelocation->gambar_toko_2)
                                                <div class="carousel-item h-100">
                                                    <img src="{{ asset('storage/img/store/' . $storelocation->gambar_toko_2) }}"
                                                        class="bg-secondary store-image" alt="Store Logo 2">
                                                </div>
                                            @endif
                                            @if ($storelocation->gambar_toko_3)
                                                <div class="carousel-item h-100">
                                                    <img src="{{ asset('storage/img/store/' . $storelocation->gambar_toko_3) }}"
                                                        class="bg-secondary store-image" alt="Store Logo 3">
                                                </div>
                                            @endif
                                            @if ($storelocation->gambar_toko_4)
                                                <div class="carousel-item h-100">
                                                    <img src="{{ asset('storage/img/store/' . $storelocation->gambar_toko_4) }}"
                                                        class="bg-secondary store-image" alt="Store Logo 4">
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    </div>

    <div id="brand" class="d-flex align-items-center min-vh-100 bg-primary"
        style="background-image: url({{ asset('storage/img/bgbrand.svg') }}); background-size: cover; background-position: center; background-repeat: no-repeat">
        <section class="container-xl my-5">
            <h2 class="text-center text-white fw-semibold">Brand Kami</h2>
            <div class="row g-2" data-masonry='{"percentPosition": true }'>
                @php
                    $brandCount = count($this->brands);
                    $colClasses = match (true) {
                        $brandCount <= 2 => 'col-12 col-sm-6 col-md-6 col-lg-6',
                        $brandCount <= 3 => 'col-12 col-sm-6 col-md-4 col-lg-4',
                        $brandCount <= 4 => 'col-6 col-sm-6 col-md-3 col-lg-3',
                        $brandCount <= 6 => 'col-6 col-sm-4 col-md-3 col-lg-2',
                        default => 'col-6 col-sm-3 col-md-2 col-lg-2',
                    };
                @endphp
                @foreach ($this->brands as $brand)
                    <div data-aos="zoom-in-up" class="{{ $colClasses }}"
                        data-bs-target="#{{ $brand->kode_brand . $brand->id }}" data-bs-toggle="modal">
                        <div class="card image-card">
                            <div class="image-container">
                                <img src="{{ asset('storage/img/brands/logo/' . $brand->logo_brand) }}"
                                    class="card-img-top" alt="{{ 'Logo ' . $brand->nama_brand }}">
                                <div class="overlay d-flex align-items-center">
                                    <h4 class="overlay-text mb-0 p-2 fw-bold text-center">{{ $brand->nama_brand }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    </div>

    <div id="links" class="d-flex align-items-center">
        <section class="container-xl my-5">
            <h2 class="text-center text-primary fw-semibold">Tautan Lain</h2>
            <div class="card shadow-lg overflow-hidden">
                <div class="logos-container">
                    <div class="logos-track">
                        @foreach ($this->links as $link)
                            <a href="{{ $link->alamat_link }}" target="_blank" class="logo-link">
                                <div class="logo-image-container">
                                    <img src="{{ asset('storage/img/links/' . $link->gambar_link) }}"
                                        alt="{{ $link->nama_link }}" class="logo-image" />
                                </div>
                            </a>
                        @endforeach
                        @foreach ($this->links as $link)
                            <a href="{{ $link->alamat_link }}" target="_blank" class="logo-link">
                                <div class="logo-image-container">
                                    <img src="{{ asset('storage/img/links/' . $link->gambar_link) }}"
                                        alt="{{ $link->nama_link }}" class="logo-image" />
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    </div>


    <x-footer />

    @teleport('body')
        <div>
            @foreach ($this->brands as $brand)
                <div class="modal fade" id="{{ $brand->kode_brand . $brand->id }}" tabindex="-1"
                    style="display: none;" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalCenterTitle">{{ 'Produk ' . $brand->nama_brand }}</h5>
                            </div>
                            <div class="modal-body">
                                <div id="{{ $brand->kode_brand . 'Carousel' }}" class="carousel slide"
                                    data-bs-ride="carousel">
                                    <div class="carousel-inner border rounded">
                                        @if ($brand->gambar_produk_1)
                                            <div data-bs-interval="3000" class="carousel-item active">
                                                <img src="{{ asset('storage/img/brands/product/' . $brand->gambar_produk_1) }}"
                                                    class="object-fit-cover w-100" alt="...">
                                            </div>
                                        @endif
                                        @if ($brand->gambar_produk_2)
                                            <div data-bs-interval="3000" class="carousel-item">
                                                <img src="{{ asset('storage/img/brands/product/' . $brand->gambar_produk_2) }}"
                                                    class="object-fit-cover w-100" alt="...">
                                            </div>
                                        @endif
                                        @if ($brand->gambar_produk_3)
                                            <div data-bs-interval="3000" class="carousel-item">
                                                <img src="{{ asset('storage/img/brands/product/' . $brand->gambar_produk_3) }}"
                                                    class="object-fit-cover w-100" alt="...">
                                            </div>
                                        @endif
                                        @if ($brand->gambar_produk_4)
                                            <div data-bs-interval="3000" class="carousel-item">
                                                <img src="{{ asset('storage/img/brands/product/' . $brand->gambar_produk_4) }}"
                                                    class="object-fit-cover w-100" alt="...">
                                            </div>
                                        @endif
                                    </div>
                                    {{-- show only if more than 1 --}}
                                    @if ($brand->gambar_produk_2 || $brand->gambar_produk_3 || $brand->gambar_produk_4)
                                        <button class="carousel-control-prev text-dark" type="button"
                                            data-bs-target="#{{ $brand->kode_brand . 'Carousel' }}" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon " aria-hidden="true"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button class="carousel-control-next text-dark" type="button"
                                            data-bs-target="#{{ $brand->kode_brand . 'Carousel' }}" data-bs-slide="next">
                                            <span class="carousel-control-next-icon " aria-hidden="true"></span>
                                            <span class="visually-hidden">Next</span>
                                        </button>
                                    @endif
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-label-secondary"
                                    data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            @if ($this->events)
                <div class="modal fade" id="event" data-bs-backdrop="static" data-bs-keyboard="false"
                    tabindex="-1" aria-labelledby="eventLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <div class="modal-title">
                                    <p class="fs-4 m-0 p-0 fw-semibold text-dark" id="eventLabel">
                                        {{ $this->events->nama_event }}</p>
                                    <p class="m-0 p-0">
                                        {{ Carbon\Carbon::parse($this->events->tgl_mulai_event)->locale('id')->translatedFormat('l, d M Y') }},
                                        -
                                        {{ Carbon\Carbon::parse($this->events->tgl_selesai_event)->locale('id')->translatedFormat('l, d M Y') }}
                                    </p>
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="d-flex flex-column justify-content-center align-items-center">
                                    <div id="carouselExampleIndicators" class="carousel slide border rounded">
                                        <div class="carousel-indicators">
                                            <button type="button" data-bs-target="#carouselExampleIndicators"
                                                data-bs-slide-to="0" class="active" aria-current="true"
                                                aria-label="Slide 1"></button>
                                            <button type="button" data-bs-target="#carouselExampleIndicators"
                                                data-bs-slide-to="1" aria-label="Slide 2"></button>
                                        </div>
                                        <div class="carousel-inner">
                                            <div class="carousel-item active">
                                                <img src="{{ asset('storage/img/event/' . $this->events->gambar_banner_1) }}"
                                                    class="d-block w-100 rounded" alt="...">
                                            </div>
                                            <div class="carousel-item">
                                                <img src="{{ asset('storage/img/event/' . $this->events->gambar_banner_2) }}"
                                                    class="d-block w-100 rounded" alt="...">
                                            </div>
                                        </div>
                                        <button class="carousel-control-prev" type="button"
                                            data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button class="carousel-control-next" type="button"
                                            data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Next</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer justify-content-start">
                                <div class="text-dark">
                                    <div class="d-flex align-items-center mb-2">
                                        <i class='bx bx-group text-primary me-1'></i>
                                        <p class="m-0 p-0 fw-bold">{{ $this->events->nama_eo }}</p>
                                    </div>
                                    <div class="d-flex align-items-center mb-2">
                                        <i class='bx bx-map-alt text-primary me-1'></i>
                                        <p class="m-0 p-0 fw-bold">{{ $this->events->alamat_event }}</p>
                                    </div>
                                    <div class="d-flex align-items-center mb-2">
                                        <i class='bx bxs-map-pin text-primary me-1'></i>
                                        <p class="m-0 p-0 fw-bold">{{ $this->events->lokasi_booth }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    @endteleport
</div>

@script
    @if ($this->events)
        <script>
            $(document).ready(function() {
                $('#event').modal('show');
            });
        </script>
    @endif
@endscript

@extends('layouts.client')
@section('title', 'Hotel')
@section('active', '/hotel')
@section('content')
    <div class="hero-wrap js-fullheight" style="background-image: url({{ asset('assets/images/bg_4.jpg') }});">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-center"
                data-scrollax-parent="true">
                <div class="col-md-9 ftco-animate text-center" data-scrollax=" properties: { translateY: '70%' }">
                    <p class="breadcrumbs" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><span
                            class="mr-2"><a href="index.html">Home</a></span> <span>Hotel</span></p>
                    <h1 class="mb-3 bread" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">Destination</h1>
                </div>
            </div>
        </div>
    </div>


    <section class="ftco-section ftco-degree-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 sidebar ftco-animate">
                    <div class="sidebar-wrap bg-light ftco-animate">
                        <h3 class="heading mb-4">Tìm kiếm khách sạn</h3>
                        <form action="{{ route('client.hotel.search') }}">
                            <div class="fields">
                                <div class="form-group">
                                    <div class="select-wrap one-third">
                                        <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                        <select name="address" id="" class="form-control" placeholder="Keyword search">
                                            <option value="">Chọn điểm đến</option>
                                            <option value="">Hà nội</option>
                                            <option value="">Phú quốc</option>
                                            <option value="">Vịnh hạ long</option>
                                            <option value="">Đà lạt</option>
                                            <option value="">Nha trang</option>
                                            <option value="">Đà Nẵng</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="start_date" id="checkin_date" class="form-control"
                                        placeholder="Ngày bắt đầu">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="end_date" id="checkin_date" class="form-control"
                                        placeholder="Ngày kết thúc">
                                </div>
                                <div class="form-group">
                                    <div class="range-slider">
                                        <span>
                                            <input type="number" name="price_min" value="25000" min="0" max="1200000" />-
                                            <input type="number" name="price_max" value="50000" min="0" max="1200000" />
                                        </span>
                                        <input value="1000" min="0" max="1200000" step="500" type="range" />
                                        <input value="50000" min="0" max="1200000" step="500" type="range" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="submit" value="Tìm kiếm" class="btn btn-primary py-3 px-5">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="sidebar-wrap bg-light ftco-animate">
                        <h3 class="heading mb-4">Star Rating</h3>
                        <form method="post" class="star-rating">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">
                                    <p class="rate"><span><i class="icon-star"></i><i class="icon-star"></i><i
                                                class="icon-star"></i><i class="icon-star"></i><i
                                                class="icon-star"></i></span></p>
                                </label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">
                                    <p class="rate"><span><i class="icon-star"></i><i class="icon-star"></i><i
                                                class="icon-star"></i><i class="icon-star"></i><i
                                                class="icon-star-o"></i></span></p>
                                </label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">
                                    <p class="rate"><span><i class="icon-star"></i><i class="icon-star"></i><i
                                                class="icon-star"></i><i class="icon-star-o"></i><i
                                                class="icon-star-o"></i></span></p>
                                </label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">
                                    <p class="rate"><span><i class="icon-star"></i><i class="icon-star"></i><i
                                                class="icon-star-o"></i><i class="icon-star-o"></i><i
                                                class="icon-star-o"></i></span></p>
                                </label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">
                                    <p class="rate"><span><i class="icon-star"></i><i class="icon-star-o"></i><i
                                                class="icon-star-o"></i><i class="icon-star-o"></i><i
                                                class="icon-star-o"></i></span></p>
                                </label>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="row">
                        @foreach ($hotels as $hotel)
                            <div class="col-md-4 ftco-animate">
                                <div class="destination">
                                    <a href="{{ route('client.hotel.detail', $hotel->id) }}"
                                        class="img img-2 d-flex justify-content-center align-items-center"
                                        style="background-image: url('{{ asset('uploads/hotels/' . $hotel->image) }}');">
                                        {{-- <div class="icon d-flex justify-content-center align-items-center">
                                            <span class="icon-search2"></span>
                                        </div> --}}
                                    </a>
                                    <div class="text p-3">
                                        <div class="d-flex">
                                            <div class="one">
                                                <h3><a
                                                        href="{{ route('client.hotel.detail', $hotel->id) }}">{{ $hotel->name }}</a>
                                                </h3>
                                                <p class="rate">
                                                    <i class="icon-star"></i>
                                                    <i class="icon-star"></i>
                                                    <i class="icon-star"></i>
                                                    <i class="icon-star"></i>
                                                    <i class="icon-star-o"></i>
                                                    <span>8 Rating</span>
                                                </p>
                                            </div>
                                            <div class="two">
                                                <span class="price">{{ $hotel->price }}</span>
                                            </div>
                                        </div>
                                        <p>{{ $hotel->title }}</p>
                                        <hr>
                                        <p class="bottom-area d-flex">
                                            <span><i class="icon-map-o"></i> {{ $hotel->address }}</span>
                                            <span class="ml-auto"><a href="{{ route('client.hotel.detail', $hotel->id) }}">Chi
                                                    tiết</a></span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="row mt-5">
                        <div class="col text-center">
                            <div class="block-27">
                                <ul>
                                    {{-- Nút quay lại --}}
                                    @if ($hotels->onFirstPage())
                                        <li class="disabled"><span>&lt;</span></li>
                                    @else
                                        <li><a href="{{ $hotels->previousPageUrl() }}">&lt;</a></li>
                                    @endif

                                    {{-- Danh sách các số trang --}}
                                    @foreach ($hotels->getUrlRange(1, $hotels->lastPage()) as $page => $url)
                                        <li class="{{ ($page == $hotels->currentPage()) ? 'active' : '' }}">
                                            <a href="{{ $url }}">{{ $page }}</a>
                                        </li>
                                    @endforeach

                                    {{-- Nút tiếp theo --}}
                                    @if ($hotels->hasMorePages())
                                        <li><a href="{{ $hotels->nextPageUrl() }}">&gt;</a></li>
                                    @else
                                        <li class="disabled"><span>&gt;</span></li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div> <!-- .col-md-8 -->
            </div>
        </div>
    </section> <!-- .section -->

    <!-- loader -->
    <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
            <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
            <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10"
                stroke="#F96D00" />
        </svg></div>
@endsection
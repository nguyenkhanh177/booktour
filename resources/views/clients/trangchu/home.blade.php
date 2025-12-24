@extends('layouts.client')
@section('title', 'Trang chủ')
@section('active', '/')
@section('content')
	<div class="hero-wrap js-fullheight" style="background-image: url('{{ asset('assets/images/bg_1.jpg') }}');">
		<div class="overlay"></div>
		<div class="container">
			<div class="row no-gutters slider-text js-fullheight align-items-center justify-content-start"
				data-scrollax-parent="true">
				<div class="col-md-9 ftco-animate" data-scrollax=" properties: { translateY: '70%' }">
					<h1 class="mb-4" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><strong>Khám phá
							<br></strong>Đất nước tuyệt vời của bạn</h1>
					<div class="block-17 my-4">
						<form action="" method="GET" class="d-block d-flex">
							<div class="fields d-block d-flex">
								<div class="select-wrap one-third">
									<div class="icon"><span class="ion-ios-arrow-down"></span></div>
									<select name="location" id="location" class="form-control">
										<option value="">Chọn điểm đến</option>
										<option value="">Hà nội</option>
										<option value="">Phú quốc</option>
										<option value="">Vịnh hạ long</option>
										<option value="">Đà lạt</option>
										<option value="">Nha trang</option>
										<option value="">Đà Nẵng</option>
									</select>
								</div>

								<div class="textfield-search one-third">
									<input type="date" name="start_date" class="form-control" placeholder="Ngày đi">
								</div>

								<div class="textfield-search one-third">
									<input type="date" name="end_date" class="form-control" placeholder="Ngày về">
								</div>
							</div>

							<input type="submit" class="search-submit btn btn-primary" value="Tìm kiếm">
						</form>
					</div>
					<p class="browse d-md-flex">
						<span class="d-flex justify-content-md-center align-items-md-center"><a
								href="{{route('client.restaurant')}}"><i class="flaticon-fork"></i>Restaurant</a></span>
						<span class="d-flex justify-content-md-center align-items-md-center"><a
								href="{{route('client.hotel')}}"><i class="flaticon-hotel"></i>Hotel</a></span>
						<span class="d-flex justify-content-md-center align-items-md-center"><a
								href="{{route('client.car')}}"><i class="flaticon-meeting-point"></i>Car</a></span>
					</p>
				</div>
			</div>
		</div>
	</div>

	<section class="ftco-section bg-light">
		<div class="container">
			<div class="row justify-content-start mb-5 pb-3">
				<div class="col-md-7 heading-section ftco-animate">
					<span class="subheading">Tour</span>
					<h2 class="mb-4"><strong>Tour</strong> Nổi bật</h2>
				</div>
			</div>
		</div>
		<div class="container-fluid">
			<div class="row">
				@foreach($tours->take(4) as $tour)
					<div class="col-sm col-md-6 col-lg-3 ftco-animate">
						<div class="destination">
							<a href="#" class="img img-2 d-flex justify-content-center align-items-center"
								style="background-image: url('{{ asset('uploads/tours/' . $tour->image) }}');">
								{{-- <div class="icon d-flex justify-content-center align-items-center">
									<span class="icon-search2"></span>
								</div> --}}
							</a>
							<div class="text p-3">
								<div class="d-flex">
									<div class="one">
										<h3><a href="#">{{$tour->name}}</a></h3>
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
										<span class="price">{{number_format($tour->price)}} VNĐ</span>
									</div>
								</div>
								<p>{{$tour->title}}</p>
								<p class="days"><span>2 days 3 nights</span></p>
								<hr>
								<p class="bottom-area d-flex">
									<span><i class="icon-map-o"></i> San Franciso, CA</span>
									<span class="ml-auto"><a href="#">Discover</a></span>
								</p>
							</div>
						</div>
					</div>
				@endforeach
			</div>
		</div>
	</section>

	<section class="ftco-section ftco-counter img" id="section-counter" style="background-image: url(images/bg_1.jpg);">
		<div class="container">
			<div class="row justify-content-center mb-5 pb-3">
			</div>
		</div>
	</section>
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-start mb-5 pb-3">
				<div class="col-md-7 heading-section ftco-animate">
					<span class="subheading">Hotels</span>
					<h2 class="mb-4"><strong>Hotels</strong> Nổi bật</h2>
				</div>
			</div>
		</div>
		<div class="container-fluid">
			<div class="row">
				@foreach ($hotels->take(4) as $hotel)
					<div class="col-sm col-md-6 col-lg ftco-animate">
						<div class="destination">
							<a href="{{route('client.hotel.detail', $hotel->id)}}"
								class="img img-2 d-flex justify-content-center align-items-center"
								style="background-image: url({{asset('/uploads/hotels/' . $hotel->image)}});">
							</a>
							<div class="text p-3">
								<div class="d-flex">
									<div class="one">
										<h3><a href="{{route('client.hotel.detail', $hotel->id)}}">{{$hotel->name}}</a></h3>
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
										<span class="price per-price">{{number_format($hotel->price)}}
											VNĐ<br><small>/night</small></span>
									</div>
								</div>
								<p>{{$hotel->title}}</p>
								<hr>
								<p class="bottom-area d-flex">
									<span><i class="icon-map-o"></i> {{$hotel->address}}</span>
									<span class="ml-auto"><a href="#">Book Now</a></span>
								</p>
							</div>
						</div>
					</div>
				@endforeach
			</div>
		</div>
	</section>
	<section class="ftco-section ftco-counter img" id="section-counter" style="background-image: url(images/bg_1.jpg);">
		<div class="container">
			<div class="row justify-content-center mb-5 pb-3">
			</div>
		</div>
	</section>
	<section class="ftco-section">
		<div class="container-fluid">
			<div class="container">
				<div class="row justify-content-start mb-5 pb-3">
					<div class="col-md-7 heading-section ftco-animate">
						<span class="subheading">Nhà hàng</span>
						<h2 class="mb-4"><strong>Nhà hàng</strong> Nổi bật</h2>
					</div>
				</div>
			</div>
			<div class="row">
				@foreach ($restaurants->take(4) as $restaurant)
					<div class="col-sm col-md-6 col-lg-3 ftco-animate">
						<div class="destination">
							<a href="{{route('client.restaurant.detail', $restaurant->id)}}"
								class="img img-2 d-flex justify-content-center align-items-center"
								style="background-image: url({{asset('/uploads/restaurants/' . $restaurant->image)}});">
							</a>
							<div class="text p-3">
								<div class="d-flex">
									<div class="one">
										<h3><a
												href="{{route('client.restaurant.detail', $restaurant->id)}}">{{$restaurant->name}}</a>
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
										<span class="price per-price">{{number_format($restaurant->price)}}
											VNĐ<br><small>/night</small></span>
									</div>
								</div>
								<p>{{$restaurant->title}}</p>
								<hr>
								<p class="bottom-area d-flex">
									<span><i class="icon-map-o"></i> {{$restaurant->address}}</span>
									<span class="ml-auto"><a href="#">Book Now</a></span>
								</p>
							</div>
						</div>
					</div>
				@endforeach
			</div>
		</div>
	</section>
	<section class="ftco-section ftco-counter img" id="section-counter" style="background-image: url(images/bg_1.jpg);">
		<div class="container">
			<div class="row justify-content-center mb-5 pb-3">
			</div>
		</div>
	</section>
	<section class="ftco-section">
		<div class="container-fluid">
			<div class="container">
				<div class="row justify-content-start mb-5 pb-3">
					<div class="col-md-7 heading-section ftco-animate">
						<span class="subheading">Xe</span>
						<h2 class="mb-4"><strong>Xe</strong> Nổi bật</h2>
					</div>
				</div>
			</div>
			<div class="row">
				@foreach ($cars->take(4) as $car)
					<div class="col-sm col-md-6 col-lg-3 ftco-animate">
						<div class="destination">
							<a href="{{route('client.car.detail', $car->id)}}"
								class="img img-2 d-flex justify-content-center align-items-center"
								style="background-image: url({{asset('/uploads/cars/' . $car->image)}});">
							</a>
							<div class="text p-3">
								<div class="d-flex">
									<div class="one">
										<h3><a href="{{route('client.car.detail', $car->id)}}">{{$car->name}}</a>
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
										<span class="price per-price">{{number_format($car->price)}}
											VNĐ<br><small>/night</small></span>
									</div>
								</div>
								<p>{{$car->title}}</p>
								<hr>
								<p class="bottom-area d-flex">
									<span><i class="icon-map-o"></i> {{$car->address}}</span>
									<span class="ml-auto"><a href="#">Book Now</a></span>
								</p>
							</div>
						</div>
					</div>
				@endforeach
			</div>
		</div>
	</section>

	<!-- loader -->
	<div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
			<circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
			<circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10"
				stroke="#F96D00" />
		</svg></div>

@endsection
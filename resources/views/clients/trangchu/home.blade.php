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
					<h1 class="mb-4" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><strong>Explore
							<br></strong> your amazing city</h1>
					<p data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">Find great places to stay, eat, shop,
						or visit from local experts</p>
					<div class="block-17 my-4">
						<form action="" method="post" class="d-block d-flex">
							<div class="fields d-block d-flex">
								<div class="textfield-search one-third">
									<input type="text" class="form-control" placeholder="Ex: food, service, hotel">
								</div>
								<div class="select-wrap one-third">
									<div class="icon"><span class="ion-ios-arrow-down"></span></div>
									<select name="" id="" class="form-control" placeholder="Keyword search">
										<option value="">Where</option>
										<option value="">San Francisco USA</option>
										<option value="">Berlin Germany</option>
										<option value="">Lodon United Kingdom</option>
										<option value="">Paris Italy</option>
									</select>
								</div>
							</div>
							<input type="submit" class="search-submit btn btn-primary" value="Search">
						</form>
					</div>
					<p>Or browse the highlights</p>
					<p class="browse d-md-flex">
						<span class="d-flex justify-content-md-center align-items-md-center"><a href="#"><i
									class="flaticon-fork"></i>Restaurant</a></span>
						<span class="d-flex justify-content-md-center align-items-md-center"><a href="#"><i
									class="flaticon-hotel"></i>Hotel</a></span>
						<span class="d-flex justify-content-md-center align-items-md-center"><a href="#"><i
									class="flaticon-meeting-point"></i>Places</a></span>
						<span class="d-flex justify-content-md-center align-items-md-	center"><a href="#"><i
									class="flaticon-shopping-bag"></i>Shopping</a></span>
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
				@foreach($tours as $tour)
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
				<div class="col-md-7 text-center heading-section heading-section-white ftco-animate">
					<h2 class="mb-4">Some fun facts</h2>
					<span class="subheading">More than 100,000 websites hosted</span>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-10">
					<div class="row">
						<div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
							<div class="block-18 text-center">
								<div class="text">
									<strong class="number" data-number="100000">0</strong>
									<span>Happy Customers</span>
								</div>
							</div>
						</div>
						<div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
							<div class="block-18 text-center">
								<div class="text">
									<strong class="number" data-number="40000">0</strong>
									<span>Destination Places</span>
								</div>
							</div>
						</div>
						<div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
							<div class="block-18 text-center">
								<div class="text">
									<strong class="number" data-number="87000">0</strong>
									<span>Hotels</span>
								</div>
							</div>
						</div>
						<div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
							<div class="block-18 text-center">
								<div class="text">
									<strong class="number" data-number="56400">0</strong>
									<span>Restaurant</span>
								</div>
							</div>
						</div>
					</div>
				</div>
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
				@foreach ($hotels as $hotel)
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

	<section class="ftco-section testimony-section bg-light">
		<div class="container">
			<div class="row justify-content-start">
				<div class="col-md-5 heading-section ftco-animate">
					<span class="subheading">Best Directory Website</span>
					<h2 class="mb-4 pb-3"><strong>Why</strong> Choose Us?</h2>
					<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live
						the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large
						language ocean.</p>
					<p>Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic
						life.</p>
					<p><a href="#" class="btn btn-primary btn-outline-primary mt-4 px-4 py-3">Read more</a></p>
				</div>
				<div class="col-md-1"></div>
				<div class="col-md-6 heading-section ftco-animate">
					<span class="subheading">Testimony</span>
					<h2 class="mb-4 pb-3"><strong>Our</strong> Guests Says</h2>
					<div class="row ftco-animate">
						<div class="col-md-12">
							<div class="carousel-testimony owl-carousel">
								<div class="item">
									<div class="testimony-wrap d-flex">
										<div class="user-img mb-5" style="background-image: url(images/person_1.jpg)">
											<span class="quote d-flex align-items-center justify-content-center">
												<i class="icon-quote-left"></i>
											</span>
										</div>
										<div class="text ml-md-4">
											<p class="mb-5">Far far away, behind the word mountains, far from the countries
												Vokalia and Consonantia, there live the blind texts.</p>
											<p class="name">Dennis Green</p>
											<span class="position">Guest from italy</span>
										</div>
									</div>
								</div>
								<div class="item">
									<div class="testimony-wrap d-flex">
										<div class="user-img mb-5" style="background-image: url(images/person_2.jpg)">
											<span class="quote d-flex align-items-center justify-content-center">
												<i class="icon-quote-left"></i>
											</span>
										</div>
										<div class="text ml-md-4">
											<p class="mb-5">Far far away, behind the word mountains, far from the countries
												Vokalia and Consonantia, there live the blind texts.</p>
											<p class="name">Dennis Green</p>
											<span class="position">Guest from London</span>
										</div>
									</div>
								</div>
								<div class="item">
									<div class="testimony-wrap d-flex">
										<div class="user-img mb-5" style="background-image: url(images/person_3.jpg)">
											<span class="quote d-flex align-items-center justify-content-center">
												<i class="icon-quote-left"></i>
											</span>
										</div>
										<div class="text ml-md-4">
											<p class="mb-5">Far far away, behind the word mountains, far from the countries
												Vokalia and Consonantia, there live the blind texts.</p>
											<p class="name">Dennis Green</p>
											<span class="position">Guest from Philippines</span>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-start mb-5 pb-3">
				<div class="col-md-7 heading-section ftco-animate">
					<span class="subheading">Special Offers</span>
					<h2 class="mb-4"><strong>Popular</strong> Restaurants</h2>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 col-lg-3 ftco-animate">
					<div class="destination">
						<a href="#" class="img img-2 d-flex justify-content-center align-items-center"
							style="background-image: url(images/restaurant-1.jpg);">
							<div class="icon d-flex justify-content-center align-items-center">
								<span class="icon-search2"></span>
							</div>
						</a>
						<div class="text p-3">
							<h3><a href="#">Luxury Restaurant</a></h3>
							<p class="rate">
								<i class="icon-star"></i>
								<i class="icon-star"></i>
								<i class="icon-star"></i>
								<i class="icon-star"></i>
								<i class="icon-star-o"></i>
								<span>8 Rating</span>
							</p>
							<p>Far far away, behind the word mountains, far from the countries</p>
							<hr>
							<p class="bottom-area d-flex">
								<span><i class="icon-map-o"></i> San Franciso, CA</span>
								<span class="ml-auto"><a href="#">Discover</a></span>
							</p>
						</div>
					</div>
				</div>
				<div class="col-md-6 col-lg-3 ftco-animate">
					<div class="destination">
						<a href="#" class="img img-2 d-flex justify-content-center align-items-center"
							style="background-image: url(images/restaurant-2.jpg);">
							<div class="icon d-flex justify-content-center align-items-center">
								<span class="icon-search2"></span>
							</div>
						</a>
						<div class="text p-3">
							<h3><a href="#">Luxury Restaurant</a></h3>
							<p class="rate">
								<i class="icon-star"></i>
								<i class="icon-star"></i>
								<i class="icon-star"></i>
								<i class="icon-star"></i>
								<i class="icon-star-o"></i>
								<span>8 Rating</span>
							</p>
							<p>Far far away, behind the word mountains, far from the countries</p>
							<hr>
							<p class="bottom-area d-flex">
								<span><i class="icon-map-o"></i> San Franciso, CA</span>
								<span class="ml-auto"><a href="#">Book Now</a></span>
							</p>
						</div>
					</div>
				</div>
				<div class="col-md-6 col-lg-3 ftco-animate">
					<div class="destination">
						<a href="#" class="img img-2 d-flex justify-content-center align-items-center"
							style="background-image: url(images/restaurant-3.jpg);">
							<div class="icon d-flex justify-content-center align-items-center">
								<span class="icon-search2"></span>
							</div>
						</a>
						<div class="text p-3">
							<h3><a href="#">Luxury Restaurant</a></h3>
							<p class="rate">
								<i class="icon-star"></i>
								<i class="icon-star"></i>
								<i class="icon-star"></i>
								<i class="icon-star"></i>
								<i class="icon-star-o"></i>
								<span>8 Rating</span>
							</p>
							<p>Far far away, behind the word mountains, far from the countries</p>
							<hr>
							<p class="bottom-area d-flex">
								<span><i class="icon-map-o"></i> San Franciso, CA</span>
								<span class="ml-auto"><a href="#">Book Now</a></span>
							</p>
						</div>
					</div>
				</div>
				<div class="col-md-6 col-lg-3 ftco-animate">
					<div class="destination">
						<a href="#" class="img img-2 d-flex justify-content-center align-items-center"
							style="background-image: url(images/restaurant-4.jpg);">
							<div class="icon d-flex justify-content-center align-items-center">
								<span class="icon-search2"></span>
							</div>
						</a>
						<div class="text p-3">
							<h3><a href="#">Luxury Restaurant</a></h3>
							<p class="rate">
								<i class="icon-star"></i>
								<i class="icon-star"></i>
								<i class="icon-star"></i>
								<i class="icon-star"></i>
								<i class="icon-star-o"></i>
								<span>8 Rating</span>
							</p>
							<p>Far far away, behind the word mountains, far from the countries</p>
							<hr>
							<p class="bottom-area d-flex">
								<span><i class="icon-map-o"></i> San Franciso, CA</span>
								<span class="ml-auto"><a href="#">Book Now</a></span>
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="ftco-section bg-light">
		<div class="container">
			<div class="row justify-content-start mb-5 pb-3">
				<div class="col-md-7 heading-section ftco-animate">
					<span class="subheading">Recent Blog</span>
					<h2><strong>Tips</strong> &amp; Articles</h2>
				</div>
			</div>
			<div class="row d-flex">
				<div class="col-md-3 d-flex ftco-animate">
					<div class="blog-entry align-self-stretch">
						<a href="blog-single.html" class="block-20" style="background-image: url('images/image_1.jpg');">
						</a>
						<div class="text p-4 d-block">
							<span class="tag">Tips, Travel</span>
							<h3 class="heading mt-3"><a href="#">8 Best homestay in Philippines that you don't miss out</a>
							</h3>
							<div class="meta mb-3">
								<div><a href="#">August 12, 2018</a></div>
								<div><a href="#">Admin</a></div>
								<div><a href="#" class="meta-chat"><span class="icon-chat"></span> 3</a></div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-3 d-flex ftco-animate">
					<div class="blog-entry align-self-stretch">
						<a href="blog-single.html" class="block-20" style="background-image: url('images/image_2.jpg');">
						</a>
						<div class="text p-4">
							<span class="tag">Culture</span>
							<h3 class="heading mt-3"><a href="#">Even the all-powerful Pointing has no control about the
									blind texts</a></h3>
							<div class="meta mb-3">
								<div><a href="#">August 12, 2018</a></div>
								<div><a href="#">Admin</a></div>
								<div><a href="#" class="meta-chat"><span class="icon-chat"></span> 3</a></div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-3 d-flex ftco-animate">
					<div class="blog-entry align-self-stretch">
						<a href="blog-single.html" class="block-20" style="background-image: url('images/image_3.jpg');">
						</a>
						<div class="text p-4">
							<span class="tag">Tips, Travel</span>
							<h3 class="heading mt-3"><a href="#">Even the all-powerful Pointing has no control about the
									blind texts</a></h3>
							<div class="meta mb-3">
								<div><a href="#">August 12, 2018</a></div>
								<div><a href="#">Admin</a></div>
								<div><a href="#" class="meta-chat"><span class="icon-chat"></span> 3</a></div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-3 d-flex ftco-animate">
					<div class="blog-entry align-self-stretch">
						<a href="blog-single.html" class="block-20" style="background-image: url('images/image_4.jpg');">
						</a>
						<div class="text p-4">
							<span class="tag">Tips, Travel</span>
							<h3 class="heading mt-3"><a href="#">Even the all-powerful Pointing has no control about the
									blind texts</a></h3>
							<div class="meta mb-3">
								<div><a href="#">August 12, 2018</a></div>
								<div><a href="#">Admin</a></div>
								<div><a href="#" class="meta-chat"><span class="icon-chat"></span> 3</a></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="ftco-section-parallax">
		<div class="parallax-img d-flex align-items-center">
			<div class="container">
				<div class="row d-flex justify-content-center">
					<div class="col-md-7 text-center heading-section heading-section-white ftco-animate">
						<h2>Subcribe to our Newsletter</h2>
						<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there
							live the blind texts. Separated they live in</p>
						<div class="row d-flex justify-content-center mt-5">
							<div class="col-md-8">
								<form action="#" class="subscribe-form">
									<div class="form-group d-flex">
										<input type="text" class="form-control" placeholder="Enter email address">
										<input type="submit" value="Subscribe" class="submit px-3">
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
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
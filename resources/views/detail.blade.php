
@extends('layouts.index')

@section('title', 'Detail')

@section('content')
   
<main id="main" class="main-site">

		<div class="container">

			<div class="wrap-breadcrumb">
				<ul>
					<li class="item-link"><a href="/" class="link">ပြင်ပ</a></li>
					<li class="item-link"><a href="/shop" class="link">စျေးဝယ်မယ်</a></li>
					<li class="item-link"><span>အသေးစိတ်အချက်လတ်များ</span></li>
				</ul>
			</div>
			
				
			
			<div class="row">
			
				<!--start main products area-->
				<div class="col-lg-9 col-md-8 col-sm-8 col-xs-12 main-content-area">
					<div class="wrap-product-detail">
						<div class="detail-media">
							<div class="product-gallery">
							    	<img src="{{ asset('assets/images/products')}}/{{$product->image}}" alt="product thumbnail" />
							</div>
						</div>
						<div class="detail-info">
							<div class="product-rating">
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <a href="#" class="count-review">(05 review)</a>
                            </div>
						<h2 class="product-name">{{ $product->name}}</h2>
                            <div class="short-desc">
                                <ul>
                                    <li>{{ $product->short_description}}</li>
                                    
                                </ul>
                            </div>
                
						<div class="wrap-price"><span class="product-price">${{ $product->price}}</span></div>
                            <div class="stock-info in-stock">
							<p class="availability">Availability: <b>{{ $product->stock_status}}</b></p>
                            </div>
                            {{-- <div class="quantity">
                            	<span>Quantity:</span>
								<div class="quantity-input">
									<input type="text" name="product-quatity" value="1" data-max="120" pattern="[0-9]*" >
									
									<a class="btn btn-reduce" href="#"></a>
									<a class="btn btn-increase" href="#"></a>
								</div>
							</div> --}}
							<div class="wrap-butons">
								{{-- <a href="#" class="btn add-to-cart">Add to Cart</a>
                                <div class="wrap-btn">
                                    <a href="#" class="btn btn-compare">Add Compare</a>
                                    <a href="#" class="btn btn-wishlist">Add Wishlist</a>
								</div> --}}
							<form action="{{ route('Cart.store')}}" method="POST">
								{{ csrf_field() }}
							<input type="hidden" name="id" value="{{ $product->id }}">
							<input type="hidden" name="name" value="{{ $product->name }}">
							<input type="hidden" name="price" value="{{ $product->price }}">
								<button style="width: 200px;" type="submit" class="btn add-to-cart" style="font-size: 12px;">စျေးဝယ်အိတ်ထဲ သို့ထည့်မည်</button>
								</form>
							</div>
						</div>
						<div class="advance-info">
							<div class="tab-control normal">
								<a href="#description" class="tab-control-item active">အထူးဖော်ပြချက်များ</a>
							</div>
							<div class="tab-contents">
								<div class="tab-content-item active" id="description">
								{{ $product->description}}
								</div>
							</div>
						</div>
					</div>
				</div><!--end main products area-->

				<!--start sitebar-->
				<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 sitebar">
					
					<!--start popular product-->
					<div class="widget mercado-widget widget-product">
						<h2 class="widget-title">ဆက်စပ်သည့် ပစ္စည်းများ</h2>
						<div class="widget-content">
							<ul class="products">
								@foreach ($relatedproduct as $product)
								<li class="product-item">
									<div class="product product-widget-style">
										<div class="thumbnnail">
										<a href="{{ route('Shop.show', $product->slug)}}" title="{{ $product->name }}">
												<figure><img src="{{ asset('assets/images/products')}}/{{$product->image}}" alt="{{$product->name}}"></figure>
											</a>
										</div>
										<div class="product-info">
										<a href="{{ route('Shop.show', $product->slug)}}" class="product-name"><span>{{ $product->name }}</span></a>
										<div class="wrap-price"><span class="product-price">${{ $product->price }}</span></div>
										</div>
									</div>
								</li>	
								@endforeach
								
							</ul>
						</div>
					</div><!--end popular product-->

				</div><!--end sitebar-->

				<!--start Related Products -->
					{{-- <div class="single-advance-box col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="wrap-show-advance-info-box style-1 box-in-site">
						<h3 class="title-box">Related Products</h3>
						<div class="wrap-products">
							<div class="products slide-carousel owl-carousel style-nav-1 equal-container" data-items="5" data-loop="false" data-nav="true" data-dots="false" data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"3"},"1200":{"items":"5"}}' >
								@foreach ($relatedproduct as $product)
                                    <div class="product product-style-2 equal-elem ">
									<div class="product-thumnail">
										<a href="{{ route('Shop.show', $product->slug)}}" title="{{ $product->name }}">
											<figure><img src="{{ asset('assets/images/products')}}/{{$product->image}}" alt="{{$product->name}}"></figure>
										</a>
										<div class="group-flash">
											<span class="flash-item new-label">new</span>
										</div>
										<div class="wrap-btn">
											<a href="{{ route('Shop.show', $product->slug)}}" class="function-link">quick view</a>
										</div>
									</div>
									<div class="product-info">
									<a href="{{ route('Shop.show', $product->slug)}}" class="product-name"><span>{{ $product->name }}</span></a>
									<div class="wrap-price"><span class="product-price">${{ $product->price }}</span></div>
									</div>
								</div>
                                @endforeach
									
							
								

							</div>
						</div><!--End wrap-products-->
					</div>
					</div><!--end Related Products --> --}}

			</div><!--end row-->

		</div><!--end container-->

	</main>
@endsection

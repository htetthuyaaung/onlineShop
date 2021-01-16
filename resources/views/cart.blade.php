

@extends('layouts.index')

@section('title', 'Cart')

@section('content')

   <main id="main" class="main-site">

		<div class="container">

			<div class="wrap-breadcrumb">
				<ul>
					<li class="item-link"><a href="{{ route('HomePage')}}" class="link">ပြင်ပ</a></li>
					<li class="item-link"><a href="{{ route('Shop.index')}}" class="link">စျေးဝယ်မည်</a></li>
					<li class="item-link"><sapn style="color: red;">အိတ်</sapn></li>
				</ul>
			</div>
			<div class=" main-content-area">
				<div class="wrap-iten-in-cart">

                    @if (session()->has('success_message'))
					<div class="alert alert-success" role="alert">
						{{ session()->get('success_message')}}
					</div>
					@endif
				
					@if (count($errors) > 0)
					<div class="alert alert-danger">
						<ul>
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
						</ul>
					</div>
					
               		 @endif

                 	@if (Cart::count() >0)
                		<h3 class="box-title">အိတ်ထဲတွင်  ပစ္စည်း ({{ Cart::count() }}) ခုရှိသည်။</h3>
							<ul class="products-cart">
                        
                        @foreach ( Cart::content() as $item)
						<li class="pr-cart-item">
							
							<div class="product-image">
                            <a href="{{ route('Shop.show', $item->model->slug)}}"><figure><img src="{{ asset('assets/images/products/'.$item->model->image)}}" alt="item"></figure></a>
							</div>
							<div class="detail-info" >
							<div class="product-name">
                            <a class="link-to-product" href="{{ route('Shop.show', $item->model->slug)}}">{{ $item->model->name}}</a>
							</div>
							<div class="short-desc" style="margin-left: 20px;">
								{{ $item->model->short_description}}
							</div>
							</div>
							<div class="price-field produtc-price"><p class="price">${{ $item->model->price}}</p></div>
							<div class="quantity">
						
							<input class="input" data-id="{{ $item->rowId }}" name="number" type="number" data-rule-required="false" aria-required="true" oninput="this.value = this.value.replace(/[^1-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" onKeyDown="if(this.value.length==1 && event.keyCode!=8) return false;" min="1" max="9" value="{{$item->qty}}">
								
							
							</div>
							<div class="price-field sub-total">
								
								<form action="{{ route('Cart.switchToSaveForLater', $item->rowId)}}" method="POST">
									{{ csrf_field()}}
									
									<button type="submit" class="btn btn-info" style="font-size: 10px;"><i class="fa fa-times-circle" aria-hidden="true"></i>ခဏမှတ်ထားမည်</button>
								</form>
							
							</div>
							<div class="delete">
								<form action="{{ route('Cart.destroy', $item->rowId)}}" method="POST">
									{{ csrf_field()}}
									{{ method_field('DELETE')}}
									
									<button type="submit" class="btn btn-danger" style="font-size: 10px;"><i class="fa fa-times-circle" aria-hidden="true"></i>ဖယ်ရှားမည်</button>
								</form>
							</div>
							
                        </li>
                         @endforeach
					</ul>
                 @else
                 <h3 style="color: red;">အိတ်ထဲ၌ မည်သည့်ပစ္စည်းမျှမရှိပါ။</h3>
                 @endif												
                    
                 
                </div>
				{{-- <a href="#" class="have-code">Have a Code?</a>

                <div class="have-code-container">
                    <form action="" method="">
                        
                        <input type="text" name="coupon_code" id="coupon_code">
                        <button type="submit" class="button button-plain">Apply</button>
                    </form>
				</div> --}}
				{{-- <div style="padding-bottom: 50px;width:60%;">
					<h3 class="box-title">Have Cupon?</h3>
				<form class="form-inline">
				
					  <input  type="text" class="form-control" id="text" placeholder="Cupon Here!">
					<button type="submit" class="btn btn-primary mb-2">Apply</button>
				
				  </form>
				</div> --}}

				<div class="summary">
					<div class="order-summary">
						<h4 class="title-box">မှာယူသည့် စာရင်းချုပ်</h4>
						<p class="summary-info"><span class="title" >သင့်ကုန်ကျငွေ</span><b class="index">${{ Cart::subtotal()}}</b></p>
						<p class="summary-info"><span class="title">နိုင်ငံတော်အခွန် ( ၁၃% )</span><b class="index">${{ Cart::tax()}}</b></p>
						<p class="summary-info total-info "><span class="title" style="color: red;">စုစုပေါင်းကုန်ကျငွေ</span><b class="index">${{ Cart::total()}}</b></p>
					</div>
					<div class="checkout-info">
						<a class="btn btn-checkout" href="{{ route('CheckOut.index')}}" style="width: 50%;float: right;" > ပစ္စည်း စစ်မည်</a>
						
						<a class="btn btn-checkout" href="{{ route('Shop.index')}}" style="background-color:grey;float: left;width:50%;">ဆက်လက်၍ စျေးဝယ်ဦးမည်<i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
					</div>
					<div class="wrap-iten-in-cart">
						@if (Cart::instance('saveForLater')->count() >0)
						<h3 class="box-title">ခဏမှတ်ထားသော ပစ္စည်းစာရင်း ({{ Cart::instance('saveForLater')->count() }}) ခု</h3>
						
						<ul class="products-cart">
							@foreach ( Cart::instance('saveForLater')->content() as $item)

							<li class="pr-cart-item">
							
							<div class="product-image">
                            <a href="{{ route('Shop.show', $item->model->slug)}}"><figure><img src="{{ asset('assets/images/products/'.$item->model->image)}}" alt="item"></figure></a>
							</div>
							<div class="detail-info" >
							<div class="product-name">
                            <a class="link-to-product" href="{{ route('Shop.show', $item->model->slug)}}">{{ $item->model->name}}</a>
							</div>
							<div class="short-desc" style="margin-left: 20px;">
								{{ $item->model->short_description}}
							</div>
							</div>
							<div class="price-field produtc-price"><p class="price">${{ $item->model->price}}</p></div>
							
							<div class="price-field sub-total">
								
								<form action="{{ route('SaveForLater.switchToCart', $item->rowId)}}" method="POST">
									{{ csrf_field()}}
									
									<button type="submit" class="btn btn-success" style="font-size: 10px;"><i class="fa fa-times-circle" aria-hidden="true"></i>အိတ်ထဲသို့ ပြန်ရွှေ့ပါ</button>
								</form>
							
							</div>
							<div class="delete">
								<form action="{{ route('SaveForLater.destroy', $item->rowId)}}" method="POST">
									{{ csrf_field()}}
									{{ method_field('DELETE')}}
									
									<button type="submit" class="btn btn-danger" style="font-size: 10px;"><i class="fa fa-times-circle" aria-hidden="true"></i>ဖယ်ရှားမည်</button>
								</form>
							</div>
							
                        </li>
						@endforeach
						</ul>
						
                		 @endif	
					</div>
				</div>
                <!--start related prodcuts-->
				<div class="wrap-show-advance-info-box style-1 box-in-site">
					<h3 class="title-box">ဆက်စပ်သည့် ပစ္စည်းများ</h3>
					<div class="wrap-products">
						<div class="products slide-carousel owl-carousel style-nav-1 equal-container" data-items="5" data-loop="false" data-nav="true" data-dots="false" data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"3"},"1200":{"items":"5"}}' >

                            @foreach ($relatedproduct as $product)
                                <div class="product product-style-2 equal-elem ">
								<div class="product-thumnail">
									<a href="{{ route('Shop.show', $product->slug)}}" title="{{$product->name}}">
										<figure><img src="{{ asset('assets/images/products')}}/{{$product->image}}" alt="{{$product->name}}"></figure>
									</a>
									<div class="group-flash">
										<span class="flash-item new-label" style="padding-top: 5px;">အသစ်</span>
									</div>
									<div class="wrap-btn">
										<a href="{{ route('Shop.show', $product->slug)}}" class="function-link">ကြည့်မယ်</a>
									</div>
								</div>
								<div class="product-info">
									<a href="{{ route('Shop.show', $product->slug)}}" class="product-name"><span>{{$product->name}}</span></a>
                                <div class="wrap-price"><span class="product-price">${{ $product->price }}</span></div>
								</div>
							</div>
                            @endforeach
							
						</div>
					</div><!--End wrap-products-->
				</div><!--end related prodcuts-->

			</div><!--end main content area-->
		</div><!--end container-->

	</main>
@endsection

@section('extra-js')
	<script src="{{ asset('js/app.js')}}"></script>
	<script>
		(function(){  
			const classname = document.querySelectorAll('.input');
			
			Array.from(classname).forEach(function(element){
				element.addEventListener('change', function(){
					const id = element.getAttribute('data-id');
					axios.patch(`/cart/${id}`, {
                        qty: this.value,
                       
                    })
					.then(function (response) {
						// console.log(response);
						window.location.href = '{{ route('Cart.index')}}'
					})
					.catch(function (error) {
						console.log(error);
						window.location.href = '{{ route('Cart.index')}}'
					});
					
				})
			})
		})();

	</script>
@endsection

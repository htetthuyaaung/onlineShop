
@extends('layouts.index')

@section('title', 'Checkout')
<script src="https://js.stripe.com/v3/"></script>
@section('content')
 
    	<main id="main" class="main-site">

		<div class="container">

			<div class="wrap-breadcrumb">
				<ul>
					<li class="item-link"><a href="#" class="link">ပြင်ပ</a></li>
					<li class="item-link"><span>ကိုယ်ပိုင် နေရာသို့ဝင်ရောက်မည်</span></li>
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

				<div class="wrap-show-advance-info-box style-1 box-in-site" style="width: 100%;">
					<h3 class="title-box" style="background-color:grey">သင်ရွေးချယ်ထားသော ပစ္စည်းများ</h3>
				</div>	
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
							<div class="short-desc" style="margin-left: 20px;margin-right:50px;">
								{{ $item->model->short_description}}
							</div>
							</div>
							<div class="price-field quantity">အရေအတွက်
								<div class="quantity-input" style="width: 30px; height:30px;border: 2px solid red;
																	padding: 5px;
																	border-radius: 25px;float:right;">
										{{$item->qty}}
								</div></div>
							<div class="quantity" style="padding-left:40px;" >
								<div class="quantity-input" style="width: 30px; height:30px;border: 2px solid gray;
																	padding:5px 7px 0px 10px;
																	border-radius: 25px;25px;float:left	;">
									X		
								</div>
							</div>
					
							<div class="delete">
							<div class="price-field produtc-price" style="padding-top:15px;"><p class="price">${{ $item->model->price}}</p></div>
							</div>
							
                        </li>
                         @endforeach
					</ul>
			
					<!--End wrap-products-->
					<div class="order-summary">
                        
					<div class="summary-item shipping-method">
						<h4 class="title-box f-title">စာရင်းချုပ်</h4>
						<p class="summary-info total-info"><span class="title" >သင့်ကုန်ကျငွေ</span><b class="index">${{ Cart::subtotal()}}</b></p>
                        
						<div class="summary-info">
							@if(session()->has('coupon'))
							<span class="title">လျော့စျေး({{ session()->get('coupon')['name']}}):
								<b class="index">-${{ $discount}}.00</b>
									<form action="{{ route('Coupon.destroy')}}" method="POST" style="display: inline;">
										{{ csrf_field() }}
										{{ method_field('delete')}}
										<button type="submit" style="width: 70px;height:30px;padding-bottom:30px;border:none;background:none;color:red;font-size:12px;">(ပယ်ရန်)</button>
									</form>
									
									<p class="summary-info total-info "><span class="title">သင့်ကုန်ကျငွေ(လျော့စျေးနှုတ်ပြီး)</span><b class="index">${{ $newSubtotal }}.00</b></p>
								</span>
								@endif
						</div>
						<p class="summary-info"><span class="title">နိုင်ငံတော်အခွန်(၁၃%)</span><b class="index">${{ $newTax }}</b></p><hr>
						<p class="summary-info box-title "><span class="title">စုစုပေါင်းကုန်ကျငွေ</span><b class="index">${{ $newTotal }}</b></p>

						@if(!session()->has('coupon'))
						<h4 class="title-box">လျော့စျေးကုဒ်ထည့်ရန်</h4>
						<div class="row-in-form">
							<form action="{{ route('Coupon.store')}}" method="POST">
								{{ csrf_field() }}
							<label for="coupon-code">ဤနေရာတွင်ကုဒ်ကိုထည့်ပါ</label>
							<input id="coupon_code" type="text" name="coupon_code">
								<br><br>
							<button type="submit" class="btn btn-small">အတည်ပြုမည်</button>
							</form>
							
						</div>
						@endif
					</div>
						
                    </div>
			</div>

				<div class="wrap-address-billing ">
					<div class="wrap-show-advance-info-box style-1 box-in-site" style="width: 100%;margin-bottom:20px;">
					<h3 class="title-box">ပစ္စည်းမှာရန်သင့်လိပ်စာကို ပြည့်စုံစွာဖြည့်ပါ။</h3>
					</div>
					<form action="{{ route('CheckOut.store')}}" method="POST" id="payment-form">
						{{ csrf_field()}}
						<div class="wrap-address-billing ">
						<div class="row-in-form title">
							<label for="fname">first name<span>*</span></label>
							<input id="fname" type="text" name="fname"  class="form-control"  value="{{ old('fname')}}" placeholder="Your name">
							
						</div>
						<div class="row-in-form title">
							<label for="lname">last name<span>*</span></label>
							<input id="lname" type="text" name="lname" value="{{ old('lname')}}" placeholder="Your last name"  class="form-control" >
						</div>
						
						<div class="row-in-form ">
							<label for="lname">E-mail<span>*</span></label>
							<input id="email" type="email" name="email" value="{{ old('email')}}" placeholder="Type your email"  class="form-control" >
						</div>
						<div class="row-in-form ">
							<label for="phone">Phone number<span>*</span></label>
							<input id="phone" type="text" name="phone" value="{{ old('phone')}}" placeholder="10 digits format"  class="form-control" >
						</div>
						<div class="row-in-form ">
							<label for="add">Address:</label>
							<input id="address" type="text" name="address" value="{{ old('address')}}" placeholder="Street at apartment number"  class="form-control" >
						</div>
						<div class="row-in-form ">
							<label for="State">province<span>*</span></label>
							<input id="province" type="text" name="province" value="{{ old('province')}}" placeholder="United States"  class="form-control" >
						</div>
						<div class="row-in-form ">
							<label for="postalcode">Postcode / ZIP:</label>
							<input id="postalcode" type="text" name="postalcode" value="{{ old('postalcode')}}" placeholder="Your postal code"  class="form-control" >
						</div>
						<div class="row-in-form ">
							<label for="city">Town / City<span>*</span></label>
							<input id="city" type="text" name="city" value="{{ old('city')}}" placeholder="City name"  class="form-control" >
						</div>
						</div>
						<h4 class="box-title">Payment Method</h4>
						<div class="wrap-address-billing " style="width: 100%;">
						<div class="row-in-form">
							<label for="cname">Name on Card<span>*</span></label>
							<input id="name_on_card" type="text" name="cname" value="{{ old('cname')}}"  class="form-control" >
						</div>
						<div class="row-in-form">
							<label for="card-element" >
							Credit or debit card<span>*</span>
							</label>
							<div id="card-element">
							<!-- A Stripe Element will be inserted here. -->
							</div>

							<!-- Used to display form errors. -->
							<div id="card-errors" role="alert"></div>
						</div>
						
						</div>
							<div class="row-in-form title" style="width: 100%;">
							<button id="complete-order" class="btn success" type="submit" style="width: 100%;" >ယုခုပဲ ပစ္စည်းမှာမည်</button>
						</div>
						
					</form>
				</div>	

		</div><!--end main content area-->
		</div><!--end container-->

	</main>
@endsection

@section('extra-js')
	
	<script>
		(function(){
				// Create a Stripe client.
					var stripe = Stripe('pk_test_51HyB9wEdzFkkkwxPp7nq2kvBHBNG6anhEYL3NGtmMNqgmI7Szbb0ZN2K17kw0SuYTBztvEZ1lpGPe1wcdeNcC5Ni00hfkzJ9Ij');

					// Create an instance of Elements.
					var elements = stripe.elements();

					// Custom styling can be passed to options when creating an Element.
					// (Note that this demo uses a wider set of styles than the guide below.)
					var style = {
					base: {
						color: '#32325d',
						fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
						fontSmoothing: 'antialiased',
						fontSize: '16px',
						'::placeholder': {
						color: '#aab7c4'
						}
					},
					invalid: {
						color: '#fa755a',
						iconColor: '#fa755a'
					}
					};

					// Create an instance of the card Element.
					var card = elements.create('card', {
						style: style,
						hidePostalCode:true
					
					});

					// Add an instance of the card Element into the `card-element` <div>.
					card.mount('#card-element');
					// Handle real-time validation errors from the card Element.
					card.on('change', function(event) {
					var displayError = document.getElementById('card-errors');
					if (event.error) {
						displayError.textContent = event.error.message;
					} else {
						displayError.textContent = '';
					}
					});

					// Handle form submission.
					var form = document.getElementById('payment-form');
					form.addEventListener('submit', function(event) {
					event.preventDefault();

					document.getElementById('complete-order').disabled = true;

						var options={
							name:document.getElementById('name_on_card').value,
							address_line1:document.getElementById('address').value,
							address_city:document.getElementById('city').value,
							address_state:document.getElementById('province').value,
							address_zip:document.getElementById('postalcode').value,
						}

					stripe.createToken(card, options).then(function(result) {
						if (result.error) {
						// Inform the user if there was an error.
						var errorElement = document.getElementById('card-errors');
						errorElement.textContent = result.error.message;

						document.getElementById('complete-order').disabled = false;
						} else {
						// Send the token to your server.
						stripeTokenHandler(result.token);
						}
					});
					});

					// Submit the form with the token ID.
					function stripeTokenHandler(token) {
					// Insert the token ID into the form so it gets submitted to the server
					var form = document.getElementById('payment-form');
					var hiddenInput = document.createElement('input');
					hiddenInput.setAttribute('type', 'hidden');
					hiddenInput.setAttribute('name', 'stripeToken');
					hiddenInput.setAttribute('value', token.id);
					form.appendChild(hiddenInput);

					// Submit the form
					form.submit();
					}
							})();
	</script>
@endsection
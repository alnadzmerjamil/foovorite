<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="user" content="{{ Auth::id() }}">
  <link rel="stylesheet" href="/css/main.css">
	<link rel="stylesheet" href="/css/rider/rider_page_phone.css">
  <link rel="stylesheet" href="/css/rider/rider_page.css">
	<script src="https://kit.fontawesome.com/a076d05399.js"></script>
	<title>Rider Page</title>
</head>
<body>
	<x-app-layout>
		@php
		$customer;
		$address;
		$contact;
		$resto;
		$resto_add;
		$flag=false;
			if(count($rider->order_items)!==0){
				foreach ($rider->order_items as $order ){
					$flag=true;
					global $customer;
					if(!$customer){
						$customer=$order->order->user->username ;
						$address=$order->order->user->address ;
						$contact=$order->order->user->contact ;
						$resto=$order->resto->name ;
						$resto_add=$order->resto->address ;
					}else{
						break;
					}

				}
			}else{
				$customer='' ;
				$address='' ;
				$contact='' ;
				$resto='';
				$resto_add='' ;
			}
	@endphp
		<main class="main-container">
			<div class="div-map">
				<div class="div-search">
					<div class="div-lbl">
					<x-jet-label  value="{{ __('Origin') }}" class="lbl-origin"/>
					</div>
					<div class="div-input-from">
						<x-jet-input type="text" id="from" />
					</div>

					<div class="div-lbl">
						<x-jet-label  value="{{ __('Destination') }}" class="lbl-to"/>
					</div>

					<div class="div-input-to">
						<x-jet-input type="text" id="to" />
					</div>

				</div>
				<div class="div-result">
					<p class="from"></p>
					<p class="to"></p>
					<p class="distance"></p>
				</div>
				<div class="div-close-map">
					<button class="x-btn">X</button>
				</div>

				<div id="div-google-map"></div>

			</div>
			
			<div class="div-customer-order">
				<p class="customer-text">Keep Safe!</p>
				<div class="div-customer-info">
					<p class="name p">{{ $customer }}</p>
					<p class="cx-add p">{{ $address }}</p>
					<p class="p">{{ $contact }}</p>
					<div class="div-status">
						{{-- <i class="far fa-question-circle"></i> --}}
						<div class="div-pickup-delivered">
							<input type="checkbox" class='rounded text-green-600 focus:ring-green-200 focus:ring-opacity-100 pick-up'>
							<span>Picked-up</span>
							<br>
							<input type="checkbox" class='rounded text-green-600 focus:ring-green-200 focus:ring-opacity-100 delivered' disabled> <span>Delivered</span>
						</div>
					</div>
				</div>
				
				<div class="div-resto-info">
					<p class="resto-name p">{{ $resto }}</p>
					<p class="resto-add p">{{ $resto_add }}</p>
				</div>
				<div class="div-orders">
					<div class="div-item-image">
						@foreach ($rider->order_items as $order )
							<div class="div-img">
								<img src="{{ $order->item->image }}" alt="" class="img-item">
								<p class="item-name p">{{ $order->status }}</p>
							</div>
							
						@endforeach
					</div>
				</div>
				<div class="div-refresh">
					<button class="refresh-btn">Refresh</button>
				</div>
				
			</div>
		</main>
		<div class="div-navigation">
			    <div class="select-direction">
						<p class="span-store">Store</span>
						<p class="span-cx">Customer</span>
					</div>
					<i class="far fa-compass"></i>
		</div>

	</x-app-layout>	
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCrDz4Um_aHJE5jjsIvkKCpVXj-TwokiVc&libraries=places"></script>
	<script src="js/rider/rider_page.js"></script>
</body>
</html>
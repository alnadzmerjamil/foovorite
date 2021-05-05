<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="user" content="{{ Auth::id() }}">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <!-- for social media buttons -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    />
	<link rel="stylesheet" href="/css/main.css">
	<link rel="stylesheet" href="/css/customer/customer.css">
	<title>Customer Order</title>
</head>
<body>
	<x-app-layout>
	<div class="div-for-modal">	
				<div class="div-modal">
					<div class="div-close-modal"><button id="x-btn">X</button></div>
					<div class="div-driver-profile">
						<div class="div-for-driver-profile-photo">
							<img src="https://now.bike/assets/merchants/rider.png" alt="" class="img-driver">
						</div>
						
					<strong>DRIVING</strong>
						<div class="div-driver-info">
							<p class="p.driver-name">DRIVER NAME</p>
							<p class="p-motor-type">WAVE 125</p>
							<p class="p-plate">JL-555</p>
							<p class="p-current-location">MAKATI CITY</p>
						</div>
						<div class="div-track-btn">
							<i class="fas fa-street-view"></i>
						</div>
					</div>
				</div>
			</div>
	<main class="main-container">
		{{-- starts here --}}
		<div id="div-order-text"><p id="order-text">ACTIVE ORDERS</p></div>		
		<div class="mini-container">
			<div class="div-for-display-orders">
							@php
								$status=0;
							@endphp
				@foreach ($orders as $order )
						<div class="div-group-order">
							@foreach ($order->order_items as $per_order )
									@php
									$status++;
									@endphp
								@if ($per_order->status=='pending')
									<div class="div-per-order-container" >
									<div class="div-per-order" >
										<div class="div-for-img-order">
											<img class="img-order" src="{{ $per_order->item->image }} "alt="item-image">
										</div>
										<div class="div-order-details">
											<div class="div-order-description">
												<p>{{ $per_order->item->name }}</p>
												<p>{{ $per_order->item->price }}</p>
												<p>Quantity {{ $per_order->quantity}}</p>
											</div>
										</div>
										<div class="div-resto-name-order">
											<p class="resto-name">Delivered from {{ $per_order->resto->name }}</p>
											<i class="fas fa-exclamation-circle" id="{{ $status }}"></i>
											<span class="span-tool-tip" id="tool-tip-{{ $status }}">Status</span>
										</div>
									</div>
								</div>
								@endif	
								
							@endforeach
						</div>
				@endforeach
			</div>
		</div>
		
	</main>
	
	
	</x-app-layout>
	<script src="/js/customer/customer.js"></script>
</body>
</html>
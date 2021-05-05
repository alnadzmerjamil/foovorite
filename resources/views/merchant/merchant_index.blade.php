<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="user" content="{{ Auth::id() }}">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="/css/main.css">
	<link rel="stylesheet" href="/css/merchant/merchant.css">
	<title>Merchant</title>
</head>
<body>
	<x-app-layout>
		<main class="main-container">
			<h2 id="order-text">ORDERS @ {{ Auth::user()->restos->where('id',Session::get('resto_id'))->first()->name }}</h2>		
			<div class="mini-container">
				<div class="div-for-display-orders">
					@foreach ($orders as $order )
						<div class="div-group-order" id="group-order-{{ $order->id }}">
							@foreach ($order->order_items as $order_item)
								@if ($order_item->resto_id==Session::get('resto_id'))
									<div class="div-per-order-container" >
										<div class="div-per-order">
											<div class="div-for-img-order">
												<img class="img-order" src="{{ $order_item->item->image }} "alt="item-image" data-item-id="{{ $order_item->item->id }}" data-order-item-id="{{ $order->id }}">
												<div class="div-option" id="option-{{ $order->id }}">
													<p class="cancel-item">Cancel</p>
													<p class="replace-item">Replace</p>
												</div>
											</div> 
											<div class="div-order-details">
												<div class="div-order-description">
													<p data-item-name="{{ $order_item->id }}"
														class="item-name">{{ $order_item->item->name }}</p>
													<p>{{ $order_item->item->price }}</p>
													<p>Quantity {{ $order_item->quantity}}</p>
												</div>
											</div>
										</div>
									</div>
								@endif	
							@endforeach
							<div class="div-accept-btn">
								<button class="accept-btn" data-group-orderId="{{ $order->id }}">Accept</button>
							</div>
						</div>
					@endforeach
				</div>
			</div>
		</main>
	</x-app-layout>
	<script src="/js/merchant/merchant.js"></script>
</body>
</html>
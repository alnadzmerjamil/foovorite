<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="/css/main.css">
	<link rel="stylesheet" href="/css/resto/add_resto.css">
	<title>Document</title>
</head>
<body>
	<x-app-layout>
		<main class="main-container">
			<h1 style="text-align: center">ADD RESTO</h1>
			<div class="mini-container">
				<div class="div-for-input">
					<label for="" class="lbl-resto-name">RESTAURANT NAME</label>
					<div class="div-input">
						<x-jet-input class="ipt-resto-name" />
					</div>

					<label for="" class="lbl-resto-add">ADDRESS</label>
					<div class="div-input">
						<x-jet-input class="ipt-resto-add" />
						{{-- <input type="text" class="block mt-1 w-full  ipt-resto-add" > --}}
					</div>
					<div class="div-save-btn">
						<form action="" class="frm-add-resto">
							@csrf
							<button class="save-btn">Save</button>
						</form>
					</div>

				</div>
				<div class="div-for-display-all-resto">
					<div class="div-all-resto-text">ALL RESTAURANTS</div>
					@foreach ($restaurants as $resto)
					<div class="div-per-resto">
						<span class="span-resto" data-user={{$resto->user->name}}>{{ $resto->name }}
						</span>
						<small class="sml-resto-add">{{ $resto->address }}</small>
					</div>
					
					@endforeach
				
				</div>
			</div>
		</main>
	</x-app-layout>
	<script src="/js/resto/add_resto.js"></script>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="user" content="{{ Auth::id() }}">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="/css/main.css">
	<link rel="stylesheet" href="/css/item/add_item.css">
	<title>Add Item Form</title>
</head>
<body>
	<x-app-layout>
		<main class="main-container">
			<div class="mini-container div-display-items">
				<div class="div-add-item-btn">
					<button id="add-item-btn">ADD ITEM</button>
				</div>
				<label for="" class="lbl-item-resto">RESTO</label>
				<select name="" id=""class="select-resto-on-display block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
					<option value="" >--SELECT--</option>
					@foreach($restaurants as $resto)
					<option value="{{ $resto->id }}">{{ $resto->name }}</option>
					@endforeach
				</select>

				@foreach ($categories as $category)
					<div class="div-for-food-category food" >
						<p class="p-head-text">{{$category->name}}</p>
						@foreach ($items as $item)
							@if($item->resto_id==Session::get('resto_id'))
								@if($item->category_id==$category->id )
									<div class="div-per-item" id="item-{{ $item->id }}">
										<div class="div-edit-delete-item">
											<button class="delete-item-btn" id={{ $item->id }}>DELETE</button>
											<button class="edit-item-btn" data-item-resto="{{ $item->resto }}" data-item-details="{{ $item }}" data-item-category="{{ $item->category }}">
												EDIT
											</button>
										</div>
										<span class="span-item-name">{{ $item->name }}  @  {{ $item->resto->name }}
										</span>
										<small class="sml-resto-add">Owner : {{ $item->resto->user->username }}</small>
										<small class="sml-resto-add">{{ $item->resto->address }}</small>
									</div>
								@endif
							@endif
						@endforeach
					</div>
				@endforeach
			</div>
			<div data-resto="{{ $restaurants }}" class="all-restos"></div>
			<div data-items="{{ $items }}" class="all-items" id="{{ $items }}"></div>
		</main>
		<div class="div-for-modal">
			{{-- ADD AND EDIT FORM --}}
			<div class="mini-container div-add-item">
				<div class="div-close-frm"><button id='x-btn'>X</button></div>
				<h2><strong id='str-head'>ADD ITEM</strong></h2>
				<br>
				<label for="" class="lbl-item-name">ITEM NAME</label>
				<div class="div-input-name divs">
					<x-jet-input type="text" class="ipt-item-name"/>
				</div>

				<label for="" class="lbl-item-category">CATEGORY</label>
				<select name="" class="select-category block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
					<option value="" id="default-category" >--SELECT--</option>
					@foreach($categories as $category)
					<option value={{$category->id }} id={{$category->id }}>{{ $category->name }}</option>
					@endforeach
				</select>

				<label for="" class="lbl-item-price">PRICE</label>
				<div class="div-input-price divs">
					<x-jet-input type="text" class="ipt-item-price"/>
				</div>

				<label for="" class="lbl-item-image">IMAGE</label>
				<div class="div-input-image divs">
					<x-jet-input type="text" class="ipt-item-image"/>
				</div>

				<label for="" class="lbl-item-resto">RESTO</label>
				<select name="" id=""class="select-resto block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
					<option value="" id='default-resto'>--SELECT--</option>
					@foreach($restaurants as $resto)
					<option value={{$resto->id }} id={{$resto->id }}>{{ $resto->name }}</option>
					@endforeach
				</select>

				<div class="div-save-btn divs">
					<form action="" class="frm-add-item" enctype="multipart/form-data">
							@csrf
							<button class="save-btn">SAVE</button>
						</form>
					
				</div>
				{{-- FOR UPDATE EDIT --}}
				<div class="div-update-btn divs">
					<form action="" class="frm-update-item">
							@csrf
							<button class="update-btn">UPDATE</button>
						</form>
					
				</div>
			</div>

			{{-- MODAL--}}

			<div class="div-modal">
				<p class="p-confirm">
					Are you sure you want to delete this item?
				</p>
				<div class="div-cancel-delete">
					<button class="modal-btn" id='cancel-delete-btn'>Cancel</button>
				</div>
					<form class="frm-delete-item"  >
					@csrf
						<button class="modal-btn" id='yes-delete-btn'>Yes</button>
					</form>
			</div>
		</div>
  </x-app-layout>
	<script src="/js/item/add_item.js"></script>
</body>
</html>
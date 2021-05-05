<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="/css/main.css">
	<link rel="stylesheet" href="/css/category/add_category.css">
	<title>Document</title>
</head>
<body>
	<x-app-layout>
		<h1>ADD CATEGORY</h1>
		<div class="main-container">
			<div class="mini-container-category">
				<div class="div-for-input">
					<label for="" class="lbl-category">CATEGOY NAME</label>
					<div class="div-input"><x-jet-input type="text" class="ipt-category" name='input-category' /></div>
					<div class="div-save-btn">
						<form action="" class="frm-add-category">
							@csrf
							<button class="save-btn">Save</button>
						</form>
					</div>

				</div>
				<div class="div-for-display-categories">
					<div class="div-all-categories-text">ALL CATEGORIES</div>
					@foreach ($categories as $category)
					<span class="span-category">{{ $category->name}}</span>
					@endforeach
				</div>
			</div>
		</div>
  </x-app-layout>
	<script src="/js/category/add_category.js"></script>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="user" content="{{ Auth::id() }}">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="/css/main.css">
	<link rel="stylesheet" href="/css/merchant/merchant.css">
	<title>Document</title>
</head>
<body>
	<div class="div-for-modal">
				<div class="div-modal">
					<label for="" class="lbl-store-id">ENTER YOUR STORE ID </label>
					<input type="text" class="ipt-store-id">
					<div class="div-enter">
						<form method="POST" action="
						" class="frm-enter-from-modal">
							@csrf
							<input hidden type="text" name='resto_id' id='ipt-resto-id'>
							<button id='enter-btn' data-store-id="{{ Auth::user()->restos()->get()}}" data>ENTER</button>
						</form>
					</div>
					<div class="div-cancel"><a id='cancel-btn' href="/">CANCEL</a></div>
					</div>
					
				</div>
			</div>
				<script src="/js/modal/modal_merchant.js"></script>
</body>
</html>
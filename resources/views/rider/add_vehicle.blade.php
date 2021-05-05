<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="user" content="{{ Auth::id() }}">
  <link rel="stylesheet" href="/css/main.css">
  <link rel="stylesheet" href="/css/rider/add_vehicle.css">
	<title>Add Vehicle</title>
</head>
<body>
	<x-app-layout>
		<div class="main-container">
			<div class="div-mini-container">
				<h2>VEHICLE INFORMATION</h2>
				<div class="div-for-add-vehicle">
					<div class="divs">
						<label for="" class="lbl-vehicle-model">Vehicle Model</label>
						<div class="div-input">
							<x-jet-input type="text"  class="ipt-vehicle-model"/>
						</div>
					</div>
					<div class="divs">
						<label for="" class="lbl-vehicle-model">Vehicle Registration</label>
						<div class="div-input">
							<x-jet-input type="text"  class="ipt-vehicle-registration"/>
						</div>
					</div>
					<div class="divs">
						<label for="" class="lbl-vehicle-model">Vehicle Plate</label>
						<div class="div-input">
							<x-jet-input type="text"  class="ipt-vehicle-plate"/>
						</div>
					</div>	
					<div class="divs">
						<label for="" class="lbl-vehicle-model">Driver's Liscence</label>
						<div class="div-input">
							<x-jet-input type="text"  class="ipt-dl"/>
						</div>
					</div>
					<div class="div-save">
						<form action="" class="frm-add-vehicle">
							@csrf
							<button type="button" class="cancel-btn">Cancel</button>
							<button class="save-btn">Save</button>
						</form>
						
					</div>
				</div>
			</div>
		</div>	
	</x-app-layout>
	<script src="/js/rider/add_vehicle.js"></script>
</body>
</html>
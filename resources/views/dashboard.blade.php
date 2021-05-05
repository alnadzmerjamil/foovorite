 
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="user" content="{{ Auth::id() }}">
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <!-- for social media buttons -->
    
  <link rel="stylesheet" href="/css/main.css">
  <link rel="stylesheet" href="/css/dashboard/dashboard.css">
  <link rel="stylesheet" href="/css/dashboard/dashboard_phone.css">
  
  
  <title>Buddyz Food Delivery</title>
</head>
<body>

  {{-- @php$orders=Session::get('my_order')@endphp --}}
  <x-app-layout>
    <div class="mother" id="mother"  data-all-items="{{ $items }}">
      <div class="main-container">
        <div class="div-search-filter-container">
          <div class="div-search-filter">
            <div class="div-filter">
              <i class="fas fa-sort-amount-down"></i>
            </div>
            <div class="div-search">
              <div class="icon-search-container search">
                <i class="fas fa-search"></i>
                <x-jet-input class="" id="input-search" placeholder="Search here"/>
              </div>
            </div>
          </div>
          {{-- search suggestion--}}
          <div class="div-search-suggest-container">
            <div class="div-search-suggest" id='div-search-suggest'>
              <div class="div-suggested-container">
                <form action="/searchitems" method='post' id="frm-search-suggest"
                 class="frm-search-suggest">
                  @csrf
                  <input type="text" name="category_id" id="category-id" hidden>
                </form>
                <p class="p-suggestion-text">Search suggestions</p>
              </div>
            </div>
          </div>
          {{-- filter option--}}
          <div class="div-filter-option-container">
            <div class="div-for-filter-option" id='div-search-suggest'>
              <div class="div-filter-option">
                {{-- <form action="" method='' class="frm-search-suggest">
                  @csrf
                  <button class="suggest-btn">I am suggested 1</button>
                  <button class="suggest-btn">I am suggested 2</button>
                  <button class="suggest-btn">I am suggested 3</button>
                </form> --}}
                <p class="p-suggestion-text">Search suggestions</p>
              </div>
            </div>
          </div>
        </div>
        <div class="div-for-display-items">
          
          @foreach($items as $item)
            <div class="div-per-item-container">
              <div class="div-per-item">
                <div class="div-for-img">
                  <img class="img-item" src="{{ $item->image }}" alt="item-image">
                </div>
                <div class="div-resto-name">Avail @ {{ $item->resto->name }}</div>
                <div class="div-item-details">
                  <div class="div-item-description">
                    
                    <p class="p-text-items-display">{{ $item->name }}</p>
                    <p class="p-text-items-display">{{ $item->price }}</p>
                  </div>
                  <div class="div-order-btn">
                    <form class="frm-order" data-item="{{ $item}}"  data-resto="{{ $item->resto}}" data-rider-id="">
                      @csrf
                      
                        <button class="order-btn" >ORDER</button>
                      
                    </form>
                    
                  </div>
                </div>
              </div>
            </div>
          @endforeach
          
        </div>
        {{-- @if (count($my_orders)!==0) --}}
          <div class="div-for-order-container" >
            
          <div class="div-for-order" data-has-order="{{ json_encode($my_orders) }}">
              <strong id='str-head'>MY ORDER</strong>
              @php
                $total=0; 
                $index=0;
              @endphp
              @if (count($my_orders)!==0)
                @foreach ($my_orders as $my_order)
            
                  {{-- @if ($my_order['user_id']==Auth::id()) --}}
                    @php
                    $total+=$my_order['quantity']*$my_order['item_price'];
                    $index++;
                    @endphp
                    {{-- x-btn-{{ $my_order['item_id'] }}" ito ay ginagamit sa pag reremove gamit ang x button --}}
                    <div class="div-per-order-container x-btn-{{ $my_order['item_id'] }}" id="{{ $index }}">
                        <div class="div-per-order">
                          <div class="div-for-img-order">
                            <img class="img-order" src={{ $my_order['item_image'] }} alt="item-image">
                          </div>
                          <div class="div-order-details">
                            <div class="div-order-description">
                              <div class="div-remove-order"><button class="x-btn" id="{{ $my_order['item_id'] }}">...</button></div>
                              <p class="p-text">
                                {{ $my_order['item_name'] }}
                              </p>
                              <p class="p-text">
                                {{ $my_order['item_price']}}
                              </p>
                              <p id="quantity-{{ $my_order['item_id'] }}" class="p-text">
                                Quantity {{ $my_order['quantity']}}
                              </p>
                            </div>
                            
                          </div>
                          <div class="div-resto-name-order">Prepared @ {{ $my_order['resto_name'] }}</div>
                        
                        </div>
                      </div>
                  {{-- @endif   --}}
                @endforeach
              @endif
            
          </div>
          <div class="div-confirm-container">
              <div class="div-confirm-order">
                <div class="div-total">TOTAL : {{ $total }}</div>
                <div class="div-cancel-confirm">
                  <button class="cancel-btn" type="button">CANCEL</button>
                  <div class="div-for-frm-confirm">
                    <form class="frm-confirm-order" >
                    @csrf
                    <button class="confirm-btn">CONFIRM</button>
                    </form>
                  </div>
              </div>
            </div>
          </div>
          </div>
          
        {{-- @else <div class="div-order-empty">Empty</div>  
        @endif --}}
      </div>
    </div>
    
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('WELCOME') }}
        </h2>
    </x-slot>
    
    <div class="py-12">
        ITO YUNG DISPLAY PAG NAKA LOGGED IN KA
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-jet-welcome />
            </div>
        </div>
    </div> --}}
  </x-app-layout>
  <script src="/js/dashboard/dashboard.js"></script>
</body>
</html>

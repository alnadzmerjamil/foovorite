 <meta name="csrf-token" content="{{ csrf_token() }}">
<style>
    .main-nav{
        position: sticky;
        top: 0;
        z-index: 200;
         background-color: #a0f1a7;
       
    }
    #div-for-img-logo{
        width: 50%;
        display: flex;
        justify-content: flex-start;
        align-items: center;
        /* background-color: blue; */
    }
    #div-logo{
        width: 35%;
        /* background-color: wheat */
    }
    #motor-logo{
        width: 100%;
        /* background-color: orangered; */
    }
    #div-foovorite{
        width: 30%;
        /* background-color: whitesmoke; */
    }
    #foovorite-text{
        font-size: 5vw;
        font-family: fantasy;

    }
    .switch-container{
        width: 100%;
        /* text-align: right; */
        position: relative;
        /* background-color: gray; */
    }
    
    .light{
        width: 40px;
        height: 21px;
        position: absolute;
        right: 0;
        top: 0;
        border-radius: 20px;
        background-color: gray
    }
    #lbl-status{
        width: 19px;
        height:19px;
        border-radius: 50%;
        position: relative;
        top: 1px;cursor: pointer;
        background-color: white;
    }
    #input-for-check{
        position: absolute;
        visibility: hidden;
    }
    @media only screen and (min-width:768px) and (max-width:991px){
          .main-nav{
        position: sticky;
        top: 0;
        padding: 5px;
        z-index: 200;
         background-color: #a0f1a7;
       
    }
    #div-for-img-logo{
        width: 50%;
        display: flex;
        justify-content: flex-start;
        align-items: center;
        /* background-color: blue; */
    }
    #div-logo{
        width: 15%;
        /* background-color: wheat */
    }
    #motor-logo{
        width: 100%;
        /* background-color: orangered; */
    }
    #div-foovorite{
        width: 30%;
        /* background-color: whitesmoke; */
    }
    #foovorite-text{
        font-size: 20px;
        font-family: fantasy;

    }
    }
    @media only screen and (min-width:992px){
        .main-nav{
        position: sticky;
        top: 0;
        padding: 5px;
        z-index: 200;
         background-color: #a0f1a7;
       
    }
    #div-for-img-logo{
        width: 50%;
        display: flex;
        justify-content: flex-start;
        align-items: center;
        /* background-color: blue; */
    }
    #div-logo{
        width: 15%;
        /* background-color: wheat */
    }
    #motor-logo{
        width: 100%;
        /* background-color: orangered; */
    }
    #div-foovorite{
        width: 30%;
        /* background-color: whitesmoke; */
    }
    #foovorite-text{
        font-size: 25px;
        font-family: fantasy;

    }
    }
</style>
<nav x-data="{ open: false }" class="main-nav bg-green border-b border-gray-100" >
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between">
            <div id="div-for-img-logo">
                <!-- Logo -->
               
                <a href="/dashboard" id="div-logo">
                  <img id="motor-logo" src="https://images.vexels.com/media/users/3/130996/isolated/preview/40019c881fffb39397813744dc5c310c-hipster-scooter-2-by-vexels.png" alt="">
                  <a href="{{ route('dashboard') }}">
                </a>
                
                <!-- Navigation Links -->
                <div id="div-foovorite" >
                    <x-jet-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')" id="foovorite-text">
                        {{ __('Foovorite') }}
                    </x-jet-nav-link>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <!-- Teams Dropdown -->
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                    <div class="ml-3 relative">
                        <x-jet-dropdown align="right" width="60">
                            <x-slot name="trigger">
                                <span class="inline-flex rounded-md">
                                    <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-blue-500 bg-orange hover:bg-orange-50 hover:text-orange-700 focus:outline-none focus:bg-orange-50 active:bg-orange-50 transition ease-in-out duration-150">
                                        {{ Auth::user()->currentTeam->username }}

                                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </span>
                            </x-slot>

                            <x-slot name="content">
                                <div class="w-60">
                                    <!-- Team Management -->
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        {{ __('Manage Team') }}
                                    </div>

                                    <!-- Team Settings -->
                                    <x-jet-dropdown-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">
                                        {{ __('Team Settings') }}
                                    </x-jet-dropdown-link>

                                    @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                        <x-jet-dropdown-link href="{{ route('teams.create') }}">
                                            {{ __('Create New Team') }}
                                        </x-jet-dropdown-link>
                                    @endcan

                                    <div class="border-t border-gray-100"></div>

                                    <!-- Team Switcher -->
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        {{ __('Switch Teams') }}
                                    </div>

                                    @foreach (Auth::user()->allTeams() as $team)
                                        <x-jet-switchable-team :team="$team" />
                                    @endforeach
                                </div>
                            </x-slot>
                        </x-jet-dropdown>
                    </div>
                @endif

                <!-- Settings Dropdown -->
                <div class="ml-3 relative">
                    <x-jet-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out">
                                    <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->username }}" />
                                </button>
                            @else
                                <span class="inline-flex rounded-md">
                                    <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                        {{ Auth::user()->username }}

                                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </span>
                            @endif
                        </x-slot>

                        <x-slot name="content">
                            <!-- Account Management -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Manage Account') }}
                            </div>

                            <x-jet-dropdown-link href="{{ route('profile.show') }}">
                                {{ __('Profile') }}
                            </x-jet-dropdown-link>

                            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                <x-jet-dropdown-link href="{{ route('api-tokens.index') }}">
                                    {{ __('API Tokens') }}
                                </x-jet-dropdown-link>
                            @endif
                            
                            {{-- customer --}}
                            @if (Auth::user()->role=='Customer')
                                <x-jet-dropdown-link href="/orders">
                                    {{ __('My order') }}
                                </x-jet-dropdown-link>
                                
                                {{-- for merchant --}}
                                @elseif (Auth::user()->role=='Merchant')
                                <x-jet-dropdown-link href="/orders" class="drop-down-order">
                                    {{ __('Orders') }}
                                </x-jet-dropdown-link>
                                <x-jet-dropdown-link href="/restaurants/create">
                                    {{ __('Add Resto') }}
                                </x-jet-dropdown-link>
                                <x-jet-dropdown-link href="/items/create">
                                    {{ __('Add Item') }}
                                </x-jet-dropdown-link>
                                
                                {{-- for rider --}}
                                @elseif (Auth::user()->role=='Rider')<x-jet-dropdown-link href="/riders">
                                    {{ __('My Ride') }}
                                </x-jet-dropdown-link>
                                <x-jet-dropdown-link href="/riders/create">
                                    {{ __('Register') }}
                                </x-jet-dropdown-link>
                                
                                <x-jet-dropdown-link >
                                <div class="switch-container" data-rider-status="{{ Session::get('rider_status') }}" data-type-of-user="{{ Auth::user()->role }}">
                                    <div class="light">
                                        <x-jet-label for="input-for-check" value="{{ __('') }}" id="lbl-status" data-rider-id="{{ Session::get('rider_id')}}"/>
                                    </div>
                                    <x-jet-label value="{{ __('Status') }}" id="" />
                                    <input type="checkbox" name="" id="input-for-check" class="checkbox" >
                                </div>
                                </x-jet-dropdown-link>
                            @endif
                            
                            <div class="border-t border-gray-100"></div>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-jet-dropdown-link href="{{ route('logout') }}"
                                         onclick="event.preventDefault();
                                            
                                                this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-jet-dropdown-link>
                            </form>
                        </x-slot>
                    </x-jet-dropdown>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        {{-- <div class="pt-2 pb-3 space-y-1">
            <x-jet-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')" style="font-size: 15px;font-family:fantasy">
                {{ __('Foovorite') }}
            </x-jet-responsive-nav-link>
        </div> --}}

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="flex items-center px-4">
                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                    <div class="flex-shrink-0 mr-3">
                        <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                    </div>
                @endif

                <div>
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Account Management -->
                <x-jet-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                    {{ __('Profile') }}
                </x-jet-responsive-nav-link>

                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                    <x-jet-responsive-nav-link href="{{ route('api-tokens.index') }}" :active="request()->routeIs('api-tokens.index')">
                        {{ __('API Tokens') }}
                    </x-jet-responsive-nav-link>
                @endif

                {{-- customer --}}
                @if (Auth::user()->role=='Customer')
                    <x-jet-dropdown-link href="/orders">
                        {{ __('My order') }}
                    </x-jet-dropdown-link>
                    
                    {{-- for merchant --}}
                    @elseif (Auth::user()->role=='Merchant')
                    <x-jet-dropdown-link href="/orders" class="drop-down-order">
                        {{ __('Orders') }}
                    </x-jet-dropdown-link>
                    <x-jet-dropdown-link href="/restaurants/create">
                        {{ __('Add Resto') }}
                    </x-jet-dropdown-link>
                    <x-jet-dropdown-link href="/items/create">
                        {{ __('Add Item') }}
                    </x-jet-dropdown-link>
                    
                    {{-- for rider --}}
                    @elseif (Auth::user()->role=='Rider')<x-jet-dropdown-link href="/riders">
                        {{ __('My Ride') }}
                    </x-jet-dropdown-link>
                    <x-jet-dropdown-link href="/riders/create">
                        {{ __('Register') }}
                    </x-jet-dropdown-link>
                    
                    <x-jet-dropdown-link >
                    <div class="switch-container" data-rider-status="{{ Session::get('rider_status') }}" data-type-of-user="{{ Auth::user()->role }}">
                        <div class="light">
                            <x-jet-label for="input-for-check" value="{{ __('') }}" id="lbl-status" data-rider-id="{{ Session::get('rider_id')}}"/>
                        </div>
                        <x-jet-label value="{{ __('Status') }}" id="" />
                        <input type="checkbox" name="" id="input-for-check" class="checkbox" >
                    </div>
                    </x-jet-dropdown-link>
                @endif

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-jet-responsive-nav-link href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                    this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-jet-responsive-nav-link>
                </form>

                <!-- Team Management -->
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                    <div class="border-t border-gray-200"></div>

                    <div class="block px-4 py-2 text-xs text-gray-400">
                        {{ __('Manage Team') }}
                    </div>

                    <!-- Team Settings -->
                    <x-jet-responsive-nav-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}" :active="request()->routeIs('teams.show')">
                        {{ __('Team Settings') }}
                    </x-jet-responsive-nav-link>

                    @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                        <x-jet-responsive-nav-link href="{{ route('teams.create') }}" :active="request()->routeIs('teams.create')">
                            {{ __('Create New Team') }}
                        </x-jet-responsive-nav-link>
                    @endcan

                    <div class="border-t border-gray-200"></div>

                    <!-- Team Switcher -->
                    <div class="block px-4 py-2 text-xs text-gray-400">
                        {{ __('Switch Teams') }}
                    </div>

                    @foreach (Auth::user()->allTeams() as $team)
                        <x-jet-switchable-team :team="$team" component="jet-responsive-nav-link" />
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</nav>

{{-- for switch status --}}
<script>
let dataContainer=document.querySelector('.switch-container');
console.log(dataContainer);


if(dataContainer){
const token = document.querySelector('meta[name="csrf-token"]').content;
userRole=dataContainer.getAttribute('data-type-of-user');
riderStatus=dataContainer.getAttribute('data-rider-status');

let checkBox = document.getElementById("input-for-check");
let toggleSwitch = document.querySelector("#lbl-status");
let light = document.querySelector(".light");
//

toggleSwitch.addEventListener("click", function () {
    let riderId=toggleSwitch.getAttribute('data-rider-id');
    if(!riderId){
        return alert('Sorry, Something went wrong!')
    }
    if (!checkBox.checked) {
      // alert('firsr click')
        toggleSwitch.style.left = "19px";
        light.style.backgroundColor = "greenyellow";
        //fetch here to be active
        updateStatus(riderId,'active');
        
    } else {
      // alert('2nd click')

        toggleSwitch.style.left = "0";
        light.style.backgroundColor = "gray";
         updateStatus(riderId,'off');
    }

});


//know the rider status
// let riderStatus=document.querySelector('.switch-container');
// riderStatus=riderStatus.getAttribute('data-rider-status');

if(riderStatus=='active'){
  toggleSwitch.style.left = "19px";
  light.style.backgroundColor = "greenyellow";
  checkBox.checked='true';
}

//fetch to update the status
function updateStatus(riderId,status){
    fetch("/riders/" + riderId, {
      //nasa line 185
      headers: {
          "Content-Type": "application/json",
      },
      method: "PUT",
      body: JSON.stringify({
          _token: token,
          status: status,
      }),
    }).then((res) => {
        res.text().then((res) => {
            // alert(res);
            console.log(res);
            // window.location.reload();
        });
    });
}

}



</script>
	{{-- <script src="js/rider/rider_page.js"></script> --}}
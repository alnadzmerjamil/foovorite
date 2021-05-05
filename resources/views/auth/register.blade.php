<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/registration/registration.css">
    <title>Document</title>
  </head>
  <body>
    <x-guest-layout>
      <x-jet-authentication-card>
          <x-slot name="logo">
              <x-jet-authentication-card-logo />
          </x-slot>

          <x-jet-validation-errors class="mb-4" />

          <div class="mini-container">
              <div class="sign-up">SIGN UP</div>
              <form method="POST" action="{{ route('register') }}" class="frm-registraton">
                  @csrf
                  <div class="mt-4">
                      <x-jet-label for="username" value="{{ __('Username') }}" />
                      <x-jet-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')" required autofocus autocomplete="username" />
                  </div>

                  {{-- <div class="mt-4">
                      <x-jet-label for="b-day" value="{{ __('Birth Day') }}" />
                      <x-jet-input id="b-day" class="block mt-1 w-full" type="date" name="b-day" :value="old('b-day')" required autofocus autocomplete="b-day" />
                  </div>

                  <div class="mt-4">
                      <x-jet-label for="email" value="{{ __('Email') }}" />
                      <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                  </div> --}}

                  <div class="mt-4">
                      <x-jet-label for="contact" value="{{ __('Contact Number') }}" />
                      <x-jet-input id="contact" class="block mt-1 w-full" type="number" name="contact" :value="old('contact')" required />
                  </div>
                  
                  <div class="mt-4">
                      <x-jet-label for="address" value="{{ __('Address') }}" />
                      <x-jet-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')" required autofocus autocomplete="address" />
                  </div>

                  

                  <div class="mt-4">
                      <x-jet-label for="password" value="{{ __('Password') }}" />
                      <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                  </div>

                  <div class="mt-4">
                      <x-jet-label for="role" value="{{ __('Register as') }}" />
                      <select id="role" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" type="text" name="role" :value="old('role')" required autofocus autocomplete="role" >
                          <option value="Customer">Customer</option>
                          <option value="Merchant">Merchant</option>
                          <option value="Rider">Rider</option>
                      </select>
                  </div>

                  <div class="mt-4">
                      <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                      <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                  </div>

                  @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                      <div class="mt-4">
                          <x-jet-label for="terms">
                              <div class="flex items-center">
                                  <x-jet-checkbox name="terms" id="terms"/>

                                  <div class="ml-2">
                                      {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                              'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                                              'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                                      ]) !!}
                                  </div>
                              </div>
                          </x-jet-label>
                      </div>
                  @endif

                  <div class="flex items-center justify-end mt-4-div-registration-btn">
                      <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                          {{ __('Already registered?') }}
                      </a>

                      <x-jet-button class="ml-4">
                          {{ __('Register') }}
                      </x-jet-button>
                  </div>
              </form>
          </div>
        </x-jet-authentication-card>
      </x-guest-layout>
    </body>
</html>

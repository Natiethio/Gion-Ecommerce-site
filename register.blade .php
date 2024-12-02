<head>
    <title>Register</title>
    <link rel="shortcut icon" href="{{asset('images/favicon2.png')}}" type="">
    <style>
        body {
            background-image: url("images/logocartt.png");
            background-size: cover;
            background-repeat: no-repeat;
        }
    </style>
</head>

<body>

    <x-guest-layout>
        <x-authentication-card>
            <x-slot name="logo">
                <!-- <x-authentication-card-logo /> -->
                <img width="250" src="/images/logocartt.png" alt="#" />
            </x-slot>

            <x-validation-errors class="mb-4" />
            @if(session('password'))
                <div class="alert alert-success" id="flash-message" role="alert" style="text-align:center">
                    {{ session('password') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true" onclick="removeFlashMessage()">X</span></button>
                </div>
                @endif
            <form method="POST" action="{{url('regnew')}}"> <!-- enctype="multipart/form-data"-->
                @csrf
               <div>
                    <x-label for="name" value="{{ __('Name') }}" />
                    <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name',$name)" required autofocus {{ isset($name) ? 'readonly' : '' }} />
                </div>
                <div class="mt-4">
                    <x-label for="email" value="{{ __('Email') }}" />
                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email',$email)" required autofocus {{ isset($email) ? 'readonly' : '' }} />
                </div>
                <div class="mt-4">
                    <x-label for="goole_id" />
                    <x-input id="goole_id" class="block mt-1 w-full" type="hidden" name="goole_id" :value="old('google_id',$google_id)" required autocomplete="username" />
                </div>
                <div class="mt-4">
                    <x-label for="phone" value="{{ __('phone') }}" />
                    <x-input id="phone" class="block mt-1 w-full" type="number" name="phone" :value="old('phone',$phone)" required autocomplete="username" />
                    @error('phone')
                      <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mt-4">
                    <x-label for="address" value="{{ __('address') }}" />
                    <x-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')" required autocomplete="username"/>
                    @error('address')
                      <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-4">
                    <x-label for="password" value="{{ __('Password') }}" />
                    <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                    @error('password')
                      <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
               <div class="mt-4">
                    <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                    <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                    @error('confirmpassword')
                      <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <!-- <div class="mt-4">
                    <x-label for="password" value="{{ __('Customer Photo(Optional)') }}"/>
                    <input type="file" id="image" name="image" class="block mt-1 w-full" placeholder="Product Image"/>
                </div> -->
             @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" required />

                            <div class="ml-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Terms of Service').'</a>',
                                'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
                @endif

                <div class="flex items-center justify-end mt-4">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>

                    <x-button class="ml-4">
                        {{ __('Register') }}
                    </x-button>
                </div>
            </form>
        </x-authentication-card>
    </x-guest-layout>
    <script>
        function removeFlashMessage() {
            var flashMessage = document.getElementById('flash-message');
            if (flashMessage) {
                flashMessage.parentNode.removeChild(flashMessage);
            }
        }
    </script>
</body>
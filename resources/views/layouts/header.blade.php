<nav class="bg-blue-900 text-gray-200 shadow mb-8 py-4">
    <div class="container mx-auto px-6 md:px-0">
        <div class="flex items-center justify-center">
            <div class="mr-6">
                <a href="{{ url('/') }}" class="text-lg font-semibold text-gray-100 no-underline">
                    <img src="{{ asset('images/logo_texto.png') }}" alt="logotipo" width="110">
                </a>
            </div>
            <div class="flex-1 flex items-center justify-end">
                @guest
                    <a class="no-underline hover:underline  text-sm p-3" href="{{ route('login') }}">{{ __('Login') }}</a>
                    @if (Route::has('register'))
                        <a class="no-underline hover:underline  text-sm p-3" href="{{ route('register') }}">{{ __('Register') }}</a>
                    @endif
                @else
                    <span class=" text-sm pr-4">{{ Auth::user()->name }}</span>

                    <a href="{{ route('logout') }}"
                       class="no-underline hover:underline  text-sm p-3"
                       onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                        <span class="iconify" data-icon="ant-design:logout-outlined" data-inline="false"></span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                        @csrf
                    </form>
                @endguest
            </div>
        </div>
    </div>
</nav>


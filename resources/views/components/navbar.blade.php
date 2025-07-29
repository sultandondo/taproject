<nav class="fixed top-0 w-full z-50 navbar-bg">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Navigation Links (Desktop) -->
            <div class="hidden md:flex space-x-8">
                <a href="{{ route('home') }}" class="text-white hover:text-blue-400 font-medium px-3 py-2">Home</a>
                <a href="{{ route('calc.show', ['id' => 0]) }}" class="text-white hover:text-blue-400 font-medium px-3 py-2">Calculate</a>
                <a href="{{ route('simulationhardware.show', ['id' => 1]) }}" class="text-white hover:text-blue-400 font-medium px-3 py-2">Simulate</a>
                <a href="{{ route('about.us') }}" class="text-white hover:text-blue-400 font-medium px-3 py-2">About Us</a>
                <a href="#contact" class="text-white hover:text-blue-400 font-medium px-3 py-2">Contact</a>
                @if (Auth::check())
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-white hover:text-red-400 font-medium px-3 py-2">Logout</button>
                    </form>
                @endif
            </div>

            <!-- Logo -->
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10">
                    <img src="{{ asset('img/LogoSLC.png') }}" alt="Logo SkyLinkCal" class="w-full h-full object-contain">
                </div>
                <span class="font-bold text-xl text-white">SkyLinkCal</span>
            </div>

            <!-- Hamburger Button (Mobile) -->
            <div class="md:hidden">
                <button id="hamburger-btn" class="text-white focus:outline-none">
                    <!-- Hamburger icon (3 bars) -->
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                         xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu (hidden by default) -->
    <div id="mobile-menu" class="md:hidden hidden px-4 pb-4">
        <a href="{{ route('home') }}" class="block text-white hover:text-blue-400 font-medium py-2">Home</a>
        <a href="{{ route('calc.show', ['id' => 0]) }}" class="block text-white hover:text-blue-400 font-medium py-2">Calculate</a>
        <a href="{{ route('simulationhardware.show', ['id' => 1]) }}" class="text-white hover:text-blue-400 font-medium py-2">Simulate</a>
        <a href="{{ route('about.us') }}" class="block text-white hover:text-blue-400 font-medium py-2">About Us</a>
        <a href="#contact" class="block text-white hover:text-blue-400 font-medium py-2">Contact</a>
        @if (Auth::check())
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="block w-full text-left text-white hover:text-red-400 font-medium py-2">
                    Logout
                </button>
            </form>
        @endif
    </div>
</nav>

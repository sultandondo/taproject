<nav class="fixed top-0 w-full z-50 navbar-bg">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Navigation Links (Left Side) -->
            <div class="hidden md:flex space-x-8">
                <a href="{{ route('home') }}" class="nav-link text-white hover:text-blue-400 font-medium px-3 py-2">Home</a>
                <a href="{{ route('calc.show', ['id' => 0]) }}" class="nav-link text-white hover:text-blue-400 font-medium px-3 py-2">Calculate</a>
                <a href="{{ route('simulationhardware.show', ['id' => 1]) }}" class="nav-link text-white hover:text-blue-400 font-medium px-3 py-2">Simulate</a>
                <a href="{{ route('about.us') }}" class="nav-link text-white hover:text-blue-400 font-medium px-3 py-2">About Us</a>
                <a href="#contact" class="nav-link text-white hover:text-blue-400 font-medium px-3 py-2">Contact</a>
                @if (Auth::check())
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-white hover:text-red-400 font-medium px-3 py-2">
                            Logout
                        </button>
                    </form>
                @endif
            </div>
            
            <!-- Logo (Center/Right Side) -->
            <div class="flex items-center space-x-3 logo-container">
                <div class="w-10 h-10 flex items-center justify-center">
                    <img src="{{ asset('img/LogoSLC.png') }}" alt="Logo SkyLinkCal" class="w-full h-full object-contain">
                </div>
                <span class="font-bold text-xl text-white">SkyLinkCal</span>
            </div>
            
            <!-- Mobile Menu Button -->
            <div class="md:hidden hamburger" id="hamburger">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
    
  
</nav>
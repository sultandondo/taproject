<nav class="fixed top-0 w-full z-50 navbar-bg">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Navigation Links (Left Side) -->
            <div class="hidden md:flex space-x-8">
                <a href="{{ route('home') }}" class="nav-link text-white hover:text-blue-400 font-medium px-3 py-2">Home</a>
                <a href="{{ route('calc.show', ['id' => 0]) }}" class="nav-link text-white hover:text-blue-400 font-medium px-3 py-2">Calculate</a>
                <a href="{{ route('about.us') }}" class="nav-link text-white hover:text-blue-400 font-medium px-3 py-2">About Us</a>
                <a href="#contact" class="nav-link text-white hover:text-blue-400 font-medium px-3 py-2">Contact</a>
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
    
    <!-- Mobile Menu -->
    <div class="mobile-menu fixed top-16 left-0 w-full h-screen z-40" id="mobileMenu">
        <div class="flex flex-col space-y-4 p-6">
            <a href="#" class="text-white hover:text-blue-400 font-medium py-3 px-4 rounded-lg hover:bg-white/5 transition">
                <i class="fas fa-home mr-3"></i>Home
            </a>
            <a href="#features" class="text-white hover:text-blue-400 font-medium py-3 px-4 rounded-lg hover:bg-white/5 transition">
                <i class="fas fa-star mr-3"></i>Features
            </a>
            <a href="#about" class="text-white hover:text-blue-400 font-medium py-3 px-4 rounded-lg hover:bg-white/5 transition">
                <i class="fas fa-info-circle mr-3"></i>About Us
            </a>
            <a href="#contact" class="text-white hover:text-blue-400 font-medium py-3 px-4 rounded-lg hover:bg-white/5 transition">
                <i class="fas fa-envelope mr-3"></i>Contact
            </a>
        </div>
    </div>
</nav>
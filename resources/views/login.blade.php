menu login
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <!-- Main Content -->
    <div class="flex items-center justify-end min-h-screen bg-gray-200">
        <!-- Background Image -->
        <img src="{{ asset('img/asw.jpg') }}" alt="Background Image" class="absolute inset-0 w-full h-full object-cover z-0">

        <!-- Form Login -->
        <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md mr-9 z-10">
            <h2 class="text-2xl font-bold text-center mb-6">Login</h2>

            @if ($errors->any())
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ url('login') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" id="email" name="email" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required />
                </div>

                <div class="mb-6">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" id="password" name="password" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required />
                </div>

                <div class="flex items-center justify-between">
                    <button type="submit" class="w-full py-2 px-4 bg-indigo-600 text-white font-semibold rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        Log in
                    </button>
                </div>
            </form>

            <div class="mt-4 text-center">
                <a href="#" class="text-sm text-indigo-600 hover:text-indigo-500">Forgot your password?</a>
            </div>
        </div>
    </div>

    <footer class="bg-gray-800 text-white text-center py-4 mt-6">
        <p>&copy; 2023 Your Company. All rights reserved.</p>
    </footer>
</body>

</html>

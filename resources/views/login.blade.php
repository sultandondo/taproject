<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .satellite-background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: linear-gradient(135deg, #0a0a23 0%, #1a1a3e 50%, #2d1b69 100%);
            z-index: -1;
            overflow: hidden;
        }

        .stars {
            position: absolute;
            width: 100%;
            height: 100%;
            background-image: 
                radial-gradient(2px 2px at 20px 30px, #eee, transparent),
                radial-gradient(2px 2px at 40px 70px, rgba(255,255,255,0.8), transparent),
                radial-gradient(1px 1px at 90px 40px, #fff, transparent),
                radial-gradient(1px 1px at 130px 80px, rgba(255,255,255,0.6), transparent),
                radial-gradient(2px 2px at 160px 30px, #fff, transparent);
            background-repeat: repeat;
            background-size: 200px 100px;
            animation: twinkle 4s ease-in-out infinite alternate;
        }

        @keyframes twinkle {
            0% { opacity: 0.7; }
            100% { opacity: 1; }
        }

        .earth-system {
            position: absolute;
            width: 500px;
            height: 500px;
            top: 50%;
            left: 25%;
            transform: translate(-50%, -50%);
        }

        .earth {
            width: 280px;
            height: 280px;
            border-radius: 50%;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: 
                radial-gradient(circle at 25% 25%, #1e88e5, #1565c0),
                radial-gradient(circle at 70% 70%, #0d47a1, #1976d2),
                linear-gradient(135deg, #42a5f5 0%, #1976d2 30%, #0d47a1 70%, #0a237a 100%);
            box-shadow: 
                inset -30px -30px 70px rgba(0,0,0,0.6),
                inset 20px 20px 40px rgba(255,255,255,0.1),
                0 0 80px rgba(30, 136, 229, 0.4),
                0 0 150px rgba(30, 136, 229, 0.2);
            animation: earthRotate 25s linear infinite;
            overflow: hidden;
            position: relative;
        }

        .earth::after {
            content: '';
            position: absolute;
            top: -20px;
            left: -20px;
            width: 130%;
            height: 130%;
            background: 
                radial-gradient(ellipse at 30% 20%, rgba(255,255,255,0.4) 0%, rgba(255,255,255,0.1) 40%, transparent 70%),
                linear-gradient(135deg, rgba(255,255,255,0.2) 0%, transparent 50%);
            border-radius: 50%;
            pointer-events: none;
        }

        .earth-atmosphere {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 320px;
            height: 320px;
            border-radius: 50%;
            background: radial-gradient(circle, transparent 85%, rgba(135, 206, 250, 0.3) 90%, rgba(30, 144, 255, 0.2) 95%, transparent 100%);
            animation: atmosphereGlow 8s ease-in-out infinite alternate;
            pointer-events: none;
        }

        @keyframes atmosphereGlow {
            0% { 
                box-shadow: 0 0 25px rgba(135, 206, 250, 0.3);
                transform: translate(-50%, -50%) scale(1);
            }
            100% { 
                box-shadow: 0 0 50px rgba(135, 206, 250, 0.5);
                transform: translate(-50%, -50%) scale(1.02);
            }
        }

        @keyframes earthRotate {
            0% { transform: translate(-50%, -50%) rotate(0deg); }
            100% { transform: translate(-50%, -50%) rotate(360deg); }
        }

        @keyframes continentMove {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .satellite-orbit {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 420px;
            height: 420px;
            border: 2px solid rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: orbitRotate 15s linear infinite;
        }

        .satellite {
            position: absolute;
            top: -25px;
            left: 50%;
            transform: translateX(-50%);
            width: 50px;
            height: 50px;
        }

        .satellite-body {
            width: 25px;
            height: 35px;
            background: linear-gradient(145deg, #e0e0e0, #bdbdbd);
            border-radius: 3px;
            position: relative;
            margin: 0 auto;
            box-shadow: 
                0 3px 12px rgba(0,0,0,0.3),
                inset 0 2px 3px rgba(255,255,255,0.3);
        }

        .satellite-body::before {
            content: '';
            position: absolute;
            top: 6px;
            left: 50%;
            transform: translateX(-50%);
            width: 15px;
            height: 10px;
            background: linear-gradient(45deg, #4fc3f7, #29b6f6);
            border-radius: 2px;
            box-shadow: 0 0 12px rgba(79, 195, 247, 0.5);
        }

        .solar-panel {
            position: absolute;
            top: 12px;
            width: 20px;
            height: 10px;
            background: linear-gradient(90deg, #1a237e, #303f9f, #3f51b5);
            border-radius: 2px;
            box-shadow: 0 0 6px rgba(63, 81, 181, 0.4);
        }

        .solar-panel.left {
            left: -24px;
            animation: panelGlow 3s ease-in-out infinite alternate;
        }

        .solar-panel.right {
            right: -24px;
            animation: panelGlow 3s ease-in-out infinite alternate 1.5s;
        }

        @keyframes panelGlow {
            0% { box-shadow: 0 0 6px rgba(63, 81, 181, 0.4); }
            100% { box-shadow: 0 0 18px rgba(63, 81, 181, 0.8), 0 0 30px rgba(63, 81, 181, 0.4); }
        }

        .antenna {
            position: absolute;
            top: -6px;
            left: 50%;
            transform: translateX(-50%);
            width: 2px;
            height: 10px;
            background: linear-gradient(to bottom, #fff, #ccc);
            border-radius: 1px;
        }

        .antenna::after {
            content: '';
            position: absolute;
            top: -4px;
            left: 50%;
            transform: translateX(-50%);
            width: 8px;
            height: 8px;
            background: radial-gradient(circle, #ff5722, #d84315);
            border-radius: 50%;
            box-shadow: 0 0 15px rgba(255, 87, 34, 0.6);
            animation: signalBlink 2s ease-in-out infinite;
        }

        @keyframes signalBlink {
            0%, 100% { opacity: 1; transform: translateX(-50%) scale(1); }
            50% { opacity: 0.3; transform: translateX(-50%) scale(1.2); }
        }

        @keyframes orbitRotate {
            0% { transform: translate(-50%, -50%) rotate(0deg); }
            100% { transform: translate(-50%, -50%) rotate(360deg); }
        }

        .signal-waves {
            position: absolute;
            top: 50%;
            left: 25%;
            transform: translate(-50%, -50%);
            pointer-events: none;
        }

        .signal-wave {
            position: absolute;
            border: 2px solid rgba(255, 87, 34, 0.3);
            border-radius: 50%;
            animation: signalExpand 3s ease-out infinite;
        }

        .signal-wave:nth-child(1) {
            width: 120px;
            height: 120px;
            top: -60px;
            left: -60px;
            animation-delay: 0s;
        }

        .signal-wave:nth-child(2) {
            width: 180px;
            height: 180px;
            top: -90px;
            left: -90px;
            animation-delay: 1s;
        }

        .signal-wave:nth-child(3) {
            width: 240px;
            height: 240px;
            top: -120px;
            left: -120px;
            animation-delay: 2s;
        }

        @keyframes signalExpand {
            0% {
                transform: scale(0);
                opacity: 1;
            }
            100% {
                transform: scale(1);
                opacity: 0;
            }
        }

        .orbit-path {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 420px;
            height: 420px;
            border: 1px dashed rgba(79, 195, 247, 0.3);
            border-radius: 50%;
            animation: orbitPulse 4s ease-in-out infinite alternate;
        }

        @keyframes orbitPulse {
            0% { opacity: 0.3; }
            100% { opacity: 0.7; }
        }

        /* Login form styling */
        .login-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
        }

        .error-alert {
            background: rgba(254, 226, 226, 0.9);
            backdrop-filter: blur(5px);
        }

        body {
            font-family: 'Inter', 'Space Grotesk', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }

        /* Welcome Title Styling */
        .welcome-title {
            position: absolute;
            top: 80px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 10;
            text-align: center;
            color: white;
            font-family: 'Space Grotesk', sans-serif;
            text-shadow: 0 0 20px rgba(255, 255, 255, 0.3);
        }

        .welcome-title h1 {
            font-size: 3.5rem;
            font-weight: 600;
            background: linear-gradient(135deg, #ffffff 0%, #e3f2fd 30%, #bbdefb 60%, #90caf9 100%);
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 0.5rem;
            letter-spacing: -0.02em;
            animation: titleGlow 3s ease-in-out infinite alternate;
        }

        .welcome-title p {
            font-size: 1.125rem;
            font-weight: 300;
            color: rgba(255, 255, 255, 0.8);
            letter-spacing: 0.05em;
            font-family: 'Inter', sans-serif;
        }

        @keyframes titleGlow {
            0% { 
                text-shadow: 0 0 20px rgba(255, 255, 255, 0.3), 0 0 40px rgba(144, 202, 249, 0.2);
            }
            100% { 
                text-shadow: 0 0 30px rgba(255, 255, 255, 0.5), 0 0 60px rgba(144, 202, 249, 0.4);
            }
        }

        /* Responsive Title */
        @media (max-width: 768px) {
            .welcome-title h1 {
                font-size: 2.5rem;
            }
            .welcome-title p {
                font-size: 1rem;
            }
        }

        .floating-particles {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }

        .particle {
            position: absolute;
            width: 4px;
            height: 4px;
            background: rgba(255, 255, 255, 0.6);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }

        .particle:nth-child(1) { left: 10%; animation-delay: 0s; }
        .particle:nth-child(2) { left: 20%; animation-delay: 1s; }
        .particle:nth-child(3) { left: 30%; animation-delay: 2s; }
        .particle:nth-child(4) { left: 40%; animation-delay: 3s; }
        .particle:nth-child(5) { left: 50%; animation-delay: 4s; }
        .particle:nth-child(6) { left: 60%; animation-delay: 5s; }
        .particle:nth-child(7) { left: 70%; animation-delay: 1.5s; }
        .particle:nth-child(8) { left: 80%; animation-delay: 2.5s; }
        .particle:nth-child(9) { left: 90%; animation-delay: 3.5s; }

        @keyframes float {
            0%, 100% { 
                transform: translateY(100vh) scale(0);
                opacity: 0;
            }
            10% {
                opacity: 1;
                transform: translateY(90vh) scale(1);
            }
            90% {
                opacity: 1;
                transform: translateY(10vh) scale(1);
            }
        }
    </style>
</head>

<body>
    <!-- Satellite Background Animation -->
    <div class="satellite-background">
        <div class="stars"></div>
        
        <!-- Welcome Title -->
        <div class="welcome-title">
            <h1>Selamat Datang</h1>
            <p>Sky Link Calculator</p>
        </div>
        
        <div class="floating-particles">
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
        </div>
        
        <div class="earth-system">
            <div class="orbit-path"></div>
            <div class="earth-atmosphere"></div>
            <div class="earth"></div>
            
            <div class="satellite-orbit">
                <div class="satellite">
                    <div class="satellite-body">
                        <div class="solar-panel left"></div>
                        <div class="solar-panel right"></div>
                        <div class="antenna"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="signal-waves">
            <div class="signal-wave"></div>
            <div class="signal-wave"></div>
            <div class="signal-wave"></div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="flex items-center justify-end min-h-screen">
        <!-- Form Login -->
        <div class="login-container p-8 rounded-lg w-full max-w-md mr-9 z-10">
            <h2 class="text-2xl font-bold text-center mb-6 text-gray-800">Login</h2>

            <!-- Error Messages (jika ada) -->
            <div class="error-alert border-l-4 border-red-500 text-red-700 p-4 mb-4 rounded hidden">
                <ul>
                    <li>Error message would appear here</li>
                </ul>
            </div>

            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" id="email" name="email" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm bg-white bg-opacity-90" required />
                </div>

                <div class="mb-6">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" id="password" name="password" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm bg-white bg-opacity-90" required />
                </div>

                <div class="flex items-center justify-between">
                    <button type="submit" class="w-full py-2 px-4 bg-indigo-600 text-white font-semibold rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-all duration-300 hover:shadow-lg">
                        Log in
                    </button>
                </div>
            </form>

            <div class="mt-4 text-center">
                <a href="#" class="text-sm text-indigo-600 hover:text-indigo-500 transition-colors duration-300">Forgot your password?</a>
            </div>
        </div>
    </div>

    <footer class="bg-gray-800 bg-opacity-90 backdrop-filter backdrop-blur-lg text-white text-center py-4 mt-6 relative z-10">
        <p>&copy; 2023 Your Company. All rights reserved.</p>
    </footer>

    <script>
        // Efek interaktif tambahan
        document.addEventListener('mousemove', (e) => {
            const cursor = { x: e.clientX, y: e.clientY };
            const center = { x: window.innerWidth / 2, y: window.innerHeight / 2 };
            
            const deltaX = (cursor.x - center.x) * 0.005;
            const deltaY = (cursor.y - center.y) * 0.005;
            
            const earthSystem = document.querySelector('.earth-system');
            if (earthSystem) {
                earthSystem.style.transform = 
                    `translate(calc(-50% + ${deltaX}px), calc(-50% + ${deltaY}px))`;
            }
        });

        // Smooth form interactions
        const inputs = document.querySelectorAll('input');
        inputs.forEach(input => {
            input.addEventListener('focus', () => {
                input.style.transform = 'scale(1.02)';
                input.style.transition = 'transform 0.2s ease';
            });
            
            input.addEventListener('blur', () => {
                input.style.transform = 'scale(1)';
            });
        });
    </script>
</body>

</html>
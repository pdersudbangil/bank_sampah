<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="font-sans antialiased dark:bg-black dark:text-white/50">
    
    <div class="relative flex flex-col justify-center items-center h-screen bg-gray-100 dark:bg-black overflow-hidden">
        <!-- Background -->
        <img src="{{ asset('bank_sampah/images/background.svg') }}" class="absolute -left-20 top-0 max-w-[877px]" />

        <div class="relative w-full max-w-5xl px-6">
            <header class="grid grid-cols-3 items-center py-4">
                <div class="flex justify-center col-start-2 mb-10">
                    <img src="{{ asset('bank_sampah/images/logo2.jpg') }}" alt="Logo" class="rounded-full w-20 h-20">
                </div>
            </header>

            <main class="grid grid-cols-2 gap-6 items-center">
                <!-- Slogan -->
                <div class="text-center font-mono">
                    <h5 class="text-4xl lg:text-5xl text-white font-bold mb-5">Reuse</h5>
                    <h5 class="text-4xl lg:text-5xl text-white font-bold mb-5">Reduce</h5>
                    <h5 class="text-4xl lg:text-5xl text-white font-bold mb-0">Recycle</h5>
                </div>

                <!-- Login Form -->
                <div class="bg-white p-5 rounded-lg shadow-lg ring-1 ring-gray-200 dark:bg-zinc-900 dark:ring-zinc-800">
                    <h2 class="text-center text-xl font-bold text-green-600">Portal Bank Sampah RSUD Bangil</h2>

                    <form action="{{ route('login') }}" method="POST" class="mt-4">
                        @csrf
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" id="email" name="email"
                                class="w-full p-2 border rounded focus:ring-2 focus:ring-green-500 text-black"
                                placeholder="Enter your email" value="{{ old('email', 'admin@themesbrand.com') }}">
                        </div>

                        <div class="mt-3">
                            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                            <div class="relative">
                                <input type="password" id="password" name="password"
                                    class="w-full p-2 border rounded focus:ring-2 focus:ring-green-500 text-black"
                                    placeholder="Enter password" value="12345678">
                                <button type="button" id="toggle-password"
                                    class="absolute inset-y-0 right-3 flex items-center text-gray-500">
                                    <i class="ri-eye-off-line"></i>
                                </button>
                            </div>
                        </div>

                        <div class="flex justify-between text-sm mt-2">
                            <label class="inline-flex items-center">
                                <input type="checkbox" class="form-checkbox text-green-500">
                                <span class="ml-2 text-gray-600">Remember me</span>
                            </label>
                            <a href="{{ route('password.update') }}" class="text-green-600 hover:underline">Forgot password?</a>
                        </div>

                        <button type="submit"
                            class="mt-4 w-full bg-green-600 text-white py-2 rounded hover:bg-green-700 transition">
                            Sign In
                        </button>
                    </form>

                    <p class="text-center text-sm text-gray-600 mt-2">
                        Don't have an account?
                        <a href="{{ route('register') }}" class="text-green-600 font-semibold hover:underline">Sign Up</a>
                    </p>
                </div>
            </main>

            <footer class="text-center text-sm text-black dark:text-white/70 mt-4">
                <!-- Footer -->
            </footer>
        </div>
    </div>

    <!-- Dark Mode Script -->
    <script>
        document.getElementById('toggle-password').addEventListener('click', function () {
            let passwordInput = document.getElementById('password');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                this.innerHTML = '<i class="ri-eye-line"></i>';
            } else {
                passwordInput.type = 'password';
                this.innerHTML = '<i class="ri-eye-off-line"></i>';
            }
        });
    </script>
</body>

</html>

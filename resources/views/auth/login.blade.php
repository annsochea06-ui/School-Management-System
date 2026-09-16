<!DOCTYPE html>
<html lang="km">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - NIB ACADEMY</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-[#0f0709] text-slate-100 font-sans antialiased min-h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-md bg-gradient-to-b from-[#1c0b10] to-[#14080b] border border-rose-900/40 rounded-3xl p-8 shadow-2xl relative overflow-hidden">
        <div class="absolute -left-16 -top-16 w-40 h-40 bg-rose-600/10 rounded-full blur-2xl pointer-events-none"></div>

        <div class="text-center space-y-2 mb-6">
            <div class="inline-flex w-12 h-12 rounded-2xl bg-gradient-to-br from-rose-900 to-red-950 border border-amber-400/40 items-center justify-center text-amber-300 text-2xl shadow-inner mb-2">
                <i class="fa-solid fa-right-to-bracket"></i>
            </div>
            <h2 class="text-2xl font-black text-white">Login</h2>
            <p class="text-rose-200/60 text-xs">Please sign in to your account</p>
        </div>

        <form action="{{ route('login') }}" method="POST" class="space-y-4">
            @csrf

           

            <!-- Email Input -->
            <div>
                <label class="block text-xs font-semibold text-rose-200/80 mb-1.5">Email Address</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-rose-400/60">
                        <i class="fa-solid fa-envelope"></i>
                    </span>
                    <input type="email" name="email" required placeholder="name@example.com" 
                        class="w-full pl-10 pr-4 py-3 rounded-xl bg-[#0f0709] border border-rose-900/50 text-white text-sm focus:outline-none focus:border-rose-500 transition placeholder:text-slate-600">
                </div>
            </div>

            <!-- Password Input -->
            <div>
                <div class="flex items-center justify-between mb-1.5">
                    <label class="text-xs font-semibold text-rose-200/80">Password</label>
                    <a href="#" class="text-[11px] text-amber-300/80 hover:underline">Forgot Password?</a>
                </div>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-rose-400/60">
                        <i class="fa-solid fa-lock"></i>
                    </span>
                    <input type="password" name="password" required placeholder="••••••••" 
                        class="w-full pl-10 pr-4 py-3 rounded-xl bg-[#0f0709] border border-rose-900/50 text-white text-sm focus:outline-none focus:border-rose-500 transition placeholder:text-slate-600">
                </div>
            </div>

            <!-- Submit Button -->
            <button type="submit" 
                class="w-full py-3.5 rounded-xl bg-gradient-to-r from-rose-800 to-red-700 hover:from-rose-700 hover:to-red-600 text-white font-bold text-sm shadow-lg shadow-rose-950/80 border border-rose-600/40 transition active:scale-95 mt-2">
                Login
            </button>
        </form>

        <div class="mt-6 text-center text-xs text-rose-200/60">
            Don't have an account yet? 
            <a href="{{ route('register') }}" class="text-amber-300 font-semibold hover:underline">Create a new account (Register)</a>
        </div>
    </div>

</body>
</html>
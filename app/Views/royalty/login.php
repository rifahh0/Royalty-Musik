<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Plus Jakarta Sans', sans-serif; background: #0f172a; color: #f8fafc; }</style>
</head>
<body class="p-6 min-h-screen flex items-center justify-center">
    <div class="w-full max-w-md bg-slate-900/50 border border-slate-800 rounded-3xl p-8 backdrop-blur-2xl shadow-2xl">
        <div class="text-center mb-8">
            <span class="text-xs text-indigo-400 font-semibold tracking-wider uppercase">Sovereign Gate</span>
            <h2 class="text-2xl font-bold text-white mt-1">Digital Trust Login</h2>
            <p class="text-xs text-slate-500 mt-1">Silakan masuk untuk mengakses enkripsi data royalti</p>
        </div>

        <?php if (session()->getFlashdata('error')) : ?>
            <div class="mb-4 p-3 bg-rose-500/10 border border-rose-500/20 text-rose-400 text-xs rounded-xl text-center">
                ⚠️ <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <form action="/auth" method="post" class="space-y-5">
            <?= csrf_field() ?>
            <div>
                <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Username</label>
                <input type="text" name="username" class="w-full bg-slate-950 border border-slate-700 rounded-xl px-4 py-3 text-slate-200 text-sm focus:outline-none focus:border-indigo-500" required placeholder="admin atau aripah">
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Password</label>
                <input type="password" name="password" class="w-full bg-slate-950 border border-slate-700 rounded-xl px-4 py-3 text-slate-200 text-sm focus:outline-none focus:border-indigo-500" required placeholder="••••••••">
            </div>

            <button type="submit" class="w-full py-3.5 bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white font-semibold rounded-xl text-sm shadow-lg shadow-indigo-500/10 transition-all">
                Masuk ke Sistem
            </button>
        </form>

        <div class="mt-6 pt-4 border-t border-slate-800/60 text-center text-[11px] text-slate-500 space-y-1">
            <p>Akun Admin: <span class="text-slate-400">admin / admin123</span></p>
            <p>Akun User (Musisi): <span class="text-slate-400">aripah / aripah123</span></p>
        </div>
    </div>
</body>
</html>
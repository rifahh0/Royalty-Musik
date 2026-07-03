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
<body class="p-6 md:p-12 min-h-screen flex items-center justify-center">
    <div class="w-full max-w-xl bg-slate-900/50 border border-slate-800 rounded-3xl p-8 backdrop-blur-2xl shadow-2xl">
        <div class="mb-6">
            <span class="text-xs text-indigo-400 font-semibold tracking-wider uppercase">Form Data Transaksi</span>
            <h2 class="text-2xl font-bold text-white mt-1">Input Distribusi Royalti</h2>
        </div>

        <form action="/royalty/store" method="post" class="space-y-5">
            <?= csrf_field() ?>
            <div>
                <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Judul Lagu</label>
                <input type="text" name="song_title" class="w-full bg-slate-950 border border-slate-700 rounded-xl px-4 py-3 text-slate-200 focus:outline-none focus:border-indigo-500 font-medium text-sm text-sm" required placeholder="Contoh: Wonderwall">
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Nama Musisi / Band</label>
                <input type="text" name="musician_name" class="w-full bg-slate-950 border border-slate-700 rounded-xl px-4 py-3 text-slate-200 focus:outline-none focus:border-indigo-500 font-medium text-sm text-sm" required placeholder="Contoh: Oasis">
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Sumber Pendapatan Komersial</label>
                <select name="income_source" class="w-full bg-slate-950 border border-slate-700 rounded-xl px-4 py-3 text-slate-200 focus:outline-none focus:border-indigo-500 font-medium text-sm text-sm" required>
                    <option value="Platform Streaming Digital">Platform Streaming Digital</option>
                    <option value="Konser Musik Komersial">Konser Musik Komersial</option>
                    <option value="Radio & Televisi Penyiaran">Radio & Televisi Penyiaran</option>
                    <option value="Tempat Karaoke Keluarga">Tempat Karaoke Keluarga</option>
                    <option value="Restoran, Cafe, & Bar">Restoran, Cafe, & Bar</option>
                </select>
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Jumlah Pemutaran / Penggunaan</label>
                <input type="number" name="plays_count" class="w-full bg-slate-950 border border-slate-700 rounded-xl px-4 py-3 text-slate-200 focus:outline-none focus:border-indigo-500 font-medium text-sm text-sm" required min="0" placeholder="0">
                <p class="text-xs text-slate-500 mt-1.5">*Sistem mengkalkulasi otomatis dengan rate tarif Rp 150 / play.</p>
            </div>

            <div class="pt-4 space-y-2">
                <button type="submit" class="w-full py-3.5 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-xl tracking-wide transition-all shadow-lg shadow-indigo-600/20">Simpan & Kunci Hash</button>
                <a href="/royalty" class="w-full block py-3.5 bg-slate-800 hover:bg-slate-700 border border-slate-700 text-slate-300 text-center font-semibold rounded-xl text-sm">Kembali</a>
            </div>
        </form>
    </div>
</body>
</html>
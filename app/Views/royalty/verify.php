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
    <div class="w-full max-w-2xl bg-slate-900/50 border border-slate-800 rounded-3xl p-8 backdrop-blur-2xl shadow-2xl">
        <h2 class="text-xl font-bold text-center tracking-wide mb-6">Portal Audit Kedaulatan & Integritas Data</h2>

        <div class="mb-6">
            <?php if ($isValid) : ?>
                <div class="p-6 bg-emerald-500/10 border border-emerald-500/20 rounded-2xl text-center">
                    <div class="w-12 h-12 bg-emerald-500/20 text-emerald-400 rounded-full flex items-center justify-center mx-auto text-xl mb-3">✓</div>
                    <h3 class="text-lg font-bold text-emerald-400">Data Valid (Terverifikasi)</h3>
                    <p class="text-xs text-slate-400 mt-1 max-w-md mx-auto">Nilai transaksi saat ini cocok murni secara kriptografis dengan kode hash awal. Data terbukti berdaulat, transparan, dan bebas dari manipulasi pihak luar.</p>
                </div>
            <?php else : ?>
                <div class="p-6 bg-rose-500/10 border border-rose-500/20 rounded-2xl text-center">
                    <div class="w-12 h-12 bg-rose-500/20 text-rose-400 rounded-full flex items-center justify-center mx-auto text-xl mb-3">⚠️</div>
                    <h3 class="text-lg font-bold text-rose-400">Data Rusak / Dimanipulasi!</h3>
                    <p class="text-xs text-slate-400 mt-1 max-w-md mx-auto">Peringatan Kritis! Log data transaksi di database telah diubah secara paksa di luar sistem tanpa melalui otorisasi aplikasi yang sah.</p>
                </div>
            <?php endif; ?>
        </div>

        <div class="bg-slate-950 border border-slate-800 rounded-2xl p-5 space-y-4 text-sm">
            <div class="flex justify-between border-b border-slate-800 pb-2">
                <span class="text-slate-500">Judul Karya / Musisi</span>
                <span class="font-semibold text-white text-right"><?= esc($royalty['song_title']) ?> <span class="text-xs text-slate-400">(<?= esc($royalty['musician_name']) ?>)</span></span>
            </div>
            <div class="flex justify-between border-b border-slate-800 pb-2">
                <span class="text-slate-500">Sumber Komersial</span>
                <span class="text-slate-300 font-medium"><?= esc($royalty['income_source']) ?></span>
            </div>
            <div class="flex justify-between border-b border-slate-800 pb-2">
                <span class="text-slate-500">Jumlah Pemutaran</span>
                <span class="font-mono text-slate-300"><?= number_format($royalty['plays_count']) ?> Kali</span>
            </div>
            <div class="flex justify-between border-b border-slate-800 pb-2">
                <span class="text-slate-500">Total Nominal Royalti</span>
                <span class="font-semibold text-indigo-400">Rp <?= number_format($royalty['total_royalty'], 2, ',', '.') ?></span>
            </div>
            <div class="space-y-1.5 pt-2">
                <span class="text-xs text-slate-500 block uppercase tracking-wider font-semibold">Tanda Tangan Hash Terdaftar (Di database)</span>
                <p class="p-3 bg-slate-900 border border-slate-800 rounded-xl font-mono text-xs text-slate-400 break-all select-all"><?= $royalty['hash_code'] ?></p>
            </div>
        </div>

        <a href="/royalty" class="mt-6 block w-full py-3 bg-slate-800 hover:bg-slate-700 text-slate-300 text-center font-semibold rounded-xl text-sm border border-slate-700">Kembali ke Dashboard</a>
    </div>
</body>
</html>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Plus Jakarta Sans', sans-serif; background: #0f172a; color: #f8fafc; }</style>
</head>
<body class="p-6 md:p-12 min-h-screen">
    <?php if(!session()->has('role')): header("Location: /login"); exit(); endif; ?>

    <div class="max-w-7xl mx-auto">
        
        <div class="flex justify-between items-center border-b border-slate-800/60 pb-4 mb-6">
            <div class="flex items-center gap-2 text-xs">
                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-ping"></span>
                <span class="text-slate-400">Sesi Aktif: <strong class="text-slate-200"><?= session()->get('username') ?></strong> 
                (<span class="text-indigo-400 font-semibold"><?= session()->get('role') ?></span>)</span>
            </div>
            <a href="/logout" class="text-xs font-semibold text-rose-400 hover:text-rose-300 transition-colors">Keluar Portal →</a>
        </div>

        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-4">
            <div>
                <span class="text-xs font-semibold tracking-widest text-indigo-400 uppercase">Digital Trust Sovereignty Platform</span>
                <h1 class="text-3xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-white to-slate-400">🎵 Royalty Management System</h1>
            </div>
            <?php if (session()->get('role') === 'Admin') : ?>
                <a href="/royalty/create" class="px-5 py-3 bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white font-semibold rounded-xl shadow-lg shadow-indigo-500/20 transition-all">+ Tambah Transaksi Royalti</a>
            <?php endif; ?>
        </div>

        <?php if (session()->getFlashdata('success')) : ?>
            <div class="mb-6 p-4 bg-emerald-500/10 border border-emerald-500/30 rounded-xl text-emerald-400 text-sm flex items-center gap-2">
                <span>✓</span> <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
            <div class="bg-slate-800/40 border border-slate-700/50 rounded-2xl p-6 backdrop-blur-xl">
                <p class="text-slate-400 text-sm font-medium">Total Katalog Lagu</p>
                <p class="text-3xl font-bold mt-2 text-white"><?= $totalSongs ?> <span class="text-sm font-normal text-slate-500">Karya</span></p>
            </div>
            <div class="bg-slate-800/40 border border-slate-700/50 rounded-2xl p-6 backdrop-blur-xl">
                <p class="text-slate-400 text-sm font-medium">Akumulasi Distribusi Royalti</p>
                <p class="text-3xl font-bold mt-2 text-indigo-400">Rp <?= number_format($totalAmount, 2, ',', '.') ?></p>
            </div>
            <div class="bg-slate-800/40 border border-slate-700/50 rounded-2xl p-6 backdrop-blur-xl flex flex-col justify-between">
                <p class="text-slate-400 text-sm font-medium">Status Integritas Basis Data</p>
                <?php if ($systemHealthy) : ?>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 w-fit mt-3">✓ Semua Data Aman (Valid)</span>
                <?php else : ?>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-rose-500/10 text-rose-400 border border-rose-500/20 w-fit mt-3">⚠️ Peringatan: Data Dimanipulasi!</span>
                <?php endif; ?>
            </div>
        </div>

        <div class="bg-slate-800/20 border border-slate-800 rounded-2xl p-4 mb-6 flex justify-end">
            <form action="/royalty" method="get" class="flex gap-2 w-full md:w-96">
                <input type="text" name="search" class="bg-slate-900 border border-slate-700 rounded-xl px-4 py-2 w-full text-sm text-slate-300 focus:outline-none focus:border-indigo-500" placeholder="Cari lagu, musisi, atau sumber..." value="<?= esc($search) ?>">
                <button type="submit" class="px-4 py-2 bg-slate-700 hover:bg-slate-600 text-white rounded-xl text-sm font-semibold transition-all">Cari</button>
            </form>
        </div>

        <div class="bg-slate-900/60 border border-slate-800 rounded-2xl overflow-hidden shadow-2xl">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-800/50 border-b border-slate-800 text-slate-400 text-xs font-semibold tracking-wider uppercase">
                            <th class="p-4">Karya Musik & Pembuat</th>
                            <th class="p-4">Sumber Pendapatan</th>
                            <th class="p-4">Jumlah Pemutaran</th>
                            <th class="p-4">Total Royalti</th>
                            <th class="p-4">Hash Keamanan (SHA-256)</th>
                            <th class="p-4 text-center">Aksi Operasional</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800/60 text-sm text-slate-300">
                        <?php if (!empty($royalties)) : foreach ($royalties as $row) : ?>
                            <tr class="hover:bg-slate-800/30 transition-colors">
                                <td class="p-4">
                                    <p class="font-semibold text-white"><?= esc($row['song_title']) ?></p>
                                    <p class="text-xs text-slate-500"><?= esc($row['musician_name']) ?></p>
                                </td>
                                <td class="p-4">
                                    <span class="px-2 py-1 bg-slate-800 border border-slate-700 rounded-md text-xs text-slate-400"><?= esc($row['income_source']) ?></span>
                                </td>
                                <td class="p-4 font-mono"><?= number_format($row['plays_count']) ?> ×</td>
                                <td class="p-4 text-indigo-400 font-semibold">Rp <?= number_format($row['total_royalty'], 2, ',', '.') ?></td>
                                <td class="p-4 font-mono text-xs text-slate-600 max-w-[150px] truncate" title="<?= $row['hash_code'] ?>">
                                    <?= $row['hash_code'] ?>
                                </td>
                                <td class="p-4 text-center">
                                    <div class="flex gap-2 justify-center items-center">
                                        <a href="/royalty/verify/<?= $row['id'] ?>" class="px-3 py-1.5 bg-indigo-500/10 hover:bg-indigo-500 text-indigo-400 hover:text-white rounded-lg border border-indigo-500/20 text-xs font-semibold transition-all">🛡️ Audit</a>
                                        
                                        <?php if (session()->get('role') === 'Admin') : ?>
                                            <a href="/royalty/edit/<?= $row['id'] ?>" class="px-3 py-1.5 bg-amber-500/10 hover:bg-amber-500 text-amber-400 hover:text-white rounded-lg border border-amber-500/20 text-xs font-semibold transition-all">Edit</a>
                                            <a href="/royalty/delete/<?= $row['id'] ?>" class="px-3 py-1.5 bg-rose-500/10 hover:bg-rose-500 text-rose-400 hover:text-white rounded-lg border border-rose-500/20 text-xs font-semibold transition-all" onclick="return confirm('Hapus data transaksi ini?')">Hapus</a>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; else : ?>
                            <tr>
                                <td colspan="6" class="p-10 text-center text-slate-500">Belum ada rekaman data transaksi royalti di dalam database.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-6 flex justify-between items-center text-sm text-slate-500">
            <div>Menampilkan entri data berkala</div>
            <div class="bg-slate-900 border border-slate-800 rounded-xl px-4 py-2">
                <?= $pager->links('royalty_group', 'default_full') ?>
            </div>
        </div>
    </div>
</body>
</html>
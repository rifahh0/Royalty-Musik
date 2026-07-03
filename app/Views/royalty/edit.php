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
            <span class="text-xs text-amber-400 font-semibold tracking-wider uppercase">Amandemen Berkas Resmi</span>
            <h2 class="text-2xl font-bold text-white mt-1">Perbarui Log Royalti Musisi</h2>
        </div>

        <form action="/royalty/update/<?= $royalty['id'] ?>" method="post" class="space-y-5">
            <?= csrf_field() ?>
            <div>
                <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Judul Karya Musik</label>
                <input type="text" name="song_title" class="w-full bg-slate-950 border border-slate-700 rounded-xl px-4 py-3 text-slate-200 focus:outline-none focus:border-indigo-500 font-medium text-sm transition-all" value="<?= esc($royalty['song_title']) ?>" required>
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Musisi / Pemegang Hak Cipta</label>
                <input type="text" name="musician_name" class="w-full bg-slate-950 border border-slate-700 rounded-xl px-4 py-3 text-slate-200 focus:outline-none focus:border-indigo-500 font-medium text-sm transition-all" value="<?= esc($royalty['musician_name']) ?>" required>
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Sektor Sumber Pendapatan</label>
                <select name="income_source" class="w-full bg-slate-950 border border-slate-700 rounded-xl px-4 py-3 text-slate-200 focus:outline-none focus:border-indigo-500 font-medium text-sm transition-all" required>
                    <?php 
                    $options = [
                        "Tempat Karaoke Umum/Keluarga", "Hotel & Penginapan", 
                        "Restoran, Cafe, & Bar", "Konser Musik Komersial", 
                        "Radio & Televisi Penyiaran", "Platform Streaming Digital Terikat"
                    ];
                    foreach($options as $opt):
                    ?>
                        <option value="<?= $opt ?>" <?= $royalty['income_source'] == $opt ? 'selected' : '' ?>><?= $opt ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Intensitas Penggunaan / Frekuensi Pemutaran</label>
                <input type="number" name="plays_count" class="w-full bg-slate-950 border border-slate-700 rounded-xl px-4 py-3 text-slate-200 focus:outline-none focus:border-indigo-500 font-medium text-sm transition-all" value="<?= $royalty['plays_count'] ?>" required min="0">
            </div>

            <div class="pt-4 space-y-2">
                <button type="submit" class="w-full py-3.5 bg-amber-600 hover:bg-amber-700 text-white font-semibold rounded-xl tracking-wide transition-all shadow-lg shadow-amber-600/20">Simpan Amandemen & Regenerasi Hash</button>
                <a href="/royalty" class="w-full block py-3.5 bg-slate-800 hover:bg-slate-700 border border-slate-700 text-slate-300 text-center font-semibold rounded-xl transition-all text-sm">Batal</a>
            </div>
        </form>
    </div>
</body>
</html>
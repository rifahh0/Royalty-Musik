<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\RoyaltyModel;

class RoyaltyController extends BaseController
{
    protected $royaltyModel;
    protected $ratePerPlay = 150; 

    public function __construct()
    {
        $this->royaltyModel = new RoyaltyModel();
    }

    public function index()
    {
        $search = $this->request->getVar('search');
        
        if ($search) {
            $this->royaltyModel->like('song_title', $search)
                               ->orLike('musician_name', $search)
                               ->orLike('income_source', $search);
        }

        $db = \Config\Database::connect();
        $totalSongs = $db->table('royalties')->countAllResults();
        $totalAmount = $db->table('royalties')->selectSum('total_royalty')->get()->getRow()->total_royalty ?? 0;
        
        $allData = $this->royaltyModel->findAll();
        $systemHealthy = true;
        foreach ($allData as $row) {
            if (!$this->royaltyModel->checkIntegrity($row['id'])) {
                $systemHealthy = false;
                break;
            }
        }

        $data = [
            'title'         => 'Dashboard Sistem Manajemen Royalti Musik',
            'royalties'     => $this->royaltyModel->paginate(5, 'royalty_group'),
            'pager'         => $this->royaltyModel->pager,
            'search'        => $search,
            'totalSongs'    => $totalSongs,
            'totalAmount'   => $totalAmount,
            'systemHealthy' => $systemHealthy
        ];

        return view('royalty/index', $data);
    }

    public function viewCreate()
    {
        return view('royalty/create', ['title' => 'Input Transaksi Royalti Baru']);
    }

    public function store()
    {
        $playsCount   = (int)$this->request->getPost('plays_count');
        $totalRoyalty = $playsCount * $this->ratePerPlay;

        $this->royaltyModel->insert([
            'song_title'    => $this->request->getPost('song_title'),
            'musician_name' => $this->request->getPost('musician_name'),
            'income_source' => $this->request->getPost('income_source'),
            'plays_count'   => $playsCount,
            'total_royalty' => $totalRoyalty
        ]);

        return redirect()->to('/royalty')->with('success', 'Transaksi royalti berhasil ditambahkan dan dikunci dengan enkripsi Hash.');
    }

    public function viewEdit($id)
    {
        $dataRow = $this->royaltyModel->find($id);
        if (!$dataRow) {
            return redirect()->to('/royalty')->with('error', 'Data transaksi tidak ditemukan.');
        }

        return view('royalty/edit', [
            'title'   => 'Edit Data Transaksi Royalti',
            'royalty' => $dataRow
        ]);
    }

    public function update($id)
    {
        $playsCount   = (int)$this->request->getPost('plays_count');
        $totalRoyalty = $playsCount * $this->ratePerPlay;

        $this->royaltyModel->update($id, [
            'song_title'    => $this->request->getPost('song_title'),
            'musician_name' => $this->request->getPost('musician_name'),
            'income_source' => $this->request->getPost('income_source'),
            'plays_count'   => $playsCount,
            'total_royalty' => $totalRoyalty
        ]);

        return redirect()->to('/royalty')->with('success', 'Data diperbarui. Nilai hash baru berhasil diregenerasi otomatis.');
    }

    public function delete($id)
    {
        $this->royaltyModel->delete($id);
        return redirect()->to('/royalty')->with('success', 'Data transaksi berhasil dihapus dari sistem.');
    }

    public function verify($id)
    {
        $dataRow = $this->royaltyModel->find($id);
        if (!$dataRow) {
            return redirect()->to('/royalty')->with('error', 'Data tidak tersedia untuk diaudit.');
        }

        $isValid = $this->royaltyModel->checkIntegrity($id);

        return view('royalty/verify', [
            'title'   => 'Portal Audit Integritas Kriptografi',
            'royalty' => $dataRow,
            'isValid' => $isValid
        ]);
    }

    public function login()
    {
        if (session()->has('role')) {
            return redirect()->to('/royalty');
        }
        return view('royalty/login', ['title' => 'Secure Auth - Access Portal']);
    }

    public function auth()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        if ($username === 'admin' && $password === 'admin123') {
            session()->set(['username' => 'Administrator', 'role' => 'Admin']);
            return redirect()->to('/royalty')->with('success', 'Autentikasi Berhasil. Selamat Datang Admin.');
    }   elseif ($username === 'aripah' && $password === 'aripah123') {
            session()->set(['username' => 'Oasis Management', 'role' => 'User']);
            return redirect()->to('/royalty')->with('success', 'Autentikasi Berhasil. Selamat Datang Musisi.');
        }

            return redirect()->to('/login')->with('error', 'Kombinasi sandi / akun salah!');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
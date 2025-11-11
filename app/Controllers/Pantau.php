<?php

namespace App\Controllers;

use App\Models\BebanKerjaModel;
use App\Models\MasterKegiatanModel;

class Pantau extends BaseController
{
    protected $bebanModel;
    protected $kegiatanModel;

    public function __construct()
    {
        $this->bebanModel = new BebanKerjaModel();
        $this->kegiatanModel = new MasterKegiatanModel();
    }

    protected function getUser()
    {
        $user = session()->get('user');
        if (!$user) {
            return redirect()->to('/login'); // asumsikan route login
        }
        return $user;
    }

    public function index()
    {
        $user = session()->get('user');
        $data['kegiatan'] = $this->kegiatanModel->getKegiatanByRole($user);
        $data['beban'] = $this->bebanModel->getDataByRole($user);
        return view('pantau/index', $data);
    }

    public function master()
    {
        $user = session()->get('user');
        $data['kegiatan'] = $this->kegiatanModel->getKegiatanByRole($user);
        return view('pantau/master', $data);
    }

    public function tambahKegiatan()
    {
        $user = session()->get('user');
        // validasi sederhana
        $rules = [
            'nama_kegiatan' => 'required',
        ];
        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', 'Nama kegiatan wajib diisi.');
        }
        $this->kegiatanModel->save([
            'nama_kegiatan' => $this->request->getPost('nama_kegiatan'),
            'tahun' => $this->request->getPost('tahun'),
            'awal_pengerjaan' => $this->request->getPost('awal_pengerjaan'),
            'deadline' => $this->request->getPost('deadline'),
            'keterangan' => $this->request->getPost('keterangan'),
            'created_by' => $user['id']
        ]);
        return redirect()->back()->with('success', 'Kegiatan ditambahkan.');
    }

    public function bebanKerja()
    {
        $user = session()->get('user');
        $data['beban'] = $this->bebanModel->getDataByRole($user);
        return view('pantau/beban_kerja', $data);
    }

    public function detail($id)
    {
        $user = session()->get('user');
        // ambil kegiatan & cek akses
        $keg = $this->kegiatanModel->find($id);
        if (!$keg) return redirect()->to('/pantau')->with('error', 'Kegiatan tidak ditemukan.');

        // akses control: jika ketua_tim, pastikan created_by == user.id
        if ($user['role'] === 'ketua_tim' && $keg['created_by'] != $user['id']) {
            return redirect()->to('/pantau')->with('error', 'Anda tidak berhak melihat kegiatan ini.');
        }
        // anggota hanya jika dia terlibat
        if ($user['role'] === 'anggota') {
            $db = \Config\Database::connect();
            $has = $db->table('beban_kerja')->where('id_kegiatan', $id)->where('id_pegawai', $user['id'])->get()->getRowArray();
            if (!$has) return redirect()->to('/pantau')->with('error', 'Anda tidak terlibat pada kegiatan ini.');
        }

        // ambil beban kerja untuk kegiatan ini (yang boleh dilihat user)
        $db = \Config\Database::connect();
        $builder = $db->table('beban_kerja')->select('beban_kerja.*, users.nama as nama_pegawai')
            ->join('users', 'users.id=beban_kerja.id_pegawai')
            ->where('id_kegiatan', $id);

        // jika ketua_tim: hanya kegiatan yang dibuatnya — sudah dicek di atas
        // jika anggota: hanya baris dirinya
        if ($user['role'] === 'anggota') {
            $builder->where('id_pegawai', $user['id']);
        }
        $data['kegiatan'] = $keg;
        $data['items'] = $builder->get()->getResultArray();
        return view('pantau/detail', $data);
    }

    public function updateRealisasi()
    {
        $user = session()->get('user');
        $id = $this->request->getPost('id');
        $realisasi = (float)$this->request->getPost('realisasi');

        // ambil row
        $row = $this->bebanModel->find($id);
        if (!$row) return redirect()->back()->with('error', 'Data tidak ditemukan.');

        // hak akses: ketua_tim hanya bisa untuk kegiatan yang dia buat; anggota hanya bisa update realisasi untuk dirinya?
        $keg = (new \App\Models\MasterKegiatanModel())->find($row['id_kegiatan']);
        if ($user['role'] === 'ketua_tim' && $keg['created_by'] != $user['id']) {
            return redirect()->back()->with('error', 'Tidak berhak mengubah data ini.');
        }
        if ($user['role'] === 'anggota' && $row['id_pegawai'] != $user['id']) {
            return redirect()->back()->with('error', 'Tidak berhak mengubah data ini.');
        }

        // hitung persen, aman jika target=0 -> set 0
        $percent = 0;
        if ((float)$row['target'] > 0) {
            $percent = ($realisasi / (float)$row['target']) * 100;
            if ($percent > 100) $percent = 100;
        }

        $this->bebanModel->update($id, [
            'realisasi' => $realisasi,
            'progress_persen' => round($percent, 2)
        ]);

        return redirect()->back()->with('success', 'Realisasi diperbarui.');
    }
}

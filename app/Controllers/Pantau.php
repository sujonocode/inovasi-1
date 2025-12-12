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
        $user = session()->get('username');
        if (!$user) {
            return redirect()->to('/login');
        }
        return $user;
    }

    public function index()
    {
        $role2 = session('role2');
        $id = session('user_id');

        $data['role2'] = $role2;
        $data['title'] = ucfirst('Pantau | Dashboard');
        $data['kegiatan'] = $this->kegiatanModel->getKegiatanByRole2AndId($role2, $id);
        $data['beban'] = $this->bebanModel->getBebanByRole2AndId($role2, $id);

        return view('pantau/index', $data);
    }

    public function master()
    {
        $role2 = session('role2');
        $id = session('user_id');

        $data['role2'] = $role2;
        $data['title'] = ucfirst('Pantau | Master Kegiatan');
        $data['kegiatan'] = $this->kegiatanModel->getKegiatanByRole2AndId($role2, $id);

        return view('pantau/master', $data);
    }

    public function tambahKegiatan()
    {
        $role2 = session('role2');
        $id = session('user_id');

        $data['role2'] = $role2;
        $data['title'] = ucfirst('Pantau | Tambah Kegiatan');

        $satuan = $this->request->getPost('satuan');
        $satuan_lain = $this->request->getPost('satuan_lain');

        // Jika yang dipilih "lainnya", maka pakai isian user
        if ($satuan === 'lainnya' && !empty($satuan_lain)) {
            $finalSatuan = $satuan_lain;
        } else {
            $finalSatuan = $satuan;
        }

        $rules = [
            'nama_kegiatan' => 'required',
            'tim' => 'required',
            'satuan' => 'required',
            'tahun' => 'required',
            'bulan' => 'required',
            'awal_pengerjaan' => 'required',
            'deadline' => 'required'
        ];
        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', 'Nama kegiatan wajib diisi.');
        }
        $this->kegiatanModel->save([
            'nama_kegiatan' => $this->request->getPost('nama_kegiatan'),
            'tim' => $this->request->getPost('tim'),
            'satuan' => $finalSatuan,
            'tahun' => $this->request->getPost('tahun'),
            'bulan' => $this->request->getPost('bulan'),
            'awal_pengerjaan' => $this->request->getPost('awal_pengerjaan'),
            'deadline' => $this->request->getPost('deadline'),
            'keterangan' => $this->request->getPost('keterangan'),
            'created_by' => $id
        ]);

        return redirect()->back()->with('success', 'Kegiatan ditambahkan.');
    }

    public function bebanKerja()
    {
        $role2 = session('role2');
        $id = session('user_id');

        $data['role2'] = $role2;
        $data['title'] = ucfirst('Pantau | Beban Kerja');
        $data['beban'] = $this->bebanModel->getBebanByRole2AndId($role2, $id);

        return view('pantau/beban_kerja', $data);
    }

    public function workCalendar()
    {
        $data['title'] = ucfirst('Pantau | Kalender Kerja');

        return view('pantau/work_calendar', $data);
    }

    public function detail($idKegiatan)
    {
        $role2 = session('role2');
        $id = session('user_id');

        $data['role2'] = $role2;
        $data['title'] = ucfirst('Pantau | Dashboard');

        // ambil kegiatan & cek akses
        $keg = $this->kegiatanModel->find($idKegiatan);
        if (!$keg) return redirect()->to('/pantau')->with('error', 'Kegiatan tidak ditemukan.');

        // akses control: jika ketua_tim, pastikan created_by == user.id
        if ($role2 === 'ketua_tim' && $keg['created_by'] != $id) {
            return redirect()->to('/pantau')->with('error', 'Anda tidak berhak melihat kegiatan ini.');
        }
        // anggota hanya jika dia terlibat
        if ($role2 === 'anggota') {
            $db = \Config\Database::connect();
            $has = $db->table('beban_kerja')->where('id_kegiatan', $idKegiatan)->where('id_pegawai', $id)->get()->getRowArray();

            if (!$has) return redirect()->to('/pantau')->with('error', 'Anda tidak terlibat pada kegiatan ini.');
        }

        // ambil beban kerja untuk kegiatan ini (yang boleh dilihat user)
        $db = \Config\Database::connect();
        $builder = $db->table('beban_kerja')->select('beban_kerja.*, users.nama as nama_pegawai')
            ->join('users', 'users.id=beban_kerja.id_pegawai')
            ->where('id_kegiatan', $idKegiatan);

        // jika ketua_tim: hanya kegiatan yang dibuatnya — sudah dicek di atas
        // jika anggota: hanya baris dirinya
        if ($role2 === 'anggota') {
            $builder->where('id_pegawai', $id);
        }
        $data['kegiatan'] = $keg;
        $data['items'] = $builder->get()->getResultArray();

        return view('pantau/detail', $data);
    }

    public function edit($idKegiatan)
    {
        $role2 = session('role2');
        $id = session('user_id');

        $data['role2'] = $role2;
        $data['title'] = ucfirst('Pantau | Edit');

        // ambil kegiatan & cek akses
        $keg = $this->kegiatanModel->find($idKegiatan);
        if (!$keg) return redirect()->to('/pantau')->with('error', 'Kegiatan tidak ditemukan.');

        // akses control: jika ketua_tim, pastikan created_by == user.id
        if ($role2 === 'ketua_tim' && $keg['created_by'] != $id) {
            return redirect()->to('/pantau/master')->with('error', 'Anda tidak berhak mengedit kegiatan ini.');
        }
        // anggota hanya jika dia terlibat
        if ($role2 === 'anggota') {
            $db = \Config\Database::connect();
            $has = $db->table('master_kegiatan')->where('id', $idKegiatan)->where('id_pegawai', $id)->get()->getRowArray();

            if (!$has) return redirect()->to('/pantau/master')->with('error', 'Anda tidak terlibat pada kegiatan ini.');
        }

        $data['kegiatan'] = $this->kegiatanModel->find($idKegiatan);
        return view('pantau/edit', $data);
    }

    public function update($id)
    {
        $satuan = $this->request->getPost('satuan');

        // Jika user mengisi "lainnya", ambil dari input teks
        if ($satuan === 'lainnya') {
            $satuan = $this->request->getPost('satuan_lain');
        }

        $this->kegiatanModel->update($id, [
            'nama_kegiatan'     => $this->request->getPost('nama_kegiatan'),
            'tim'               => $this->request->getPost('tim'),
            'satuan'            => $satuan,
            'tahun'             => $this->request->getPost('tahun'),
            'bulan'             => $this->request->getPost('bulan'),
            'awal_pengerjaan'   => $this->request->getPost('awal_pengerjaan'),
            'deadline'          => $this->request->getPost('deadline'),
            'keterangan'        => $this->request->getPost('keterangan'),
        ]);

        return redirect()->to('/pantau/master')->with('success', 'Kegiatan berhasil diperbarui.');
    }

    public function delete($idKegiatan)
    {
        $role2 = session('role2');
        $id = session('user_id');

        $data['role2'] = $role2;
        $data['title'] = ucfirst('Pantau | Edit');

        // ambil kegiatan & cek akses
        $keg = $this->kegiatanModel->find($idKegiatan);
        if (!$keg) return redirect()->to('/pantau')->with('error', 'Kegiatan tidak ditemukan.');

        // akses control: jika ketua_tim, pastikan created_by == user.id
        if ($role2 === 'ketua_tim' && $keg['created_by'] != $id) {
            return redirect()->to('/pantau/master')->with('error', 'Anda tidak berhak mengedit kegiatan ini.');
        }
        // anggota hanya jika dia terlibat
        if ($role2 === 'anggota') {
            $db = \Config\Database::connect();
            $has = $db->table('master_kegiatan')->where('id', $idKegiatan)->where('id_pegawai', $id)->get()->getRowArray();

            if (!$has) return redirect()->to('/pantau/master')->with('error', 'Anda tidak terlibat pada kegiatan ini.');
        }

        $this->kegiatanModel->delete($idKegiatan);
        return redirect()->to('/pantau/master')->with('success', 'Kegiatan berhasil dihapus.');
    }

    public function updateRealisasi()
    {
        $role2 = session('role2');
        $id = session('user_id');

        $data['role2'] = $role2;
        $data['title'] = ucfirst('Pantau | Progres');

        $idBebanKerja = $this->request->getPost('id');
        $realisasi = (float)$this->request->getPost('realisasi');

        // ambil row
        $row = $this->bebanModel->find($idBebanKerja);
        if (!$row) return redirect()->back()->with('error', 'Data tidak ditemukan.');

        // hak akses: ketua_tim hanya bisa untuk kegiatan yang dia buat; anggota hanya bisa update realisasi untuk dirinya?
        $keg = (new \App\Models\MasterKegiatanModel())->find($row['id_kegiatan']);
        if ($role2 === 'ketua_tim' && $keg['created_by'] != $id) {
            return redirect()->back()->with('error', 'Tidak berhak mengubah data ini.');
        }
        if ($role2 === 'anggota') {
            return redirect()->back()->with('error', 'Tidak berhak mengubah data ini.');
        }

        // hitung persen, aman jika target=0 -> set 0
        $percent = 0;
        if ((float)$row['target'] > 0) {
            $percent = ($realisasi / (float)$row['target']) * 100;
            if ($percent > 100) $percent = 100;
        }

        $this->bebanModel->update($idBebanKerja, [
            'realisasi' => $realisasi,
            'progress_persen' => round($percent, 2)
        ]);

        return redirect()->back()->with('success', 'Realisasi diperbarui.');
    }
}

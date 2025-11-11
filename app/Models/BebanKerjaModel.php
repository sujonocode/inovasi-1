<?php

namespace App\Models;

use CodeIgniter\Model;

class BebanKerjaModel extends Model
{
    protected $table = 'beban_kerja';
    protected $allowedFields = [
        'id_kegiatan',
        'id_pegawai',
        'peran',
        'target',
        'satuan',
        'realisasi',
        'progress_persen',
        'created_at'
    ];

    // ambil data beban kerja sesuai role user (dipakai di controller)
    public function getDataByRole($user)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('beban_kerja')
            ->select('beban_kerja.*, users.nama as nama_pegawai, master_kegiatan.nama_kegiatan, master_kegiatan.created_by')
            ->join('users', 'users.id = beban_kerja.id_pegawai')
            ->join('master_kegiatan', 'master_kegiatan.id = beban_kerja.id_kegiatan');

        if ($user['role'] === 'ketua_tim') {
            $builder->where('master_kegiatan.created_by', $user['id']);
        } elseif ($user['role'] === 'anggota') {
            $builder->where('beban_kerja.id_pegawai', $user['id']);
        }
        $builder->orderBy('beban_kerja.created_at', 'DESC');
        return $builder->get()->getResultArray();
    }

    // helper cari pegawai berdasarkan nama (untuk upload)
    public function getPegawaiByNama($nama)
    {
        $db = \Config\Database::connect();
        $row = $db->table('users')->where('nama', $nama)->get()->getRowArray();
        return $row;
    }
}

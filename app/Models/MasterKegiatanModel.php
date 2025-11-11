<?php

namespace App\Models;

use CodeIgniter\Model;

class MasterKegiatanModel extends Model
{
    protected $table = 'master_kegiatan';
    protected $allowedFields = [
        'nama_kegiatan',
        'tahun',
        'keterangan',
        'awal_pengerjaan',
        'deadline',
        'created_by',
        'created_at'
    ];

    public function getKegiatanByRole($user)
    {
        if ($user['role'] === 'kepala') {
            return $this->orderBy('created_at', 'DESC')->findAll();
        } elseif ($user['role'] === 'ketua_tim') {
            return $this->where('created_by', $user['id'])->orderBy('created_at', 'DESC')->findAll();
        } else {
            // anggota: join ke beban_kerja untuk mendapatkan kegiatan tempat dia terlibat
            $db = \Config\Database::connect();
            $builder = $db->table('master_kegiatan')
                ->select('master_kegiatan.*')
                ->join('beban_kerja', 'beban_kerja.id_kegiatan = master_kegiatan.id')
                ->where('beban_kerja.id_pegawai', $user['id'])
                ->groupBy('master_kegiatan.id')
                ->orderBy('master_kegiatan.created_at', 'DESC');
            return $builder->get()->getResultArray();
        }
    }
}

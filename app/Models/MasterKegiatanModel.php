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

    public function getKegiatanByRole($user, $name, $id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('master_kegiatan')
            ->select('master_kegiatan.*, users.nama as created_by_name')
            ->join('users', 'users.id = master_kegiatan.created_by', 'left');

        if ($user === 'kepala') {
            $builder->orderBy('master_kegiatan.created_at', 'DESC');
        } elseif ($user === 'ketua_tim') {
            $builder->where('master_kegiatan.created_by', $name)
                ->orderBy('master_kegiatan.created_at', 'DESC');
        } else {
            // anggota: join juga ke tabel beban_kerja
            $builder->join('beban_kerja', 'beban_kerja.id_kegiatan = master_kegiatan.id')
                ->where('beban_kerja.id_pegawai', $id)
                ->groupBy('master_kegiatan.id')
                ->orderBy('master_kegiatan.created_at', 'DESC');
        }

        return $builder->get()->getResultArray();
    }

    public function getKegiatanByRoleAndId($user, $role2, $name, $id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('master_kegiatan')
            ->select('master_kegiatan.*, users.nama as created_by_name')
            ->join('users', 'users.id = master_kegiatan.created_by', 'left');

        if ($role2 === 'kepala') {
            // Kepala: lihat semua kegiatan
            $builder->orderBy('master_kegiatan.created_at', 'DESC');
            return $builder->get()->getResultArray();
        } elseif ($role2 === 'ketua_tim') {
            // Ketua tim: hanya kegiatan yang dia buat
            $builder->where('master_kegiatan.created_by', $id)
                ->orderBy('master_kegiatan.created_at', 'DESC');
            return $builder->get()->getResultArray();
        } else {
            // Anggota: tidak bisa melihat data (return null)
            return null;
        }
    }
}

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

    public function getKegiatanByRole2AndId($role2, $id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('master_kegiatan')
            ->select('master_kegiatan.*, users.nama as created_by_name')
            ->join('users', 'users.id = master_kegiatan.created_by', 'left');

        if ($role2 === 'kepala') {
            $builder->orderBy('master_kegiatan.created_at', 'DESC');
            return $builder->get()->getResultArray();
        } elseif ($role2 === 'ketua_tim') {
            $builder->where('master_kegiatan.created_by', $id)
                ->orderBy('master_kegiatan.created_at', 'DESC');
            return $builder->get()->getResultArray();
        } else {
            return null;
        }
    }
}

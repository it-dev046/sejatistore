<?php

namespace App\Models;

use CodeIgniter\Model;

class AbsenModel extends Model
{
    protected $table            = 'absen';
    protected $primaryKey       = 'id_absen';
    protected $returnType       = 'object';
    protected $allowedFields    = ['tanggal', 'nama', 'status', 'potongan'];


    public function mingguan($tglawal, $tglakhir)
    {
        $query = $this->db->table('absen')
            ->where('DATE(tanggal) >=', $tglawal)
            ->where('DATE(tanggal) <=', $tglakhir)
            ->selectSum('potongan')
            ->get();

        $result = $query->getRow();

        if ($result) {
            return $result->potongan;
        } else {
            return 0;
        }
    }
}

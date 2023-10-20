<?php

namespace App\Models;

use CodeIgniter\Model;

class AbsenModel extends Model
{
    protected $table            = 'absen';
    protected $primaryKey       = 'id_absen';
    protected $returnType       = 'object';
    protected $allowedFields    = ['tanggal', 'nama', 'status', 'potongan'];


    public function mingguan($tglawal, $tglakhir, $nama)
    {
        $query = $this->db->table('absen')
            ->where('DATE(tanggal) >=', $tglawal)
            ->where('DATE(tanggal) <=', $tglakhir)
            ->where('nama', $nama)
            ->selectSum('potongan')
            ->get();

        $result = $query->getRow();

        if ($result) {
            return $result->potongan;
        } else {
            return 0;
        }
    }

    public function bulanan($nama, $bulan, $tahun)
    {
        $tglawal = date("{$tahun}-{$bulan}-01");
        $tglakhir = date("{$tahun}-{$bulan}-t");
        $query = $this->db->table('absen')
            ->where('DATE(tanggal) >=', $tglawal)
            ->where('DATE(tanggal) <=', $tglakhir)
            ->where('nama', $nama)
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

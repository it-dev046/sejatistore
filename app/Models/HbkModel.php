<?php

namespace App\Models;

use CodeIgniter\Model;

class HbkModel extends Model
{
    protected $table            = 'hbk';
    protected $primaryKey       = 'id_hbk';
    protected $returnType       = 'object';
    protected $allowedFields    = ['id_pasang', 'no_hbk', 'kerja', 'tukang', 'total_hbk', 'sisa_hbk', 'gambar', 'pengawas', 'pengawas', 'drafter', 'keterangan'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'tanggal_input';
    protected $updatedField  = 'tanggal_ubah';

    public function isInvoiceExists($no_hbk)
    {
        return $this->where('no_hbk', $no_hbk)->countAllResults() > 0;
    }

    public function countSalesToday()
    {
        $year = date('Y');

        $query = $this->db->table('hbk')
            ->where('YEAR(tanggal_input)', $year)
            ->countAllResults();

        return $query;
    }

    public function jumlahsisa()
    {
        $query = $this->db->table('hbk')
            ->selectSum('sisa_hbk')
            ->get();

        $result = $query->getRow();

        if ($result) {
            return $result->sisa_hbk;
        } else {
            return 0;
        }
    }
}

<?php

namespace App\Models;

date_default_timezone_set("Asia/Manila");

use CodeIgniter\Model;

class PasangModel extends Model
{
    protected $table            = 'pemasangan';
    protected $primaryKey       = 'id_pasang';
    protected $returnType       = 'object';
    protected $allowedFields    = ['invoice', 'tanggal', 'nama', 'alamat', 'sisa', 'biaya', 'kerja', 'gambar', 'keterangan', 'volume', 'no_rbp', 'no_rhb', 'id_survei'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'tanggal_input';
    protected $updatedField  = 'tanggal_ubah';


    public function isInvoiceExists($invoice)
    {
        return $this->where('invoice', $invoice)->countAllResults() > 0;
    }

    public function countSalesToday()
    {
        $year = date('Y');

        $query = $this->db->table('pemasangan')
            ->where('YEAR(tanggal)', $year)
            ->countAllResults();

        return $query;
    }

    public function jumlahsisa()
    {
        $query = $this->db->table('pemasangan')
            ->selectSum('sisa')
            ->get();

        $result = $query->getRow();

        if ($result) {
            return $result->sisa;
        } else {
            return 0;
        }
    }
}

<?php

namespace App\Libraries;

class Terbilang
{
    protected $terbilang = array('', 'Satu', 'Dua', 'Tiga', 'Empat', 'Lima', 'Enam', 'Tujuh', 'Delapan', 'Sembilan', 'Sepuluh', 'Sebelas');

    public function angkaTerbilang($angka)
    {
        if ($angka < 12) {
            return $this->terbilang[$angka];
        } elseif ($angka < 20) {
            return $this->angkaTerbilang($angka - 10) . ' Belas';
        } elseif ($angka < 100) {
            return $this->angkaTerbilang($angka / 10) . ' Puluh ' . $this->angkaTerbilang($angka % 10);
        } elseif ($angka < 200) {
            return 'Seratus ' . $this->angkaTerbilang($angka - 100);
        } elseif ($angka < 1000) {
            return $this->angkaTerbilang($angka / 100) . ' Ratus ' . $this->angkaTerbilang($angka % 100);
        } elseif ($angka < 2000) {
            return 'Seribu ' . $this->angkaTerbilang($angka - 1000);
        } elseif ($angka < 1000000) {
            return $this->angkaTerbilang($angka / 1000) . ' Ribu ' . $this->angkaTerbilang($angka % 1000);
        } elseif ($angka < 1000000000) {
            return $this->angkaTerbilang($angka / 1000000) . ' Juta ' . $this->angkaTerbilang($angka % 1000000);
        } elseif ($angka < 1000000000000) {
            return $this->angkaTerbilang($angka / 1000000000) . ' Milyar ' . $this->angkaTerbilang($angka % 1000000000);
        } elseif ($angka < 1000000000000000) {
            return $this->angkaTerbilang($angka / 1000000000000) . ' Triliun ' . $this->angkaTerbilang($angka % 1000000000000);
        }
    }
}

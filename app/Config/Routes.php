<?php

namespace Config;

$this->session = session();
$level = $this->session->get('level');
$status = $this->session->get('status');


// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'BerandaController::index');
$routes->get('cetak/stok', 'CetakController::daftarstok');
$routes->get('orderan', 'CetakController::daftarorder');
$routes->get('order/nota/gambar/(:num)', 'OrderController::unduhnota/$1');
$routes->get('order/bukti/gambar/(:num)', 'OrderController::unduhbukti/$1');

$routes->group('register', function ($routes) {
    $routes->get('/', 'RegisterController::index');
    $routes->post('/', 'RegisterController::store');
});

$routes->group('login', function ($routes) {
    $routes->get('/', 'LoginController::index');
    $routes->post('/', 'LoginController::login');
});

$routes->group('logout', function ($routes) {
    $routes->get('/', 'LogoutController::index');
});

if ($level == "1") {

    $routes->get('/dashboard', 'Dashboard::index', ['filter' => 'isLoggedIn']);

    $routes->get('produk', 'ProdukController::index', ['filter' => 'isLoggedIn']);
    $routes->get('produk/tambah', 'ProdukController::tambah', ['filter' => 'isLoggedIn']);
    $routes->post('produk/simpan', 'ProdukController::store', ['filter' => 'isLoggedIn']);
    $routes->post('produk/ambilKategori', 'ProdukController::ambilKategori', ['filter' => 'isLoggedIn']);
    $routes->post('produk/ambilProduk', 'ProdukController::ambilProduk', ['filter' => 'isLoggedIn']);
    $routes->get('produk/(:segment)/preview', 'ProdukController::preview/$1', ['filter' => 'isLoggedIn']);
    $routes->put('produk/ubah/(:num)', 'ProdukController::update/$1', ['filter' => 'isLoggedIn']);
    $routes->delete('produk/hapus/(:num)', 'ProdukController::destroy/$1', ['filter' => 'isLoggedIn']);

    $routes->get('/import', 'importController::index', ['filter' => 'isLoggedIn']);
    $routes->post('/import/produk', 'importController::produk', ['filter' => 'isLoggedIn']);
    $routes->get('/import/download', 'importController::download', ['filter' => 'isLoggedIn']);

    $routes->get('satuan', 'SatuanController::index', ['filter' => 'isLoggedIn']);
    $routes->post('satuan/tambah', 'SatuanController::store', ['filter' => 'isLoggedIn']);
    $routes->put('satuan/ubah/(:num)', 'SatuanController::update/$1', ['filter' => 'isLoggedIn']);
    $routes->delete('satuan/hapus/(:num)', 'SatuanController::destroy/$1', ['filter' => 'isLoggedIn']);

    $routes->get('kategori', 'KategoriController::index', ['filter' => 'isLoggedIn']);
    $routes->post('kategori/tambah', 'KategoriController::store', ['filter' => 'isLoggedIn']);
    $routes->put('kategori/ubah/(:num)', 'KategoriController::update/$1', ['filter' => 'isLoggedIn']);
    $routes->delete('kategori/hapus/(:num)', 'KategoriController::destroy/$1', ['filter' => 'isLoggedIn']);

    $routes->get('ongkir', 'OngkirController::index', ['filter' => 'isLoggedIn']);
    $routes->post('ongkir/tambah', 'OngkirController::store', ['filter' => 'isLoggedIn']);
    $routes->put('ongkir/ubah/(:num)', 'OngkirController::update/$1', ['filter' => 'isLoggedIn']);
    $routes->delete('ongkir/hapus/(:num)', 'OngkirController::destroy/$1', ['filter' => 'isLoggedIn']);

    $routes->get('/subkategori', 'SubkategoriController::index', ['filter' => 'isLoggedIn']);
    $routes->post('subkategori/tambah', 'SubkategoriController::store', ['filter' => 'isLoggedIn']);
    $routes->put('subkategori/ubah/(:num)', 'SubkategoriController::update/$1', ['filter' => 'isLoggedIn']);
    $routes->delete('subkategori/hapus/(:num)', 'SubkategoriController::destroy/$1', ['filter' => 'isLoggedIn']);

    $routes->get('/pelanggan', 'PelangganController::index', ['filter' => 'isLoggedIn']);
    $routes->post('pelanggan/tambah', 'PelangganController::store', ['filter' => 'isLoggedIn']);
    $routes->put('pelanggan/ubah/(:num)', 'PelangganController::update/$1', ['filter' => 'isLoggedIn']);
    $routes->delete('pelanggan/hapus/(:num)', 'PelangganController::destroy/$1', ['filter' => 'isLoggedIn']);

    $routes->get('/katepel', 'KatepelController::index', ['filter' => 'isLoggedIn']);
    $routes->post('katepel/tambah', 'KatepelController::store', ['filter' => 'isLoggedIn']);
    $routes->put('katepel/ubah/(:num)', 'KatepelController::update/$1', ['filter' => 'isLoggedIn']);
    $routes->delete('katepel/hapus/(:num)', 'KatepelController::destroy/$1', ['filter' => 'isLoggedIn']);

    $routes->get('/penjualan', 'PenjualanController::index', ['filter' => 'isLoggedIn']);
    $routes->get('/penjualan/(:segment)/preview', 'PenjualanController::preview/$1', ['filter' => 'isLoggedIn']);
    $routes->delete('/penjualan/(:segment)/hapus', 'PenjualanController::destroy/$1', ['filter' => 'isLoggedIn']);
    $routes->get('/detail/(:segment)/hapus', 'PenjualanController::hapusdetail/$1', ['filter' => 'isLoggedIn']);

    $routes->get('kasir', 'KasirController::index', ['filter' => 'isLoggedIn']);
    $routes->get('kasir/cek', 'KasirController::cek', ['filter' => 'isLoggedIn']);
    $routes->post('kasir/add', 'KasirController::add', ['filter' => 'isLoggedIn']);
    $routes->post('kasir/update', 'KasirController::update', ['filter' => 'isLoggedIn']);
    $routes->post('kasir/potongan', 'KasirController::potongan', ['filter' => 'isLoggedIn']);
    $routes->get('kasir/clear', 'KasirController::clear', ['filter' => 'isLoggedIn']);
    $routes->put('kasir/simpanfaktur', 'KasirController::simpanfaktur', ['filter' => 'isLoggedIn']);
    $routes->get('kasir/keranjang', 'KasirController::keranjang', ['filter' => 'isLoggedIn']);
    $routes->get('kasir/delete', 'KasirController::delete', ['filter' => 'isLoggedIn']);
    $routes->get('kasir/(:segment)/delete', 'KasirController::delete/$1', ['filter' => 'isLoggedIn']);
    $routes->get('kasir/(:segment)/update', 'KasirController::ubahkeranjang/$1', ['filter' => 'isLoggedIn']);
    $routes->get('kasir/hapus', 'KasirController::destroy', ['filter' => 'isLoggedIn']);
    $routes->get('kasir/(:segment)/simpan', 'KasirController::store/$1', ['filter' => 'isLoggedIn']);

    $routes->get('cetak/(:segment)/nota', 'CetakController::nota/$1', ['filter' => 'isLoggedIn']);
    $routes->get('cetak/(:segment)/suratjalan', 'CetakController::suratjalan/$1', ['filter' => 'isLoggedIn']);

    $routes->get('/retrun', 'RetrunController::index', ['filter' => 'isLoggedIn']);
    $routes->get('/retrun/pilih', 'RetrunController::pilihtrans', ['filter' => 'isLoggedIn']);
    $routes->put('/retrun/tambah/(:num)', 'RetrunController::store/$1', ['filter' => 'isLoggedIn']);
    $routes->delete('/retrun/hapus/(:num)', 'RetrunController::destroy/$1', ['filter' => 'isLoggedIn']);
    $routes->get('/retrun/(:segment)/preview', 'RetrunController::preview/$1', ['filter' => 'isLoggedIn']);

    $routes->get('/laporan/stok', 'LaporanController::stok', ['filter' => 'isLoggedIn']);
    $routes->get('/laporan/penjualan', 'LaporanController::penjualan', ['filter' => 'isLoggedIn']);
    $routes->get('/laporan/pelanggan', 'LaporanController::pelanggan', ['filter' => 'isLoggedIn']);
    $routes->get('/laporan/barang', 'LaporanController::barang', ['filter' => 'isLoggedIn']);

    $routes->get('/page/home', 'PageController::home', ['filter' => 'isLoggedIn']);
    $routes->put('/page/home/ubah/(:num)', 'PageController::homeupdate/$1', ['filter' => 'isLoggedIn']);
    $routes->put('/page/usaha/ubah/(:num)', 'PageController::usahaupdate/$1', ['filter' => 'isLoggedIn']);
    $routes->put('/page/about/ubah/(:num)', 'PageController::aboutupdate/$1', ['filter' => 'isLoggedIn']);
    $routes->post('/page/proyek/tambah', 'PageController::proyekstore', ['filter' => 'isLoggedIn']);
    $routes->put('/page/proyek/ubah/(:num)', 'PageController::proyekupdate/$1', ['filter' => 'isLoggedIn']);
    $routes->put('/page/proyek/ubahdata/(:num)', 'PageController::proyekdataupdate/$1', ['filter' => 'isLoggedIn']);
    $routes->delete('/page/proyek/hapusdata/(:num)', 'PageController::destroy/$1', ['filter' => 'isLoggedIn']);
    $routes->put('/page/kontak/ubah/(:num)', 'PageController::kontakupdate/$1', ['filter' => 'isLoggedIn']);
    $routes->get('/page/about', 'PageController::about', ['filter' => 'isLoggedIn']);
    $routes->get('/page/proyek', 'PageController::proyek', ['filter' => 'isLoggedIn']);
    $routes->get('/page/partner', 'PageController::partner', ['filter' => 'isLoggedIn']);
    $routes->get('/page/testimoni', 'PageController::testimoni', ['filter' => 'isLoggedIn']);
    $routes->get('/page/kontak', 'PageController::kontak', ['filter' => 'isLoggedIn']);
    $routes->put('/page/partner/ubah/(:num)', 'PageController::partnerupdate/$1', ['filter' => 'isLoggedIn']);
    $routes->post('/page/partner/tambah', 'PageController::partnerstore', ['filter' => 'isLoggedIn']);
    $routes->put('/page/partner/ubahdata/(:num)', 'PageController::partnerdataupdate/$1', ['filter' => 'isLoggedIn']);
    $routes->delete('/page/partner/hapusdata/(:num)', 'PageController::partnerdestroy/$1', ['filter' => 'isLoggedIn']);

    $routes->put('/page/testimoni/ubah/(:num)', 'PageController::testimoniupdate/$1', ['filter' => 'isLoggedIn']);
    $routes->post('/page/testimoni/tambah', 'PageController::testimonistore', ['filter' => 'isLoggedIn']);
    $routes->put('/page/testimoni/ubahdata/(:num)', 'PageController::testimonidataupdate/$1', ['filter' => 'isLoggedIn']);
    $routes->delete('/page/testimoni/hapusdata/(:num)', 'PageController::testimonidestroy/$1', ['filter' => 'isLoggedIn']);

    $routes->get('user/password', 'UserController::password', ['filter' => 'isLoggedIn']);
    $routes->post('user/password/ubah', 'UserController::changePassword', ['filter' => 'isLoggedIn']);

    $routes->get('bahan', 'BahanController::index', ['filter' => 'isLoggedIn']);
    $routes->post('bahan/tambah', 'BahanController::store', ['filter' => 'isLoggedIn']);
    $routes->put('bahan/ubah/(:num)', 'BahanController::update/$1', ['filter' => 'isLoggedIn']);
    $routes->delete('bahan/hapus/(:num)', 'BahanController::destroy/$1', ['filter' => 'isLoggedIn']);
    $routes->get('bahan/(:segment)/preview', 'BahanController::preview/$1', ['filter' => 'isLoggedIn']);
    $routes->post('bahan/pakai', 'BahanController::store2', ['filter' => 'isLoggedIn']);
    $routes->put('bahan/pakai/ubah/(:num)', 'BahanController::update2/$1', ['filter' => 'isLoggedIn']);
    $routes->delete('bahan/pakai/hapus/(:num)', 'BahanController::destroy2/$1', ['filter' => 'isLoggedIn']);
    $routes->get('cetak/bahan/suratjalan/(:num)', 'CetakController::bahan/$1', ['filter' => 'isLoggedIn']);

    $routes->get('download/produk', 'ProdukController::exportproduk', ['filter' => 'isLoggedIn']);
    $routes->get('download/pelanggan', 'PelangganController::exportpelanggan', ['filter' => 'isLoggedIn']);
    $routes->get('download/penjualan', 'PenjualanController::exportpenjualan', ['filter' => 'isLoggedIn']);

    $routes->get('order', 'OrderController::index', ['filter' => 'isLoggedIn']);
    $routes->post('order/tambah', 'OrderController::store', ['filter' => 'isLoggedIn']);
    $routes->put('order/ubah/(:num)', 'OrderController::update/$1', ['filter' => 'isLoggedIn']);
    $routes->put('order/nota/(:num)', 'OrderController::nota/$1', ['filter' => 'isLoggedIn']);
    $routes->get('order/nota/gambar/(:num)', 'OrderController::unduhnota/$1', ['filter' => 'isLoggedIn']);
    $routes->put('order/bukti/(:num)', 'OrderController::bukti/$1', ['filter' => 'isLoggedIn']);
    $routes->get('order/bukti/gambar/(:num)', 'OrderController::unduhbukti/$1', ['filter' => 'isLoggedIn']);
    $routes->delete('order/hapus/(:num)', 'OrderController::destroy/$1', ['filter' => 'isLoggedIn']);
    $routes->get('order/uraian/(:num)', 'OrderController::uraian/$1', ['filter' => 'isLoggedIn']);
    $routes->post('order/uraian/tambah', 'OrderController::uraiansimpan', ['filter' => 'isLoggedIn']);
    $routes->put('order/uraian/ubah/(:num)', 'OrderController::updateuraian/$1', ['filter' => 'isLoggedIn']);
    $routes->delete('order/uraian/hapus/(:num)', 'OrderController::uraianhapus/$1', ['filter' => 'isLoggedIn']);
    $routes->get('order/uraian/batal/(:num)', 'OrderController::uraianbatal/$1', ['filter' => 'isLoggedIn']);
    $routes->get('order/nota/gambar/(:num)', 'OrderController::unduhnota/$1', ['filter' => 'isLoggedIn']);
    $routes->get('order/bukti/gambar/(:num)', 'OrderController::unduhbukti/$1', ['filter' => 'isLoggedIn']);

    $routes->get('toko', 'TokoController::index', ['filter' => 'isLoggedIn']);
    $routes->post('toko/tambah', 'TokoController::store', ['filter' => 'isLoggedIn']);
    $routes->put('toko/ubah/(:num)', 'TokoController::update/$1', ['filter' => 'isLoggedIn']);
    $routes->delete('toko/hapus/(:num)', 'TokoController::destroy/$1', ['filter' => 'isLoggedIn']);
} elseif ($level == "4") {
    $routes->get('dashboard-survei', 'Dashboard::survei', ['filter' => 'isLoggedIn']);
    $routes->get('survei', 'SurveiController::index', ['filter' => 'isLoggedIn']);
    $routes->post('survei/tambah', 'SurveiController::store', ['filter' => 'isLoggedIn']);
    $routes->get('survei/sketsa/(:num)', 'SurveiController::sketsa/$1', ['filter' => 'isLoggedIn']);
    $routes->put('survei/deal/(:num)', 'SurveiController::deal/$1', ['filter' => 'isLoggedIn']);
    $routes->put('survei/ubah/(:num)', 'SurveiController::update/$1', ['filter' => 'isLoggedIn']);
    $routes->delete('survei/hapus/(:num)', 'SurveiController::destroy/$1', ['filter' => 'isLoggedIn']);

    $routes->get('order', 'OrderController::index', ['filter' => 'isLoggedIn']);
    $routes->post('order/tambah', 'OrderController::store', ['filter' => 'isLoggedIn']);
    $routes->put('order/ubah/(:num)', 'OrderController::update/$1', ['filter' => 'isLoggedIn']);
    $routes->put('order/nota/(:num)', 'OrderController::nota/$1', ['filter' => 'isLoggedIn']);
    $routes->get('order/nota/gambar/(:num)', 'OrderController::unduhnota/$1', ['filter' => 'isLoggedIn']);
    $routes->put('order/bukti/(:num)', 'OrderController::bukti/$1', ['filter' => 'isLoggedIn']);
    $routes->get('order/bukti/gambar/(:num)', 'OrderController::unduhbukti/$1', ['filter' => 'isLoggedIn']);
    $routes->delete('order/hapus/(:num)', 'OrderController::destroy/$1', ['filter' => 'isLoggedIn']);
    $routes->get('order/uraian/(:num)', 'OrderController::uraian/$1', ['filter' => 'isLoggedIn']);
    $routes->post('order/uraian/tambah', 'OrderController::uraiansimpan', ['filter' => 'isLoggedIn']);
    $routes->put('order/uraian/ubah/(:num)', 'OrderController::updateuraian/$1', ['filter' => 'isLoggedIn']);
    $routes->delete('order/uraian/hapus/(:num)', 'OrderController::uraianhapus/$1', ['filter' => 'isLoggedIn']);
    $routes->get('order/uraian/batal/(:num)', 'OrderController::uraianbatal/$1', ['filter' => 'isLoggedIn']);

    $routes->get('user/password', 'UserController::password', ['filter' => 'isLoggedIn']);
    $routes->post('user/password/ubah', 'UserController::changePassword', ['filter' => 'isLoggedIn']);
} elseif ($level == "3") {

    $routes->get('dashboard-drafter', 'Dashboard::drafter', ['filter' => 'isLoggedIn']);

    $routes->get('survei', 'SurveiController::index', ['filter' => 'isLoggedIn']);
    $routes->post('survei/tambah', 'SurveiController::store', ['filter' => 'isLoggedIn']);
    $routes->get('survei/sketsa/(:num)', 'SurveiController::sketsa/$1', ['filter' => 'isLoggedIn']);
    $routes->put('survei/deal/(:num)', 'SurveiController::deal/$1', ['filter' => 'isLoggedIn']);
    $routes->put('survei/ubah/(:num)', 'SurveiController::update/$1', ['filter' => 'isLoggedIn']);
    $routes->delete('survei/hapus/(:num)', 'SurveiController::destroy/$1', ['filter' => 'isLoggedIn']);

    $routes->get('survei/uraian/(:num)', 'SurveiController::uraian/$1', ['filter' => 'isLoggedIn']);
    $routes->post('survei/uraian/tambah', 'SurveiController::uraiansimpan', ['filter' => 'isLoggedIn']);
    $routes->put('survei/uraian/total/(:num)', 'SurveiController::updatetotal/$1', ['filter' => 'isLoggedIn']);
    $routes->put('survei/uraian/ubah/(:num)', 'SurveiController::updateuraian/$1', ['filter' => 'isLoggedIn']);
    $routes->delete('survei/uraian/hapus/(:num)', 'SurveiController::uraianhapus/$1', ['filter' => 'isLoggedIn']);
    $routes->get('survei/uraian/batal/(:num)', 'SurveiController::uraianbatal/$1', ['filter' => 'isLoggedIn']);
    $routes->get('survei/uraian/cetak/(:num)', 'CetakController::pengajuan/$1', ['filter' => 'isLoggedIn']);

    $routes->get('drafter', 'DrafterController::index', ['filter' => 'isLoggedIn']);
    $routes->post('drafter/tambah', 'DrafterController::store', ['filter' => 'isLoggedIn']);
    $routes->put('drafter/ubah/(:num)', 'DrafterController::update/$1', ['filter' => 'isLoggedIn']);
    $routes->delete('drafter/hapus/(:num)', 'DrafterController::destroy/$1', ['filter' => 'isLoggedIn']);

    $routes->get('pengukur', 'PengukurController::index', ['filter' => 'isLoggedIn']);
    $routes->post('pengukur/tambah', 'PengukurController::store', ['filter' => 'isLoggedIn']);
    $routes->put('pengukur/ubah/(:num)', 'PengukurController::update/$1', ['filter' => 'isLoggedIn']);
    $routes->delete('pengukur/hapus/(:num)', 'PengukurController::destroy/$1', ['filter' => 'isLoggedIn']);

    $routes->get('tukang', 'TukangController::index', ['filter' => 'isLoggedIn']);
    $routes->post('tukang/tambah', 'TukangController::store', ['filter' => 'isLoggedIn']);
    $routes->put('tukang/ubah/(:num)', 'TukangController::update/$1', ['filter' => 'isLoggedIn']);
    $routes->delete('tukang/hapus/(:num)', 'TukangController::destroy/$1', ['filter' => 'isLoggedIn']);

    $routes->get('kerja', 'KerjaController::index', ['filter' => 'isLoggedIn']);
    $routes->post('kerja/tambah', 'KerjaController::store', ['filter' => 'isLoggedIn']);
    $routes->put('kerja/ubah/(:num)', 'KerjaController::update/$1', ['filter' => 'isLoggedIn']);
    $routes->delete('kerja/hapus/(:num)', 'KerjaController::destroy/$1', ['filter' => 'isLoggedIn']);

    $routes->get('kerja/sub/(:num)', 'SubkerjaController::index/$1', ['filter' => 'isLoggedIn']);
    $routes->post('kerja/sub/tambah', 'SubkerjaController::store', ['filter' => 'isLoggedIn']);
    $routes->put('kerja/sub/ubah/(:num)', 'SubkerjaController::update/$1', ['filter' => 'isLoggedIn']);
    $routes->delete('kerja/sub/hapus/(:num)', 'SubkerjaController::destroy/$1', ['filter' => 'isLoggedIn']);

    $routes->get('harga', 'HargaController::index', ['filter' => 'isLoggedIn']);
    $routes->post('harga/tambah', 'HargaController::store', ['filter' => 'isLoggedIn']);
    $routes->put('harga/ubah/(:num)', 'HargaController::update/$1', ['filter' => 'isLoggedIn']);
    $routes->delete('harga/hapus/(:num)', 'HargaController::destroy/$1', ['filter' => 'isLoggedIn']);

    $routes->get('ukuran', 'UkuranController::index', ['filter' => 'isLoggedIn']);
    $routes->post('ukuran/tambah', 'UkuranController::store', ['filter' => 'isLoggedIn']);
    $routes->put('ukuran/ubah/(:num)', 'UkuranController::update/$1', ['filter' => 'isLoggedIn']);
    $routes->delete('ukuran/hapus/(:num)', 'UkuranController::destroy/$1', ['filter' => 'isLoggedIn']);

    $routes->get('rekap', 'RekapController::index', ['filter' => 'isLoggedIn']);
    $routes->get('rekap/gambar/(:num)', 'RekapController::gambar/$1', ['filter' => 'isLoggedIn']);
    $routes->get('rekap/detail/(:num)', 'RekapController::preview/$1', ['filter' => 'isLoggedIn']);
    $routes->post('rekap/tambah', 'RekapController::store', ['filter' => 'isLoggedIn']);
    $routes->post('rekap/uraian/tambah', 'RekapController::uraiansimpan', ['filter' => 'isLoggedIn']);
    $routes->put('rekap/ubah/(:num)', 'RekapController::update/$1', ['filter' => 'isLoggedIn']);
    $routes->put('rekap/uraian/total/(:num)', 'RekapController::updatetotal/$1', ['filter' => 'isLoggedIn']);
    $routes->put('rekap/uraian/ubah/(:num)', 'RekapController::updateuraian/$1', ['filter' => 'isLoggedIn']);
    $routes->delete('rekap/hapus/(:num)', 'RekapController::destroy/$1', ['filter' => 'isLoggedIn']);
    $routes->delete('rekap/uraian/hapus/(:num)', 'RekapController::uraianhapus/$1', ['filter' => 'isLoggedIn']);
    $routes->get('rekap/uraian/batal/(:num)', 'RekapController::uraianbatal/$1', ['filter' => 'isLoggedIn']);
    $routes->get('rekap/uraian/cetak/(:num)', 'CetakController::uraian/$1', ['filter' => 'isLoggedIn']);

    $routes->get('hbk', 'HbkController::hbk', ['filter' => 'isLoggedIn']);
    $routes->get('hbk/uraian/(:num)', 'HbkController::uraian/$1', ['filter' => 'isLoggedIn']);
    $routes->post('hbk/tambah', 'HbkController::store', ['filter' => 'isLoggedIn']);
    $routes->post('hbk/uraian/tambah', 'HbkController::uraiansimpan', ['filter' => 'isLoggedIn']);
    $routes->put('hbk/ubah/(:num)', 'HbkController::update/$1', ['filter' => 'isLoggedIn']);
    $routes->put('hbk/uraian/ubah/(:num)', 'HbkController::updateuraian/$1', ['filter' => 'isLoggedIn']);
    $routes->post('hbk/bayar', 'HbkController::bayarhbk', ['filter' => 'isLoggedIn']);
    $routes->delete('hbk/hapus/(:num)', 'HbkController::destroy/$1', ['filter' => 'isLoggedIn']);
    $routes->delete('hbk/uraian/hapus/(:num)', 'HbkController::uraianhapus/$1', ['filter' => 'isLoggedIn']);
    $routes->get('hbk/gambar/(:num)', 'HbkController::gambar/$1', ['filter' => 'isLoggedIn']);
    $routes->get('hbk/uraian/batal/(:num)', 'HbkController::uraianbatal/$1', ['filter' => 'isLoggedIn']);
    $routes->get('hbk/uraian/cetak/(:num)', 'CetakController::uraianhbk/$1', ['filter' => 'isLoggedIn']);
    $routes->put('hbk/uraian/total/(:num)', 'HbkController::updatetotal/$1', ['filter' => 'isLoggedIn']);

    $routes->get('order', 'OrderController::index', ['filter' => 'isLoggedIn']);
    $routes->post('order/tambah', 'OrderController::store', ['filter' => 'isLoggedIn']);
    $routes->put('order/ubah/(:num)', 'OrderController::update/$1', ['filter' => 'isLoggedIn']);
    $routes->delete('order/hapus/(:num)', 'OrderController::destroy/$1', ['filter' => 'isLoggedIn']);
    $routes->get('order/uraian/(:num)', 'OrderController::uraian/$1', ['filter' => 'isLoggedIn']);
    $routes->post('order/uraian/tambah', 'OrderController::uraiansimpan', ['filter' => 'isLoggedIn']);
    $routes->put('order/uraian/ubah/(:num)', 'OrderController::updateuraian/$1', ['filter' => 'isLoggedIn']);
    $routes->delete('order/uraian/hapus/(:num)', 'OrderController::uraianhapus/$1', ['filter' => 'isLoggedIn']);
    $routes->get('order/uraian/batal/(:num)', 'OrderController::uraianbatal/$1', ['filter' => 'isLoggedIn']);
    $routes->get('order/nota/gambar/(:num)', 'OrderController::unduhnota/$1', ['filter' => 'isLoggedIn']);
    $routes->get('order/bukti/gambar/(:num)', 'OrderController::unduhbukti/$1', ['filter' => 'isLoggedIn']);

    $routes->get('user/password', 'UserController::password', ['filter' => 'isLoggedIn']);
    $routes->post('user/password/ubah', 'UserController::changePassword', ['filter' => 'isLoggedIn']);
} else {

    $routes->get('/dashboard-admin', 'Dashboard::admin', ['filter' => 'isLoggedIn']);

    $routes->get('user', 'UserController::index', ['filter' => 'isLoggedIn']);
    $routes->post('user/tambah', 'UserController::store', ['filter' => 'isLoggedIn']);
    $routes->put('user/ubah/(:num)', 'UserController::update/$1', ['filter' => 'isLoggedIn']);
    $routes->delete('user/hapus/(:num)', 'UserController::destroy/$1', ['filter' => 'isLoggedIn']);

    $routes->get('invoice', 'InvoiceController::index', ['filter' => 'isLoggedIn']);
    $routes->post('invoice/tambah', 'InvoiceController::store', ['filter' => 'isLoggedIn']);
    $routes->put('invoice/ubah/(:num)', 'InvoiceController::update/$1', ['filter' => 'isLoggedIn']);
    $routes->delete('invoice/hapus/(:num)', 'InvoiceController::destroy/$1', ['filter' => 'isLoggedIn']);
    $routes->get('invoice/(:segment)/preview', 'InvoiceController::preview/$1', ['filter' => 'isLoggedIn']);
    $routes->post('invoice/bayar', 'InvoiceController::bayarpasang', ['filter' => 'isLoggedIn']);
    $routes->delete('invoice/bayar/hapus/(:num)', 'InvoiceController::destroy2/$1', ['filter' => 'isLoggedIn']);
    $routes->get('invoice/(:segment)/uraian', 'InvoiceController::uraian/$1', ['filter' => 'isLoggedIn']);
    $routes->post('invoice/uraian/tambah', 'InvoiceController::uraiansimpan', ['filter' => 'isLoggedIn']);
    $routes->put('invoice/uraian/ubah/(:num)', 'InvoiceController::update2/$1', ['filter' => 'isLoggedIn']);
    $routes->delete('invoice/uraian/hapus/(:num)', 'InvoiceController::destroy3/$1', ['filter' => 'isLoggedIn']);
    $routes->get('invoice/uraian/batal/(:num)', 'InvoiceController::destroy4/$1', ['filter' => 'isLoggedIn']);

    $routes->get('hbk', 'HbkController::index', ['filter' => 'isLoggedIn']);
    $routes->get('hbk/(:segment)/preview', 'HbkController::preview/$1', ['filter' => 'isLoggedIn']);
    $routes->post('hbk/tambah', 'HbkController::store', ['filter' => 'isLoggedIn']);
    $routes->put('hbk/ubah/(:num)', 'HbkController::update/$1', ['filter' => 'isLoggedIn']);
    $routes->post('hbk/bayar', 'HbkController::bayarhbk', ['filter' => 'isLoggedIn']);
    $routes->delete('hbk/hapus/(:num)', 'HbkController::destroy/$1', ['filter' => 'isLoggedIn']);
    $routes->delete('hbk/bayar/hapus/(:num)', 'HbkController::destroy2/$1', ['filter' => 'isLoggedIn']);
    $routes->get('hbk/kwitansi/cetak/(:num)', 'CetakController::hbk/$1', ['filter' => 'isLoggedIn']);

    $routes->get('invoice/uraian/cetak/(:num)', 'CetakController::invoice/$1', ['filter' => 'isLoggedIn']);
    $routes->get('invoice/kwitansi/cetak/(:num)', 'CetakController::kwitansi/$1', ['filter' => 'isLoggedIn']);

    $routes->get('sumber', 'SumberkasController::index', ['filter' => 'isLoggedIn']);
    $routes->post('sumber/tambah', 'SumberkasController::store', ['filter' => 'isLoggedIn']);
    $routes->put('sumber/ubah/(:num)', 'SumberkasController::update/$1', ['filter' => 'isLoggedIn']);
    $routes->delete('sumber/hapus/(:num)', 'SumberkasController::destroy/$1', ['filter' => 'isLoggedIn']);

    $routes->get('sumber/detail', 'SumberdetailController::index', ['filter' => 'isLoggedIn']);
    $routes->post('sumber/detail/tambah', 'SumberdetailController::store', ['filter' => 'isLoggedIn']);
    $routes->delete('sumber/detail/hapus/(:num)', 'SumberdetailController::destroy/$1', ['filter' => 'isLoggedIn']);
    $routes->put('sumber/detail/ubah/(:num)', 'SumberdetailController::update/$1', ['filter' => 'isLoggedIn']);
    $routes->post('cetak/sumber', 'SumberdetailController::cetak', ['filter' => 'isLoggedIn']);

    $routes->get('kas/(:segment)/preview', 'KasController::preview/$1', ['filter' => 'isLoggedIn']);
    $routes->post('kas/laporan/preview', 'KasController::laporan', ['filter' => 'isLoggedIn']);
    $routes->post('kas/tambah', 'KasController::store', ['filter' => 'isLoggedIn']);
    $routes->put('kas/ubah/(:num)', 'KasController::update/$1', ['filter' => 'isLoggedIn']);
    $routes->delete('kas/hapus/(:num)', 'KasController::destroy/$1', ['filter' => 'isLoggedIn']);

    $routes->get('kas/kategori', 'KatekasController::index', ['filter' => 'isLoggedIn']);
    $routes->post('kas/kategori/tambah', 'KatekasController::store', ['filter' => 'isLoggedIn']);
    $routes->put('kas/kategori/ubah/(:num)', 'KatekasController::update/$1', ['filter' => 'isLoggedIn']);
    $routes->delete('kas/kategori/hapus/(:num)', 'KatekasController::destroy/$1', ['filter' => 'isLoggedIn']);

    $routes->get('kas/sumber/uang', 'UangkasController::sumber', ['filter' => 'isLoggedIn']);
    $routes->get('kas/uang/(:segment)/preview', 'UangkasController::preview/$1', ['filter' => 'isLoggedIn']);
    $routes->get('kas/uang', 'UangkasController::index', ['filter' => 'isLoggedIn']);
    $routes->post('kas/uang/tambah', 'UangkasController::store', ['filter' => 'isLoggedIn']);
    $routes->put('kas/uang/ubah/(:num)', 'UangkasController::update/$1', ['filter' => 'isLoggedIn']);
    $routes->delete('kas/uang/hapus/(:num)', 'UangkasController::destroy/$1', ['filter' => 'isLoggedIn']);

    $routes->get('kas/labarugi', 'LabarugikasController::index', ['filter' => 'isLoggedIn']);
    $routes->post('kas/labarugi/tambah', 'LabarugikasController::store', ['filter' => 'isLoggedIn']);
    $routes->put('kas/labarugi/ubah/(:num)', 'LabarugikasController::update/$1', ['filter' => 'isLoggedIn']);
    $routes->delete('kas/labarugi/hapus/(:num)', 'LabarugikasController::destroy/$1', ['filter' => 'isLoggedIn']);
    $routes->post('kas/labarugi/preview', 'LabarugikasController::preview', ['filter' => 'isLoggedIn']);
    $routes->post('cetak/labarugi', 'CetakController::labarugi', ['filter' => 'isLoggedIn']);

    $routes->get('pembayaran', 'PembayaranController::index', ['filter' => 'isLoggedIn']);
    $routes->get('pembayaran/(:segment)/preview', 'PembayaranController::preview/$1', ['filter' => 'isLoggedIn']);
    $routes->post('pembayaran/tambah', 'PembayaranController::store', ['filter' => 'isLoggedIn']);
    $routes->put('pembayaran/ubah/(:num)', 'PembayaranController::update/$1', ['filter' => 'isLoggedIn']);
    $routes->delete('pembayaran/detail/hapus/(:num)', 'PembayaranController::destroy/$1', ['filter' => 'isLoggedIn']);
    $routes->delete('pembayaran/hapus/(:num)', 'PembayaranController::destroy2/$1', ['filter' => 'isLoggedIn']);
    $routes->post('pembayaran/ambilfaktur', 'PembayaranController::ambilfaktur', ['filter' => 'isLoggedIn']);
    $routes->get('pembayaran/laporan', 'PembayaranController::laporan', ['filter' => 'isLoggedIn']);
    $routes->get('pembayaran/ongkir', 'PembayaranController::ongkir', ['filter' => 'isLoggedIn']);

    $routes->get('/laporan/masuk', 'LaporanController::masuk', ['filter' => 'isLoggedIn']);
    $routes->get('/laporan/masukbulan', 'LaporanController::masukbulan', ['filter' => 'isLoggedIn']);
    $routes->get('/laporan/keluar', 'LaporanController::keluar', ['filter' => 'isLoggedIn']);
    $routes->get('/laporan/keluarbulan', 'LaporanController::keluarbulan', ['filter' => 'isLoggedIn']);

    $routes->get('order', 'OrderController::index', ['filter' => 'isLoggedIn']);
    $routes->post('order/tambah', 'OrderController::store', ['filter' => 'isLoggedIn']);
    $routes->put('order/ubah/(:num)', 'OrderController::update/$1', ['filter' => 'isLoggedIn']);
    $routes->put('order/nota/(:num)', 'OrderController::nota/$1', ['filter' => 'isLoggedIn']);
    $routes->get('order/nota/gambar/(:num)', 'OrderController::unduhnota/$1', ['filter' => 'isLoggedIn']);
    $routes->put('order/bukti/(:num)', 'OrderController::bukti/$1', ['filter' => 'isLoggedIn']);
    $routes->get('order/bukti/gambar/(:num)', 'OrderController::unduhbukti/$1', ['filter' => 'isLoggedIn']);
    $routes->delete('order/hapus/(:num)', 'OrderController::destroy/$1', ['filter' => 'isLoggedIn']);
    $routes->get('order/uraian/(:num)', 'OrderController::uraian/$1', ['filter' => 'isLoggedIn']);
    $routes->post('order/uraian/tambah', 'OrderController::uraiansimpan', ['filter' => 'isLoggedIn']);
    $routes->put('order/uraian/ubah/(:num)', 'OrderController::updateuraian/$1', ['filter' => 'isLoggedIn']);
    $routes->delete('order/uraian/hapus/(:num)', 'OrderController::uraianhapus/$1', ['filter' => 'isLoggedIn']);
    $routes->get('order/uraian/batal/(:num)', 'OrderController::uraianbatal/$1', ['filter' => 'isLoggedIn']);

    $routes->get('karyawan', 'KaryawanController::index', ['filter' => 'isLoggedIn']);
    $routes->post('karyawan/tambah', 'KaryawanController::store', ['filter' => 'isLoggedIn']);
    $routes->put('karyawan/ubah/(:num)', 'KaryawanController::update/$1', ['filter' => 'isLoggedIn']);
    $routes->delete('karyawan/hapus/(:num)', 'KaryawanController::destroy/$1', ['filter' => 'isLoggedIn']);
    $routes->post('karyawan/posisi/tambah', 'PosisiController::store', ['filter' => 'isLoggedIn']);
    $routes->put('karyawan/posisi/ubah/(:num)', 'PosisiController::update/$1', ['filter' => 'isLoggedIn']);
    $routes->delete('karyawan/posisi/hapus/(:num)', 'PosisiController::destroy/$1', ['filter' => 'isLoggedIn']);

    $routes->get('absen', 'AbsenController::index', ['filter' => 'isLoggedIn']);
    $routes->post('absen/tambah', 'AbsenController::store', ['filter' => 'isLoggedIn']);
    $routes->put('absen/ubah/(:num)', 'AbsenController::update/$1', ['filter' => 'isLoggedIn']);
    $routes->delete('absen/hapus/(:num)', 'AbsenController::destroy/$1', ['filter' => 'isLoggedIn']);

    $routes->post('absen/status/tambah', 'AbsenController::simpanstatus', ['filter' => 'isLoggedIn']);
    $routes->put('absen/status/ubah/(:num)', 'AbsenController::updatestatus/$1', ['filter' => 'isLoggedIn']);
    $routes->delete('absen/status/hapus/(:num)', 'AbsenController::destroystatus/$1', ['filter' => 'isLoggedIn']);

    $routes->get('ins', 'InsController::index', ['filter' => 'isLoggedIn']);
    $routes->post('ins/tambah', 'InsController::store', ['filter' => 'isLoggedIn']);
    $routes->put('ins/ubah/(:num)', 'InsController::update/$1', ['filter' => 'isLoggedIn']);
    $routes->delete('ins/hapus/(:num)', 'InsController::destroy/$1', ['filter' => 'isLoggedIn']);

    $routes->get('gaji', 'GajiController::index', ['filter' => 'isLoggedIn']);
    $routes->post('gaji/tambah', 'GajiController::store', ['filter' => 'isLoggedIn']);
    $routes->put('gaji/ubah/(:num)', 'GajiController::update/$1', ['filter' => 'isLoggedIn']);
    $routes->delete('gaji/hapus/(:num)', 'GajiController::destroy/$1', ['filter' => 'isLoggedIn']);

    $routes->get('kasbon', 'KasbonController::index', ['filter' => 'isLoggedIn']);
    $routes->post('kasbon/tambah', 'KasbonController::store', ['filter' => 'isLoggedIn']);
    $routes->put('kasbon/ubah/(:num)', 'KasbonController::update/$1', ['filter' => 'isLoggedIn']);
    $routes->delete('kasbon/hapus/(:num)', 'KasbonController::destroy/$1', ['filter' => 'isLoggedIn']);

    $routes->get('rpt', 'RPTController::index', ['filter' => 'isLoggedIn']);
    $routes->post('rpt/tambah', 'RPTController::store', ['filter' => 'isLoggedIn']);
    $routes->put('rpt/ubah/(:num)', 'RPTController::update/$1', ['filter' => 'isLoggedIn']);
    $routes->delete('rpt/hapus/(:num)', 'RPTController::destroy/$1', ['filter' => 'isLoggedIn']);

    $routes->get('gatuk', 'GatukController::index', ['filter' => 'isLoggedIn']);
    $routes->post('gatuk/tambah', 'GatukController::store', ['filter' => 'isLoggedIn']);
    $routes->put('gatuk/ubah/(:num)', 'GatukController::update/$1', ['filter' => 'isLoggedIn']);
    $routes->delete('gatuk/hapus/(:num)', 'GatukController::destroy/$1', ['filter' => 'isLoggedIn']);
    $routes->post('gatuk/laporan/preview', 'GatukController::laporan', ['filter' => 'isLoggedIn']);

    $routes->get('deposit', 'DepositController::index', ['filter' => 'isLoggedIn']);
    $routes->post('deposit/tambah', 'DepositController::store', ['filter' => 'isLoggedIn']);
    $routes->put('deposit/ubah/(:num)', 'DepositController::update/$1', ['filter' => 'isLoggedIn']);
    $routes->delete('deposit/hapus/(:num)', 'DepositController::destroy/$1', ['filter' => 'isLoggedIn']);

    $routes->get('piutang', 'PiutangController::index', ['filter' => 'isLoggedIn']);
    $routes->post('piutang/tambah', 'PiutangController::store', ['filter' => 'isLoggedIn']);
    $routes->put('piutang/ubah/(:num)', 'PiutangController::update/$1', ['filter' => 'isLoggedIn']);
    $routes->delete('piutang/hapus/(:num)', 'PiutangController::destroy/$1', ['filter' => 'isLoggedIn']);

    $routes->get('piutang/uraian/(:num)', 'PiutangController::uraian/$1', ['filter' => 'isLoggedIn']);
    $routes->post('piutang/uraian/tambah', 'PiutangController::uraiansimpan', ['filter' => 'isLoggedIn']);
    $routes->put('piutang/uraian/ubah/(:num)', 'PiutangController::updateuraian/$1', ['filter' => 'isLoggedIn']);
    $routes->delete('piutang/uraian/hapus/(:num)', 'PiutangController::uraianhapus/$1', ['filter' => 'isLoggedIn']);
    $routes->get('piutang/uraian/batal/(:num)', 'PiutangController::uraianbatal/$1', ['filter' => 'isLoggedIn']);

    $routes->get('rekening', 'RekeningController::index', ['filter' => 'isLoggedIn']);
    $routes->post('rekening/tambah', 'RekeningController::store', ['filter' => 'isLoggedIn']);
    $routes->put('rekening/ubah/(:num)', 'RekeningController::update/$1', ['filter' => 'isLoggedIn']);
    $routes->delete('rekening/hapus/(:num)', 'RekeningController::destroy/$1', ['filter' => 'isLoggedIn']);
    $routes->post('rekening/uraian', 'RekeningController::uraian', ['filter' => 'isLoggedIn']);
    $routes->get('rekening/uraian', 'RekeningController::index', ['filter' => 'isLoggedIn']);

    $routes->get('hutang', 'HutangController::index', ['filter' => 'isLoggedIn']);
    $routes->post('hutang/tambah', 'HutangController::store', ['filter' => 'isLoggedIn']);
    $routes->put('hutang/ubah/(:num)', 'HutangController::update/$1', ['filter' => 'isLoggedIn']);
    $routes->delete('hutang/hapus/(:num)', 'HutangController::destroy/$1', ['filter' => 'isLoggedIn']);

    $routes->get('hutang/uraian/(:num)', 'HutangController::uraian/$1', ['filter' => 'isLoggedIn']);
    $routes->post('hutang/uraian/tambah', 'HutangController::uraiansimpan', ['filter' => 'isLoggedIn']);
    $routes->put('hutang/uraian/ubah/(:num)', 'HutangController::updateuraian/$1', ['filter' => 'isLoggedIn']);
    $routes->delete('hutang/uraian/hapus/(:num)', 'HutangController::uraianhapus/$1', ['filter' => 'isLoggedIn']);
    $routes->get('hutang/uraian/batal/(:num)', 'HutangController::uraianbatal/$1', ['filter' => 'isLoggedIn']);

    $routes->get('bulanan', 'BulananController::index', ['filter' => 'isLoggedIn']);
    $routes->post('bulanan/tambah', 'BulananController::store', ['filter' => 'isLoggedIn']);
    $routes->put('bulanan/ubah/(:num)', 'BulananController::update/$1', ['filter' => 'isLoggedIn']);
    $routes->delete('bulanan/hapus/(:num)', 'BulananController::destroy/$1', ['filter' => 'isLoggedIn']);

    $routes->get('bulanan/uraian/(:num)', 'BulananController::uraian/$1', ['filter' => 'isLoggedIn']);
    $routes->post('bulanan/uraian/tambah', 'BulananController::uraiansimpan', ['filter' => 'isLoggedIn']);
    $routes->put('bulanan/uraian/ubah/(:num)', 'BulananController::updateuraian/$1', ['filter' => 'isLoggedIn']);
    $routes->delete('bulanan/uraian/hapus/(:num)', 'BulananController::uraianhapus/$1', ['filter' => 'isLoggedIn']);
    $routes->get('bulanan/uraian/batal/(:num)', 'BulananController::uraianbatal/$1', ['filter' => 'isLoggedIn']);
    $routes->post('bulanan/laporan/preview', 'BulananController::laporan', ['filter' => 'isLoggedIn']);

    $routes->get('memo', 'MemoController::index', ['filter' => 'isLoggedIn']);
    $routes->post('memo/tambah', 'MemoController::store', ['filter' => 'isLoggedIn']);
    $routes->put('memo/ubah/(:num)', 'MemoController::update/$1', ['filter' => 'isLoggedIn']);
    $routes->delete('memo/hapus/(:num)', 'MemoController::destroy/$1', ['filter' => 'isLoggedIn']);
    $routes->get('memo/cetak/(:num)', 'CetakController::memo/$1', ['filter' => 'isLoggedIn']);

    $routes->get('pengajuan', 'PengajuanController::index', ['filter' => 'isLoggedIn']);
    $routes->post('pengajuan/tambah', 'PengajuanController::store', ['filter' => 'isLoggedIn']);
    $routes->put('pengajuan/ubah/(:num)', 'PengajuanController::update/$1', ['filter' => 'isLoggedIn']);
    $routes->delete('pengajuan/hapus/(:num)', 'PengajuanController::destroy/$1', ['filter' => 'isLoggedIn']);
    $routes->post('pengajuan/laporan/preview', 'PengajuanController::laporan', ['filter' => 'isLoggedIn']);

    $routes->get('cetak/(:segment)/nota', 'CetakController::nota/$1', ['filter' => 'isLoggedIn']);
    $routes->get('cetak/(:segment)/suratjalan', 'CetakController::suratjalan/$1', ['filter' => 'isLoggedIn']);

    $routes->get('toko', 'TokoController::index', ['filter' => 'isLoggedIn']);
    $routes->post('toko/tambah', 'TokoController::store', ['filter' => 'isLoggedIn']);
    $routes->put('toko/ubah/(:num)', 'TokoController::update/$1', ['filter' => 'isLoggedIn']);
    $routes->delete('toko/hapus/(:num)', 'TokoController::destroy/$1', ['filter' => 'isLoggedIn']);

    $routes->get('user/password', 'UserController::password', ['filter' => 'isLoggedIn']);
    $routes->post('user/password/ubah', 'UserController::changePassword', ['filter' => 'isLoggedIn']);
}

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}

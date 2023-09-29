<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

use App\Models\KategoriModel;
use App\Models\SatuanModel;
use App\Models\ProdukModel;
use App\Models\SubkategoriModel;
use App\Models\KatepelModel;
use App\Models\PelangganModel;
use App\Models\DetailModel;
use App\Models\TransaksiModel;
use App\Models\OngkirModel;
use App\Models\KembaliModel;
use App\Models\PageModel;
use App\Models\ProjectModel;
use App\Models\PartnerModel;
use App\Models\TestimoniModal;
use App\Models\UserModel;
use App\Models\PasangModel;
use App\Models\HbkModel;
use App\Models\BayarpasangModel;
use App\Models\BayarhbkModel;
use App\Models\DetailpasangModel;
use App\Models\BahanModel;
use App\Models\DetailbahanModel;
use App\Models\KasModel;
use App\Models\KatekasModel;
use App\Models\UangKasModel;
use App\Models\LabarugiModel;
use App\Models\SumberKasModel;
use App\Models\PembayaranModel;
use App\Models\DetailBayarModel;
use App\Models\DetailSumberModel;
use App\Models\SurveiModel;
use App\Models\DrafterModel;
use App\Models\PengukurModel;
use App\Models\TukangModel;
use App\Models\KerjaModel;
use App\Models\SubkerjaModel;
use App\Models\HargaModel;
use App\Models\UkuranModel;
use App\Models\DetailhbkModel;
use App\Models\OrderModel;
use App\Models\DetailorderModel;
use App\Models\KaryawanModel;
use App\Models\AbsenModel;
use App\Models\InsModel;
use App\Models\GajiModel;
use App\Models\KasbonModel;
use App\Models\RPTModel;
use App\Models\GatukModel;
use App\Models\DepositModel;
use App\Models\PiutangModel;
use App\Models\DetailPiutangModel;
use App\Models\RekeningModel;
use App\Models\HutangModel;
use App\Models\DetailHutangModel;
use App\Models\BulananModel;
use App\Models\DetailBulananModel;
use App\Models\MemoModel;
use App\Models\PengajuanModel;
use App\Models\StatusModel;
use App\Models\TokoModel;

use CodeIgniter\Session\Session;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = [
        'form', 'number'
    ];

    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
    // protected $session;

    /**
     * Constructor.
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.

        // E.g.: $this->session = \Config\Services::session();

        $this->KategoriModel = new KategoriModel();
        $this->SatuanModel = new SatuanModel();
        $this->ProdukModel = new ProdukModel();
        $this->SubkategoriModel = new SubkategoriModel();
        $this->KatepelModel = new KatepelModel();
        $this->PelangganModel = new PelangganModel();
        $this->TransaksiModel = new TransaksiModel();
        $this->DetailModel = new DetailModel();
        $this->OngkirModel = new OngkirModel();
        $this->KembaliModel = new KembaliModel();
        $this->PageModel = new PageModel();
        $this->ProjectModel = new ProjectModel();
        $this->PartnerModel = new PartnerModel();
        $this->TestimoniModal = new TestimoniModal();
        $this->UserModel = new UserModel();
        $this->PasangModel = new PasangModel();
        $this->BayarpasangModel = new BayarpasangModel();
        $this->HbkModel = new HbkModel();
        $this->BayarhbkModel = new BayarhbkModel();
        $this->DetailpasangModel = new DetailpasangModel();
        $this->BahanModel = new BahanModel();
        $this->DetailbahanModel = new DetailbahanModel();
        $this->KasModel = new KasModel();
        $this->KatekasModel = new KatekasModel();
        $this->UangKasModel = new UangKasModel();
        $this->LabarugiModel = new LabarugiModel();
        $this->SumberKasModel = new SumberKasModel();
        $this->PembayaranModel = new PembayaranModel();
        $this->DetailBayarModel = new DetailBayarModel();
        $this->DetailSumberModel = new DetailSumberModel();
        $this->SurveiModel = new SurveiModel();
        $this->DrafterModel  = new DrafterModel();
        $this->PengukurModel  = new PengukurModel();
        $this->TukangModel  = new TukangModel();
        $this->KerjaModel  = new KerjaModel();
        $this->SubkerjaModel  = new SubkerjaModel();
        $this->HargaModel  = new HargaModel();
        $this->UkuranModel  = new UkuranModel();
        $this->DetailhbkModel  = new DetailhbkModel();
        $this->OrderModel  = new OrderModel();
        $this->session = session();
        $this->DetailorderModel  = new DetailorderModel();
        $this->KaryawanModel  = new KaryawanModel();
        $this->AbsenModel  = new AbsenModel();
        $this->InsModel  = new InsModel();
        $this->GajiModel  = new GajiModel();
        $this->KasbonModel  = new KasbonModel();
        $this->RPTModel  = new RPTModel();
        $this->GatukModel  = new GatukModel();
        $this->DepositModel  = new DepositModel();
        $this->PiutangModel  = new PiutangModel();
        $this->DetailPiutangModel  = new DetailPiutangModel();
        $this->RekeningModel  = new RekeningModel();
        $this->HutangModel  = new HutangModel();
        $this->DetailHutangModel  = new DetailHutangModel();
        $this->BulananModel  = new BulananModel();
        $this->DetailBulananModel  = new DetailBulananModel();
        $this->MemoModel  = new MemoModel();
        $this->PengajuanModel  = new PengajuanModel();
        $this->StatusModel  = new StatusModel();
        $this->TokoModel  = new TokoModel();
    }
}

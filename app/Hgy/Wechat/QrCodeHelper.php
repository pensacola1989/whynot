<?php namespace Hgy\Wechat;
use Endroid\QrCode\QrCode;

/**
 * Created by PhpStorm.
 * User: danielwu
 * Date: 1/24/15
 * Time: 10:50 PM
 */

class QrCodeHelper {

    private $Qr;

    public function __construct()
    {
        $this->Qr = new QrCode();
    }

    public function generateQrCode($text, $size=200)
    {
        if(!$size || !$text) return '';
        $this->Qr->setText($text);
        $this->Qr->setSize($size);
        $this->Qr->setPadding(10);

        return $this->Qr->get();
//        $response = Response::make($this->Qr->get(), 200);
//        $response->header('content-type', 'image/png');
//        return $response;
    }

}
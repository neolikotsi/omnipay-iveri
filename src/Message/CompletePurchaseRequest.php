<?php

namespace Omnipay\IVeri\Message;

use Omnipay\Common\Exception\InvalidRequestException;

/**
 * IVeri Complete Purchase Request
 *
 */
class CompletePurchaseRequest extends PurchaseRequest
{
    public function getData()
    {
        if ($this->httpRequest->request->get('ECOM_PAYMENT_CARD_PROTOCOLS')) {
            $data = $this->httpRequest->request->all();

            unset($data['Lite_Transaction_Token']);

            return $data;
        }

        throw new InvalidRequestException('Missing ECOM_PAYMENT_CARD_PROTOCOLS variables');
    }

    public function sendData($data)
    {
        return $this->response = new CompletePurchaseResponse($this, $data);
    }
}

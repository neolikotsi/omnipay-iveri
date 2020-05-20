<?php

namespace Omnipay\IVeri\Message;

use Omnipay\Common\Exception\InvalidRequestException;

/**
 * IVeri Complete Purchase Request
 *
 * We use the same return URL & class to handle both PDT (Payment Data Transfer)
 * and ITN (Instant Transaction Notification).
 */
class CompletePurchaseRequest extends PurchaseRequest
{
    public function getData()
    {
        if ($this->httpRequest->request->get('ECOM_CONSUMERORDERID')) {
            $data = $this->httpRequest->request->all();

            return $data;
        }

        throw new InvalidRequestException('Missing ECOM_CONSUMERORDERID variables');
    }

    public function sendData($data)
    {
        if (isset($data['pt'])) {
            // validate PDT
            $url = $this->getEndpoint().'/query/fetch';
            $httpResponse = $this->httpClient->request('post', $url, [], http_build_query($data));
            return $this->response = new CompletePurchasePdtResponse($this, $httpResponse->getBody()->getContents());
        } else {
            // validate ITN
            $url = $this->getEndpoint().'/query/validate';
            $httpResponse = $this->httpClient->request('post', $url, [], http_build_query($data));
            $status = $httpResponse->getBody()->getContents();
            return $this->response = new CompletePurchaseItnResponse($this, $data, $status);
        }
    }
}

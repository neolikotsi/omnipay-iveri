<?php

namespace Omnipay\IVeri;

use Omnipay\Common\AbstractGateway;

/**
 * iVeri Lite Gateway
 *
 * @link https://iveri.com/apis/
 */
class Gateway extends AbstractGateway
{
    public function getName()
    {
        return 'iVeri';
    }

    public function getDefaultParameters()
    {
        return array(
            'merchantId' => '',
            'Ecom_TransactionComplete' => 'FALSE',
            'Ecom_Payment_Card_Protocols' => 'iVeri',
            'Lite_Version' => '2.0',
            'passphrase' => '',
            'transactionPrefix' => ''
        );
    }

    public function getMerchantId()
    {
        return $this->getParameter('merchantId');
    }

    public function setMerchantId($value)
    {
        return $this->setParameter('merchantId', $value);
    }

    public function getTransactionPrefix()
    {
        return $this->getParameter('transactionPrefix');
    }

    public function setTransactionPrefix($value)
    {
        return $this->setParameter('transactionPrefix', $value);
    }

    public function getPassphrase()
    {
        return $this->getParameter('passphrase');
    }

    public function setPassphrase($value)
    {
        return $this->setParameter('passphrase', $value);
    }

    public function purchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Iveri\Message\PurchaseRequest', $parameters);
    }

    public function completePurchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Iveri\Message\CompletePurchaseRequest', $parameters);
    }
}

<?php

namespace Omnipay\IVeri;

use Omnipay\Tests\GatewayTestCase;

class GatewayTest extends GatewayTestCase
{
    /** @var array */
    private $options;

    public function setUp()
    {
        parent::setUp();

        $this->gateway = new Gateway($this->getHttpClient(), $this->getHttpRequest());

        $this->options = [
            'card' => [
                'firstName' => 'Xu',
                'lastName' => 'Ding',
                'email' => 'xuding@spacebib.com',
            ],
            'amount' => 1999.00,
            'currency' => 'ZAR',
            'description' => 'Marina Run 2016',
            'transactionId' => 12,
            'returnUrl' => 'https://www.example.com/return',
            'passphrase' => 'q74xrm6dkrDjpQGD',
        ];

    }

    public function testPurchase()
    {
        $request = $this->gateway->purchase(array('amount' => '12.00'));

        $this->assertInstanceOf('\Omnipay\IVeri\Message\PurchaseRequest', $request);
        $this->assertSame('12.00', $request->getAmount());
    }

    public function testCompletePurchase()
    {
        $request = $this->gateway->completePurchase(array('amount' => '12.00'));

        $this->assertInstanceOf('\Omnipay\IVeri\Message\CompletePurchaseRequest', $request);
        $this->assertSame('12.00', $request->getAmount());
    }
}

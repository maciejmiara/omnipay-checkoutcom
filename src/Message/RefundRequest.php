<?php

namespace Omnipay\CheckoutCom\Message;

class RefundRequest extends AbstractRequest
{
    public function getData()
    {
        $this->validate('transactionReference');
    }

    public function sendData($data)
    {
        $httpResponse = $this->sendRequest($data);

        return $this->response = new AbstractResponse($this, $httpResponse->json());
    }

    public function getEndpoint()
    {
        return parent::getEndpoint() . '/charges/' . $this->getTransactionReference() . '/refund';
    }
}

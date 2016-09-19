<?php

namespace Omnipay\CheckoutCom\Message;

class CancelCustomerPlanRequest extends AbstractRequest
{
    public function getData()
    {
        $this->validate('customerPlanId');
    }

    public function sendData($data)
    {
        $httpResponse = $this->sendRequest($data);

        return $this->response = new CancelCustomerPlanResponse($this, $httpResponse->json());
    }

    public function getEndpoint()
    {
        return parent::getEndpoint() . '/recurringPayments/customers/' . $this->getCustomerPlanId();
    }

    public function getHttpMethod()
    {
        return 'DELETE';
    }
}

<?php

namespace Omnipay\CheckoutCom\Message;

use Omnipay\Common\Message\ResponseInterface;

class CancelCustomerPlanResponse extends AbstractResponse implements ResponseInterface
{
    public function getMessage()
    {
        if (isset($this->data['message'])) {
            return $this->data['message'];
        }

        return null;
    }
}

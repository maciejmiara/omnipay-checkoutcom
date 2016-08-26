<?php
/**
 * CheckoutCom Response
 */

namespace Omnipay\CheckoutCom\Message;

use Omnipay\Common\Message\ResponseInterface;

/**
 * CheckoutCom Response
 *
 * This is the response class for all CheckoutCom requests.
 *
 * @see \Omnipay\CheckoutCom\Gateway
 */
class RefundResponse extends AbstractResponse implements ResponseInterface
{
    public function getCardId()
    {
        if (isset($this->data['card']['id'])) {
            return $this->data['card']['id'];
        }

        return null;
    }

    public function getCustomerId()
    {
        if (isset($this->data['card']['customerId'])) {
            return $this->data['card']['customerId'];
        }

        return null;
    }

    public function getPlanId()
    {
        if (isset($this->data['customerPaymentPlans'][0]['planId'])) {
            return $this->data['card']['customerId'];
        }

        return null;
    }

    public function getCustomerPlanId()
    {
        if (isset($this->data['customerPaymentPlans'][0]['customerPlanId'])) {
            return $this->data['card']['customerPlanId'];
        }

        return null;
    }
}

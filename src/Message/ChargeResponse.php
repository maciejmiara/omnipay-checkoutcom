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
class ChargeResponse extends AbstractResponse implements ResponseInterface
{
    public function isSuccessful()
    {
        return false;
    }

    public function isRedirect()
    {
        return !isset($this->data['errorCode']);
    }

    public function getRedirectMethod()
    {
        return 'GET';
    }

    public function getRedirectUrl()
    {
        if ($this->isRedirect()) {
            return 'placeholder';
        }
    }

    public function getRedirectData()
    {
        return $this->getData();
    }

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

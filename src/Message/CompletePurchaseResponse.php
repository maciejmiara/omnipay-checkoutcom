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
class CompletePurchaseResponse extends AbstractResponse implements ResponseInterface
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

    public function getCustomerPlanNextDate()
    {
        if (isset($this->data['customerPaymentPlans'][0]['nextRecurringDate'])) {
            return $this->data['customerPaymentPlans'][0]['nextRecurringDate'];
        }

        return null;
    }

    public function getUdf1()
    {
        if (isset($this->data['udf1'])) {
            return $this->data['udf1'];
        }

        return null;
    }
}

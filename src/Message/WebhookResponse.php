<?php
/**
 * CheckoutCom Response
 */

namespace Omnipay\CheckoutCom\Message;

use Omnipay\Common\Message\NotificationInterface;

/**
 * CheckoutCom Response
 *
 * This is the response class for all CheckoutCom requests.
 *
 * @see \Omnipay\CheckoutCom\Gateway
 */
class WebhookResponse implements NotificationInterface
{
    /**
     * @var array
     */
    protected $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function getTransactionStatus()
    {
        switch ($this->data['eventType']) {
            case 'charge.succeeded':
            case 'charge.captured':
            case 'charge.refunded':
            case 'charge.voided':
                return self::STATUS_COMPLETED;
            case 'charge.failed':
            case 'charge.captured.failed':
            case 'charge.refunded.failed':
            case 'charge.voided.failed':
                return self::STATUS_FAILED;
        }
    }

    public function getData()
    {
        return $this->data;
    }

    /**
     * Get a token, for createCard requests.
     *
     * @return string|null
     */
    public function getTransactionReference()
    {
        if (isset($this->data['message']['id'])) {
            return $this->data['message']['id'];
        }

        return null;

    }

    /**
     * Get the error message from the response.
     *
     * Returns null if the request was successful.
     *
     * @return string|null
     */
    public function getMessage()
    {
        if (!$this->isSuccessful() && isset($this->data['message']['errorCode'])) {
            return $this->data['message']['errorCode'] . ': ' . $this->data['message']['message'];
        }

        return null;
    }

    /**
     * Is the transaction successful?
     *
     * @return bool
     */
    public function isSuccessful()
    {
        return !isset($this->data['message']['errorCode']);
    }

    public function getEventType()
    {
        if (isset($this->data['eventType'])) {
            return $this->data['eventType'];
        }

        return null;
    }

    public function getDescription()
    {
        if (isset($this->data['message']['description'])) {
            return $this->data['message']['description'];
        }

        return null;
    }

    public function getStatus()
    {
        if (isset($this->data['message']['status'])) {
            return $this->data['message']['status'];
        }

        return null;
    }

    public function getCardId()
    {
        if (isset($this->data['message']['card']['id'])) {
            return $this->data['message']['card']['id'];
        }

        return null;
    }

    public function getCustomerId()
    {
        if (isset($this->data['message']['card']['customerId'])) {
            return $this->data['message']['card']['customerId'];
        }

        return null;
    }

    public function getPlanId()
    {
        if (isset($this->data['message']['customerPaymentPlans'][0]['planId'])) {
            return $this->data['message']['customerPaymentPlans'][0]['planId'];
        }

        return null;
    }

    public function getCustomerPlanId()
    {
        if (isset($this->data['message']['customerPaymentPlans'][0]['customerPlanId'])) {
            return $this->data['message']['customerPaymentPlans'][0]['customerPlanId'];
        }

        return null;
    }

    public function getCustomerPlanNextDate()
    {
        if (isset($this->data['message']['customerPaymentPlans'][0]['nextRecurringDate'])) {
            return $this->data['message']['customerPaymentPlans'][0]['nextRecurringDate'];
        }

        return null;
    }

    public function getUdf1()
    {
        if (isset($this->data['message']['udf1'])) {
            return $this->data['message']['udf1'];
        }

        return null;
    }
}

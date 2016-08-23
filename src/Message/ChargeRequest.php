<?php
/**
 * CheckoutCom Purchase Request
 */

namespace Omnipay\CheckoutCom\Message;

/**
 * CheckoutCom Purchase Request
 *
 * @link https://www.checkout.com/docs/api/API-reference/payment-tokens/create-payment-token
 */
class ChargeRequest extends AbstractRequest
{
    public function getData()
    {
        $this->validate('amount', 'currency', 'customerId', 'cardId');

        $data = array();
        $data['value'] = $this->getAmountInteger();
        $data['currency'] = strtoupper($this->getCurrency());
        $data['description'] = $this->getDescription();
        $data['metadata'] = $this->getMetadata();
        $data['cardId'] = $this->getCardId();
        $data['customerId'] = $this->getCustomerId();

        if ($udf = $this->getUdfValues()) {
            $data['udf1'] = $udf[0];
            $data['udf2'] = isset($udf[1]) ? $udf[1] : null;
            $data['udf3'] = isset($udf[2]) ? $udf[2] : null;
            $data['udf4'] = isset($udf[3]) ? $udf[3] : null;
            $data['udf5'] = isset($udf[4]) ? $udf[4] : null;
        }

        if ($plan = $this->getPlanValues()) {
            if (isset($plan['planId'])) {
                $data['paymentPlans'][]['planId'] = $plan['planId'];
            } else {
                $data['paymentPlans'][]['name'] = $plan['name'];
                $data['paymentPlans'][0]['planTrackId'] = isset($plan['planTrackId']) ? $plan['planTrackId'] : null;
                $data['paymentPlans'][0]['currency'] = $plan['currency'];
                $data['paymentPlans'][0]['value'] = $plan['value'];
                $data['paymentPlans'][0]['cycle'] = $plan['cycle'];
                $data['paymentPlans'][0]['recurringCount'] = $plan['recurringCount'];
            }
        }

//        if ($this->getCardReference()) {
//            $data['customer'] = $this->getCardReference();
//        } elseif ($this->getTransactionReference()) {
//            $data['card'] = $this->getTransactionReference();
//        } elseif ($this->getCard()) {
//            $data['card'] = $this->getCardData();
//        } else {
//            // one of cardReference, token, or card is required
//            $this->validate('card');
//        }

        return $data;
    }

    public function sendData($data)
    {
        $httpResponse = $this->sendRequest($data);

        return $this->response = new PurchaseResponse($this, $httpResponse->json());
    }

    public function getEndpoint()
    {
        return parent::getEndpoint() . '/charges/card';
    }
}

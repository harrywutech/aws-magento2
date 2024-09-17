<?php
/**
 * Copyright © 2016 Alphaweb. All rights reserved.
 * See more information at http://www.hellomagento2.com
 */
namespace Alphaweb\Alphapay\Model;

use Magento\Checkout\Model\ConfigProviderInterface;
use Magento\Payment\Helper\Data as PaymentHelper;
use Alphaweb\Alphapay\Model\Alphapay;

class AlphapayConfigProvider implements ConfigProviderInterface
{
    /**
     * @var PaymentHelper
     */
    protected $_paymentHelper;

    /**
     * @var \Alphaweb\Alphapay\Model\Alphapay
     */
    protected $_alphapayDirect;

    /**
     * @param PaymentHelper $paymentHelper
     */
    public function __construct(
        PaymentHelper $paymentHelper
    ) {
        $this->_paymentHelper = $paymentHelper;
        $this->_alphapayDirect = $this->_paymentHelper->getMethodInstance(Alphapay::ALIPAY_DIRECT_CODE);
    }

    /**
     * {@inheritdoc}
     */
    public function getConfig()
    {
        $config = [
            'payment' => [
                'alphapaydirect' => [
                    'redirectUrl' => $this->getRedirectUrl(),
                    'alphapayLogoUrl' => $this->getAlphapayLogoUrl()
                ]
            ]
        ];

        return $config;
    }

    /**
     * Return redirect URL for method
     *
     * @return string url
     */
    protected function getRedirectUrl()
    {
        return $this->_alphapayDirect->getRedirectUrl();
    }

    protected function getAlphapayLogoUrl()
    {
        return $this->_alphapayDirect->getAlphapayLogoUrl();
    }
}

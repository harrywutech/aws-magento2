<?php
/**
 * Copyright © 2016 Alphaweb. All rights reserved.
 * See more information at http://www.hellomagento2.com
 */
namespace Alphaweb\Alphapayali\Model;

use Magento\Checkout\Model\ConfigProviderInterface;
use Magento\Payment\Helper\Data as PaymentHelper;
use Alphaweb\Alphapayali\Model\Alphapayali;

class AlphapayaliConfigProvider implements ConfigProviderInterface
{
    /**
     * @var PaymentHelper
     */
    protected $_paymentHelper;

    /**
     * @var \Alphaweb\Alphapayali\Model\Alphapayali
     */
    protected $_alphapayaliDirect;

    /**
     * @param PaymentHelper $paymentHelper
     */
    public function __construct(
        PaymentHelper $paymentHelper
    ) {
        $this->_paymentHelper = $paymentHelper;
        $this->_alphapayaliDirect = $this->_paymentHelper->getMethodInstance(Alphapayali::ALIPAY_DIRECT_CODE);
    }

    /**
     * {@inheritdoc}
     */
    public function getConfig()
    {
        $config = [
            'payment' => [
                'alphapayalidirect' => [
                    'redirectUrl' => $this->getRedirectUrl(),
                    'alphapayaliLogoUrl' => $this->getAlphapayaliLogoUrl()
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
        return $this->_alphapayaliDirect->getRedirectUrl();
    }

    protected function getAlphapayaliLogoUrl()
    {
        return $this->_alphapayaliDirect->getAlphapayaliLogoUrl();
    }
}

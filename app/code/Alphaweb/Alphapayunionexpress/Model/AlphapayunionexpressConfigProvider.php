<?php
/**
 * Copyright © 2016 Alphaweb. All rights reserved.
 * See more information at http://www.hellomagento2.com
 */
namespace Alphaweb\Alphapayunionexpress\Model;

use Magento\Checkout\Model\ConfigProviderInterface;
use Magento\Payment\Helper\Data as PaymentHelper;
use Alphaweb\Alphapayunionexpress\Model\Alphapayunionexpress;

class AlphapayunionexpressConfigProvider implements ConfigProviderInterface
{
    /**
     * @var PaymentHelper
     */
    protected $_paymentHelper;

    /**
     * @var \Alphaweb\Alphapayunionexpress\Model\Alphapayunionexpress
     */
    protected $_alphapayunionexpressDirect;

    /**
     * @param PaymentHelper $paymentHelper
     */
    public function __construct(
        PaymentHelper $paymentHelper
    ) {
        $this->_paymentHelper = $paymentHelper;
        $this->_alphapayunionexpressDirect = $this->_paymentHelper->getMethodInstance(Alphapayunionexpress::UNIONPAYEXPRESS_DIRECT_CODE);
    }

    /**
     * {@inheritdoc}
     */
    public function getConfig()
    {
        $config = [
            'payment' => [
                'alphapayunionexpressdirect' => [
                    'redirectUrl' => $this->getRedirectUrl(),
                    'alphapayunionexpressLogoUrl' => $this->getAlphapayunionexpressLogoUrl()
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
        return $this->_alphapayunionexpressDirect->getRedirectUrl();
    }

    protected function getAlphapayunionexpressLogoUrl()
    {
        return $this->_alphapayunionexpressDirect->getAlphapayunionexpressLogoUrl();
    }
}

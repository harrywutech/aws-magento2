<?php
/**
 * Copyright © 2016 Alphaweb. All rights reserved.
 * See more information at http://www.hellomagento2.com
 */
namespace Alphaweb\Alphapayunion\Model;

use Magento\Checkout\Model\ConfigProviderInterface;
use Magento\Payment\Helper\Data as PaymentHelper;
use Alphaweb\Alphapayunion\Model\Alphapayunion;

class AlphapayunionConfigProvider implements ConfigProviderInterface
{
    /**
     * @var PaymentHelper
     */
    protected $_paymentHelper;

    /**
     * @var \Alphaweb\Alphapayunion\Model\Alphapayunion
     */
    protected $_alphapayunionDirect;

    /**
     * @param PaymentHelper $paymentHelper
     */
    public function __construct(
        PaymentHelper $paymentHelper
    ) {
        $this->_paymentHelper = $paymentHelper;
        $this->_alphapayunionDirect = $this->_paymentHelper->getMethodInstance(Alphapayunion::UNIONPAY_DIRECT_CODE);
    }

    /**
     * {@inheritdoc}
     */
    public function getConfig()
    {
        $config = [
            'payment' => [
                'alphapayuniondirect' => [
                    'redirectUrl' => $this->getRedirectUrl(),
                    'alphapayunionLogoUrl' => $this->getAlphapayunionLogoUrl()
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
        return $this->_alphapayunionDirect->getRedirectUrl();
    }

    protected function getAlphapayunionLogoUrl()
    {
        return $this->_alphapayunionDirect->getAlphapayunionLogoUrl();
    }
}

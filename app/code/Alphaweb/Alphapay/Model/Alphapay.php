<?php
/**
 * Copyright © 2016 Alphaweb. All rights reserved.
 * See more information at http://www.hellomagento2.com
 */

namespace Alphaweb\Alphapay\Model;

/**
 * Class Alphapay
 */
class Alphapay extends \Magento\Payment\Model\Method\AbstractMethod
{

    const ALIPAY_DIRECT_CODE = 'alphapaydirect';
    
    protected $_code = self::ALIPAY_DIRECT_CODE;
    
    protected $gateway = "https://mapi.alphapay.com/gateway.do?";

    /**
     * HTTPS形式消息验证地址
     */
    protected $https_verify_url = 'https://mapi.alphapay.com/gateway.do?service=notify_verify&';
    
    /**
     * HTTP形式消息验证地址 最好用https的
     */
    protected $http_verify_url = 'http://notify.alphapay.com/trade/notify_query.do?';

    /**
     * Availability option
     *
     * @var bool
     */
    protected $_isGateway               = false;
    
    protected $_canAuthorize            = true;
    
    protected $_canCapture              = true;
    
    protected $_canCapturePartial       = false;
    
    protected $_canRefund               = false;
    
    protected $_canVoid                 = false;
    
    protected $_canUseInternal          = false;
    
    protected $_canUseCheckout          = true;
    
    protected $_canUseForMultishipping  = false;

    /**
     * @var \Magento\Framework\UrlInterface
     */
    protected $_urlBuilder;

    /**
     * @var \Magento\Framework\View\Asset\Repository
     */
    protected $_assetRepo;

    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Api\ExtensionAttributesFactory $extensionFactory
     * @param \Magento\Framework\Api\AttributeValueFactory $customAttributeFactory
     * @param \Magento\Payment\Helper\Data $paymentData
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     * @param Logger $logger
     * @param \Magento\Framework\UrlInterface
     * @param \Magento\Framework\View\Asset\Repository
     * @param \Magento\Framework\Model\ResourceModel\AbstractResource $resource
     * @param \Magento\Framework\Data\Collection\AbstractDb $resourceCollection
     * @param array $data
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Api\ExtensionAttributesFactory $extensionFactory,
        \Magento\Framework\Api\AttributeValueFactory $customAttributeFactory,
        \Magento\Payment\Helper\Data $paymentData,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Payment\Model\Method\Logger $logger,
        \Magento\Framework\UrlInterface $urlBuilder,
        \Magento\Framework\View\Asset\Repository $assetRepo,
        \Magento\Framework\Model\ResourceModel\AbstractResource $resource = null,
        \Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null,
        array $data = []
    ) {
        parent::__construct(
            $context,
            $registry,
            $extensionFactory,
            $customAttributeFactory,
            $paymentData,
            $scopeConfig,
            $logger,
            $resource,
            $resourceCollection,
            $data
        );
        $this->_urlBuilder = $urlBuilder;
        $this->_assetRepo = $assetRepo;
    }

    /**
     * Returns Target URL
     *
     * @return   string Target URL
     */
    public function getGatewayUrl()
    {
        return $this->gateway;
    }

    /**
     * Return back URL
     *
     * @return   string URL
     */
    public function getReturnURL()
    {
        return $this->_urlBuilder->getUrl('alphapay/direct/success');
    }

    /**
     * Return URL for Alphapay notify response
     *
     * @return   string URL
     */
    public function getNotifyURL()
    {
        return $this->_urlBuilder->getUrl('alphapay/direct/notify/');
    }

    /**
     * Return URL for handling redirect to Alphapay Gateway
     *
     * @return   string URL
     */
    public function getRedirectUrl()
    {
        return $this->_urlBuilder->getUrl('alphapay/direct/redirect/');
    }

    /**
     * @return string url
     */
    public function getAlphapayLogoUrl()
    {
        return $this->_assetRepo->getUrl('Alphaweb_Alphapay::images/alphapay.png');
    }

    /**
     * Return MD5 key
     *
     * @return   string
     */
    public function getSecurityCode()
    {
        return $this->getConfigData('md5_key');
    }

    public function getPartnerId()
    {
        return $this->getConfigData('partner_id');
    }

    public function getVerifyUrl()
    {
        // return $this->http_verify_url;
        return $this->https_verify_url;
    }

    public function getOrderStatus()
    {
        return $this->getConfigData('order_status');
    }

    public function capture(\Magento\Payment\Model\InfoInterface $payment, $amount)
    {
      
        $payment->setIsPaid(true);
        
        $payment->setTransactionId($payment->getTransactionId());
        
        return $this;
    }
}

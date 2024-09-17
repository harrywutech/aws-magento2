/**
 * Copyright © 2016 Alphaweb. All rights reserved.
 * See more information at http://www.hellomagento2.com
 */
define(
    [
        'Magento_Checkout/js/view/payment/default',
        'jquery',
        'Alphaweb_Alphapay/js/action/set-payment-method',
        'Magento_Checkout/js/model/payment/additional-validators',
        'Magento_Checkout/js/model/quote',
        'Magento_Customer/js/customer-data'
    ],
    function (Component, $, setPaymentMethodAction, additionalValidators, quote, customerData) {
        'use strict';
 
        return Component.extend({
            defaults: {
                template: 'Alphaweb_Alphapay/payment/alphapaydirect'
            },
            /** Redirect to Alphapay*/
            continueToAlphapay: function () {
                if (additionalValidators.validate()) {
                    this.selectPaymentMethod();
                    setPaymentMethodAction(this.messageContainer).done(
                        function () {
                            customerData.invalidate(['cart']);
                            $.mage.redirect(window.checkoutConfig.payment.alphapaydirect.redirectUrl);
                        }
                    );
                    return false;
                }
            },
            getAlphapayLogoSrc: function () {
                return window.checkoutConfig.payment.alphapaydirect.alphapayLogoUrl;
            },
        });
    }
);
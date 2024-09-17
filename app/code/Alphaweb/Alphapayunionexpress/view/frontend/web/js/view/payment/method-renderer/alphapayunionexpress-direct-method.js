/**
 * Copyright © 2016 Alphaweb. All rights reserved.
 * See more information at http://www.hellomagento2.com
 */
define(
    [
        'Magento_Checkout/js/view/payment/default',
        'jquery',
        'Alphaweb_Alphapayunionexpress/js/action/set-payment-method',
        'Magento_Checkout/js/model/payment/additional-validators',
        'Magento_Checkout/js/model/quote',
        'Magento_Customer/js/customer-data'
    ],
    function (Component, $, setPaymentMethodAction, additionalValidators, quote, customerData) {
        'use strict';

        return Component.extend({
            defaults: {
                template: 'Alphaweb_Alphapayunionexpress/payment/alphapayunionexpressdirect'
            },
            /** Redirect to Alphapayunionexpress*/
            continueToAlphapayunionexpress: function () {
                if (additionalValidators.validate()) {
                    this.selectPaymentMethod();
                    setPaymentMethodAction(this.messageContainer).done(
                        function () {
                            customerData.invalidate(['cart']);
                            $.mage.redirect(window.checkoutConfig.payment.alphapayunionexpressdirect.redirectUrl);
                        }
                    );
                    return false;
                }
            },
            getAlphapayunionexpressLogoSrc: function () {
                return window.checkoutConfig.payment.alphapayunionexpressdirect.alphapayunionexpressLogoUrl;
            },
        });
    }
);

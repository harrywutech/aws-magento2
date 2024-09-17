/**
 * Copyright © 2016 Alphaweb. All rights reserved.
 * See more information at http://www.hellomagento2.com
 */
define(
    [
        'uiComponent',
        'Magento_Checkout/js/model/payment/renderer-list'
    ],
    function (
        Component,
        rendererList
    ) {
        'use strict';
        rendererList.push(
            {
                type: 'alphapayunionexpressdirect',
                component: 'Alphaweb_Alphapayunionexpress/js/view/payment/method-renderer/alphapayunionexpress-direct-method'
            }
        );
        /** Add view logic here if needed */
        return Component.extend({});
    }
);

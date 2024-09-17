<?php

namespace Alphaweb\Alphapay\Model;

use Magento\Framework\Option\ArrayInterface;

class AlphapayPlatform implements ArrayInterface {

    public function toOptionArray() {
        return [
            ['value' => 'CAD', 'label' => 'CAD'],
            ['value' => 'USD', 'label' => 'USD']
        ];
    }

}

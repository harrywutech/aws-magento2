<?php

namespace Alphaweb\Alphapayunionexpress\Model;

use Magento\Framework\Option\ArrayInterface;

class AlphapayunionexpressPlatform implements ArrayInterface {

    public function toOptionArray() {
        return [
            ['value' => 'CAD', 'label' => 'CAD'],
            ['value' => 'USD', 'label' => 'USD']
        ];
    }

}

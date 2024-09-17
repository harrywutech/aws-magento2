<?php

namespace Alphaweb\Alphapayali\Model;

use Magento\Framework\Option\ArrayInterface;

class AlphapayaliPlatform implements ArrayInterface {

    public function toOptionArray() {
        return [
            ['value' => 'CAD', 'label' => 'CAD'],
            ['value' => 'USD', 'label' => 'USD']
        ];
    }

}

<?php

namespace Alphaweb\Alphapayunion\Model;

use Magento\Framework\Option\ArrayInterface;

class AlphapayunionPlatform implements ArrayInterface {

    public function toOptionArray() {
        return [
            ['value' => 'CAD', 'label' => 'CAD'],
            ['value' => 'USD', 'label' => 'USD']
        ];
    }

}

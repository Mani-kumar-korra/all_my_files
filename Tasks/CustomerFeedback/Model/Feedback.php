<?php

namespace Tasks\CustomerFeedback\Model;

use Magento\Framework\Model\AbstractModel;

class Feedback extends AbstractModel
{
    protected function _construct()
    {
        $this->_init('Tasks\CustomerFeedback\Model\ResourceModel\Feedback');
    }
}

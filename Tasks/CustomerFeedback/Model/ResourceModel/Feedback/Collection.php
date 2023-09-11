<?php
namespace Tasks\CustomerFeedback\Model\ResourceModel\Feedback;
use Tasks\CustomerFeedback\Model\Feedback as Feedback;
use Tasks\CustomerFeedback\Model\ResourceModel\Feedback as ResourceModelFeedback;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'feedback_id';

    protected function _construct()
    {
        $this->_init(
            Feedback::class,
            ResourceModelFeedback::class
        );
    }
}

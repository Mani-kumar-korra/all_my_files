<?php

namespace Tasks\CustomerFeedback\Block;

use Magento\Framework\View\Element\Template;
// use  Tasks\Feedback\Model\ResourceModel\Feedback\Collection;


class FeedbackForm extends Template
{

    // private $collection;

    /**
     * Display constructor.
     * @param Template\Context $context
     * @param Collection $collection
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        // Collection $collection,

        array $data = []

    ) {
        // $this->collection = $collection;
        parent::__construct($context, $data);



    }

    public function getFormAction()
    {
        return $this->getUrl('customerfeedback/feedback/index');
    }
}

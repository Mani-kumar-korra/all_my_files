<?php
// app/code/VendorName/ModuleName/Block/HomepageFeedback.php

namespace Tasks\CustomerFeedback\Block;

use Magento\Framework\View\Element\Template;
use Tasks\CustomerFeedback\Model\ResourceModel\Feedback\CollectionFactory;

class HomepageFeedback extends Template
{
    protected $feedbackCollectionFactory;

    public function __construct(
        Template\Context $context,
        CollectionFactory $feedbackCollectionFactory,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->feedbackCollectionFactory = $feedbackCollectionFactory;

    }

    public function getApprovedFeedback()
    {
        // Retrieve approved feedback records from the collection
        $feedbackCollection = $this->feedbackCollectionFactory->create();
        $feedbackCollection->addFieldToFilter('status', 'approved');
        $feedbackCollection->setOrder('created_at', 'DESC');

        return $feedbackCollection;
    }
}

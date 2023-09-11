<?php

namespace Tasks\CustomerFeedback\Controller\Feedback;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Tasks\CustomerFeedback\Model\FeedbackFactory;

class Save extends Action
{
    protected $feedbackFactory;

    public function __construct(
        Context $context,
        FeedbackFactory $feedbackFactory
    ) {
        parent::__construct($context);
        $this->feedbackFactory = $feedbackFactory;
    }

    public function execute()
    {
        $postData = $this->getRequest()->getPostValue();

        if (!empty($postData)) {
            try {
                $feedbackModel = $this->feedbackFactory->create();

                // Set the comments data here
                $feedbackModel->setData('feedback', $postData['comment']);

                // Set other data fields here as needed
                if (isset($postData['first_name'])) {
                    $feedbackModel->setData('first_name', $postData['first_name']);
                }
                if (isset($postData['last_name'])) {
                    $feedbackModel->setData('last_name', $postData['last_name']);
                }
                if (isset($postData['email'])) {
                    $feedbackModel->setData('email', $postData['email']);
                }

                $feedbackModel->save();
                $this->messageManager->addSuccessMessage(__('Feedback submitted successfully.'));
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage(__('Failed to submit feedback.'));
            }
        }


        $resultRedirect = $this->resultRedirectFactory->create();
        $resultRedirect->setPath('/');
        return $resultRedirect;
    }

}

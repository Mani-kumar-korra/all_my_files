<?php

//namespace Tasks\CustomerFeedback\Controller\Adminhtml\Index;
//
//use Magento\Backend\App\Action;
//
//class Index extends Action
//{
//    /**
//     * Execute the action.
//     */
//    public function execute()
//    {
//        $this->_view->loadLayout();
//        $this->_view->getPage()->getConfig()->getTitle()->prepend(__('Customer Feedback'));
//
//        $this->_view->renderLayout();
//    }
//}


namespace Tasks\CustomerFeedback\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Framework\App\ResponseInterface;

class Index extends Action
{
    protected $resultPageFactory;

    public function __construct(
        Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    )
    {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend(__('Customer Feedback,  hey there will add data bit later'));

        return $resultPage;
    }
}

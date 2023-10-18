<?php

namespace Example\HelloWorld\frontend\Block;

use Magento\Framework\App\Config\ScopeConfigInterface;

class Index extends \Magento\Framework\View\Element\Template
{
    protected $scopeConfig;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        ScopeConfigInterface $scopeConfig,
        array $data = []
    ) {
        $this->scopeConfig = $scopeConfig;
        parent::__construct($context, $data);
    }

    public function getCustomMessage()
    {
        return "This is a custom block message.";
    }

    public function seedata()
    {
        $configValue = $this->scopeConfig->getValue('general/store_information/name'); // Replace with your configuration path
        return $configValue;
    }
}

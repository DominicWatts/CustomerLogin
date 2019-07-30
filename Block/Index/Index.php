<?php

namespace Xigen\CustomerLogin\Block\Index;

use Magento\Framework\App\Http\Context as CustomerContext;

/**
 * Class Index
 * @package Xigen\CustomerLogin\Block\Index
 */
class Index extends \Magento\Framework\View\Element\Template
{
    /**
     * @var CustomerContext
     */
    protected $customerContext;

    /**
     * Index constructor.
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param CustomerContext $customerContext
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        CustomerContext $customerContext,
        array $data = []
    ) {
        $this->customerContext = $customerContext;
        parent::__construct($context, $data);
    }

    /**
     * Check is Customer Logged In
     * @return int
     */
    public function isCustomerLoggedIn()
    {
        $isLoggedIn = $this->customerContext->getValue(\Magento\Customer\Model\Context::CONTEXT_AUTH);
        return (bool) $isLoggedIn ? 1 : 0;
    }
}

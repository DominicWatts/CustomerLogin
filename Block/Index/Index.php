<?php

namespace Xigen\CustomerLogin\Block\Index;

/**
 * Class Index
 * @package Xigen\CustomerLogin\Block\Index
 */
class Index extends \Magento\Framework\View\Element\Template
{
    /**
     * Constructor
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
    }
}

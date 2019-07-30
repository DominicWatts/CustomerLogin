<?php

namespace Xigen\CustomerLogin\Plugin\Magento\Customer\CustomerData;

/**
 * Class Customer
 * @package Xigen\CustomerLogin\Plugin\Magento\Customer\CustomerData
 */
class Customer
{
    /**
     * @var \Magento\Customer\Model\Session\Proxy
     */
    private $customerSession;

    /**
     * @var \Magento\Customer\Api\GroupRepositoryInterface
     */
    private $groupRepository;

    /**
     * Customer constructor.
     * @param \Magento\Customer\Model\Session\Proxy $customerSession
     * @param \Magento\Customer\Api\GroupRepositoryInterface $groupRepository
     */
    public function __construct(
        \Magento\Customer\Model\Session\Proxy $customerSession,
        \Magento\Customer\Api\GroupRepositoryInterface $groupRepository
    ) {
        $this->customerSession = $customerSession;
        $this->groupRepository = $groupRepository;
    }

    /**
     * @param \Magento\Customer\CustomerData\Customer $subject
     * @param $result
     * @return mixed
     */
    public function afterGetSectionData(\Magento\Customer\CustomerData\Customer $subject, $result)
    {
        $result['is_logged_in'] = $this->customerSession->isLoggedIn();
        if ($this->customerSession->isLoggedIn() && $this->customerSession->getCustomerId()) {
            $customer = $this->customerSession->getCustomer();
            $result['email'] = $customer->getEmail();
            $result['lastname'] = $customer->getLastname();
            $result['customer_group_id'] = $customer->getGroupId();
            $result['customer_group_name'] = $this->getGroupName($customer->getGroupId());
        }

        return $result;
    }

    /**
     * Get group name
     * @param $groupId
     * @return \Magento\Framework\Phrase|string
     */
    public function getGroupName($groupId)
    {
        try {
            $group = $this->groupRepository->getById($groupId);
            return $group->getCode();
        } catch (\Magento\Framework\Exception\NoSuchEntityException $e) {
            return __("None");
        } catch (\Magento\Framework\Exception\LocalizedException $e) {
            return __("None");
        }
    }
}
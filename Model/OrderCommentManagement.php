<?php
namespace Vendor\OrderComment\Model;

use Magento\Quote\Model\QuoteRepository;

class OrderCommentManagement
{
protected $quoteRepository;

public function __construct(QuoteRepository $quoteRepository)
{
$this->quoteRepository = $quoteRepository;
}

public function setComment($cartId, $comment)
{


$objectManager = \Magento\Framework\App\ObjectManager::getInstance();
$quote = $objectManager->create('\Magento\Quote\Model\Quote')->load($cartId);
$quote->setData('customer_comment', $comment);
$quote->save();

}

}
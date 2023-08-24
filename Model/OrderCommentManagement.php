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
$quote = $this->quoteRepository->get($cartId);
$quote->setData('customer_comment', $comment);
$quote->save();
}
}
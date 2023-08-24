<?php
namespace Vendor\OrderComment\Model\Resolver;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Vendor\OrderComment\Model\OrderCommentManagement;

class SetOrderComment implements ResolverInterface
{
protected $orderCommentManagement;

public function __construct(OrderCommentManagement $orderCommentManagement)
{
$this->orderCommentManagement = $orderCommentManagement;
}

public function resolve(
Field $field,
$context,
ResolveInfo $info,
array $value = null,
array $args = null
) {
$this->orderCommentManagement->setComment($args['cart_id'], $args['comment']);
return [
'status' => true,
'message' => 'Comment added successfully.'
];
}
}
<?php
namespace Vendor\OrderComment\Model\Resolver;

use Magento\Framework\Exception\LocalizedException;
use Magento\Sales\Model\OrderFactory;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;

class SetOrderComment implements ResolverInterface
{
    /**
     * @var OrderFactory
     */
    protected $orderFactory;

    /**
     * @param OrderFactory $orderFactory
     */
    public function __construct(
        OrderFactory $orderFactory
    ) {
        $this->orderFactory = $orderFactory;
    }

    /**
     * @inheritdoc
     */
    public function resolve(Field $field, $context, ResolveInfo $info, array $value = null, array $args = null)
    {
        $orderId = $args['order_id'];
        $comment = $args['comment'];

         $order = $this->orderFactory->create()->loadByIncrementId($orderId);
        if (!$order->getId()) {
            throw new LocalizedException(__("Order with ID %1 not found", $orderId));
        }

        $order->setData('customer_comment', $comment);
        $order->save();

        return [
            'order_id' => (int) $orderId,
            'comment' => $comment
        ];
    }
}
<?php
namespace Mage\GridChange\Plugin;

use Magento\Sales\Api\Data\OrderInterface;
use Magento\Sales\Api\OrderRepositoryInterface;
use Magento\Framework\App\RequestInterface;

class OrderSavePlugin
{
    protected $request;

    public function __construct(RequestInterface $request)
    {
        $this->request = $request;
    }

    public function beforeSave(OrderRepositoryInterface $subject, OrderInterface $order)
    {
        $trackingNumber = $this->request->getParam('tracking_number');
        $shippingCarrier = $this->request->getParam('shipping_carrier');

        if ($order->hasShipments()) {
            $order->setData('tracking_number', $trackingNumber);
            $order->setData('shipping_carrier', $shippingCarrier);
        }

        return [$order];
    }
}

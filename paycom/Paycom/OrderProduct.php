<?php
/**
 * Created by PhpStorm.
 * User: Farhodjon
 * Date: 17.01.2018
 * Time: 16:04
 */

namespace Paycom;


class OrderProduct extends Database
{
    const ORDER_DELETED = 0;
    const ORDER_WAITING_PAY = 1;
    const ORDER_PROCESSING = 2;
    const ORDER_RECEIVING_FROM_VENDOR = 3;
    const ORDER_ON_STORE = 4;
    const ORDER_ON_DELIVERY = 5;
    const ORDER_DELIVERED = 6;
    const ORDER_WAITING_CONFIRMATION = 7;
    const ORDER_CONFIRMED_BY_CALL_CENTER = 8;
    const ORDER_CONFIRMED_BY_USER = 10;

    public $request_id;

    public function __construct($request_id)
    {
        $this->request_id = $request_id;
    }

    /**
     * @param $order_id
     *
     * @throws PaycomException
     */
    public function updateStatus ($order_id)
    {
        $db = self::db();

        $sql = "update order_product set status = :pState where order_id = :pId";
        $sth = $db->prepare($sql);
        $is_success = $sth->execute([':pState' => self::ORDER_PROCESSING, ':pId' => $order_id]);


        if (!$is_success) {
            throw new PaycomException($this->request_id, 'Could not save order products.', PaycomException::ERROR_INTERNAL_SYSTEM);
        }
    }
}
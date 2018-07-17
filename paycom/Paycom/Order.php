<?php

namespace Paycom;

/**
 * Class Order
 *
 * Example MySQL table might look like to the following:
 *
 * CREATE TABLE orders
 * (
 *     id          INT AUTO_INCREMENT PRIMARY KEY,
 *     amount      DECIMAL(18, 2) NOT NULL,
 *     state       TINYINT(1)     NOT NULL,
 *     user_id     INT            NOT NULL,
 *     phone       VARCHAR(15)    NOT NULL
 * ) ENGINE = InnoDB;
 *
 */
class Order extends Database
{
    /** Order is available for sell, anyone can buy it. */
    const STATE_AVAILABLE = 0;

    /** Pay in progress, order must not be changed. */
    const STATE_WAITING_PAY = 1;

    /** Order completed and not available for sell. */
    const STATE_PAY_ACCEPTED = 2;

    /** Order is cancelled. */
    const STATE_CANCELLED = 3;

    public $request_id;
    public $params;

    // todo: Adjust Order specific fields for your needs

    /**
     * Order ID
     */
    public $id;

    /**
     * Total price of the selected products/services
     */
    public $amount;

    /**
     * State of the order
     */
    public $state;

    /**
     * Phone number of the user
     */
    public $phone;

    public function __construct($request_id)
    {
        $this->request_id = $request_id;
    }

    /**
     * Validates amount and account values.
     * @param array $params amount and account parameters to validate.
     * @return bool true - if validation passes
     * @throws PaycomException - if validation fails
     */
    public function validate(array $params)
    {
        // todo: Validate amount, if failed throw error
        // for example, check amount is numeric
        if (!is_numeric($params['amount'])) {
            throw new PaycomException(
                $this->request_id,
                PaycomException::message(
                    'Неверная сумма',
                    'Mumkin bo`lmagan summa',
                    'Incorrect amount'
                ),
                PaycomException::ERROR_INVALID_AMOUNT
            );
        }

        // todo: Validate account, if failed throw error
        // assume, we should have order_id
        if (!isset($params['account']['order_id']) || !$params['account']['order_id']) {
            throw new PaycomException(
                $this->request_id,
                PaycomException::message(
                    'Неверный код заказа.',
                    'Harid kodida xatolik.',
                    'Incorrect order code.'
                ),
                PaycomException::ERROR_INVALID_ACCOUNT,
                'order_id'
            );
        }

        // todo: Check is order available

        // assume, after find() $this will be populated with Order data
        $array = $this->find($params['account']);
        if (!$array) {
            throw new PaycomException(
                $this->request_id,
                PaycomException::message(
                    'Неверный код заказа.',
                    'Harid kodida xatolik.',
                    'Incorrect order code.'
                ),
                PaycomException::ERROR_INVALID_ACCOUNT,
                'order_id'
            );
        }

        // validate amount
        // convert $this->amount to coins
        // $params['amount'] already in coins
        if ((100 * $this->amount) != (1 * $params['amount'])) {
            throw new PaycomException(
                $this->request_id,
                'Incorrect amount.',
                PaycomException::ERROR_INVALID_AMOUNT
            );
        }

        // for example, order state before payment should be 'waiting pay'
        if ($this->state != self::STATE_WAITING_PAY) {
            throw new PaycomException(
                $this->request_id,
                'Order state is invalid.',
                PaycomException::ERROR_COULD_NOT_PERFORM
            );
        }

        // keep params for further use
        $this->params = $params;

        return true;
    }

    /**
     * Find order by given parameters.
     * @param mixed $params parameters.
     * @return Order|Order[] found order or array of orders.
     */
    public function find($params)
    {
        // todo: Implement searching order(s) by given parameters, populate current instance with data

        // Example implementation to load order by id
        if (isset($params['order_id'])) {

            $sql        = "select * from orders where id=:orderId";
            $sth        = self::db()->prepare($sql);
            $is_success = $sth->execute([':orderId' => $params['order_id']]);

            if ($is_success) {

                $row = $sth->fetch();

                if ($row) {

                    $this->id          = 1 * $row['id'];
                    $this->amount      = 1 * $row['amount'];
                    $this->state       = 1 * $row['state'];
                    $this->phone       = $row['phone'];

                    return $this;

                }

            }

        }

        return null;
    }

    /**
     * Change order's state to specified one.
     *
     * @param int $state new state of the order
     *
     * @return void
     * @throws PaycomException
     */
    public function changeState($state)
    {
        // todo: Implement changing order state (reserve order after create transaction or free order after cancel)

        // Example implementation
        $this->state = 1 * $state;
        $this->save();
    }

    /**
     * Check, whether order can be cancelled or not.
     * @return bool true - order is cancellable, otherwise false.
     */
    public function allowCancel()
    {
        // todo: Implement order cancelling allowance check

        // Example implementation
        return true; // do not allow cancellation
    }

    /**
     * Saves this order.
     * @throws PaycomException
     */
    public function save()
    {
        $db = self::db();

        if (!$this->id) {

            // If new order, set its state to waiting
            $this->state = self::STATE_WAITING_PAY;

            // todo: Set customer ID
            // $this->user_id = 1 * SomeSessionManager::get('user_id');

            $sql        = "insert into orders set amount = :pAmount, state = :pState, phone = :pPhone";
            $sth        = $db->prepare($sql);
            $is_success = $sth->execute([
                ':pAmount'      => $this->amount,
                ':pState'       => $this->state,
                ':pPhone'       => $this->phone,
            ]);

            if ($is_success) {
                $this->id = $db->lastInsertId();
            }
        } else {

            $sql        = "update orders set state = :pState where id = :pId";
            $sth        = $db->prepare($sql);
            $is_success = $sth->execute([':pState' => $this->state, ':pId' => $this->id]);

        }

        if (!$is_success) {
            throw new PaycomException($this->request_id, 'Could not save order.', PaycomException::ERROR_INTERNAL_SYSTEM);
        }
    }
}

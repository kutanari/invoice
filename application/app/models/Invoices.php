<?php

class Invoices extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var integer
     */
    public $invoice_code;

    /**
     *
     * @var string
     */
    public $subject;

    /**
     *
     * @var string
     */
    public $issue_date;

    /**
     *
     * @var string
     */
    public $due_date;

    /**
     *
     * @var integer
     */
    public $for;

    /**
     *
     * @var integer
     */
    public $from;

    /**
     *
     * @var string
     */
    public $is_paid;

    /**
     *
     * @var string
     */
    public $notes;

    /**
     *
     * @var integer
     */
    public $soft_deleted;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("invoice");
        $this->setSource("invoices");
        $this->hasMany('id', 'InvoiceDetails', 'invoice_id', ['alias' => 'InvoiceDetails']);
        $this->belongsTo('for', '\Customers', 'id', ['alias' => 'CustomerFor']);
        $this->belongsTo('from', '\Customers', 'id', ['alias' => 'CustomerFrom']);
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Invoices[]|Invoices|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null): \Phalcon\Mvc\Model\ResultsetInterface
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Invoices|\Phalcon\Mvc\Model\ResultInterface|\Phalcon\Mvc\ModelInterface|null
     */
    public static function findFirst($parameters = null): ?\Phalcon\Mvc\ModelInterface
    {
        return parent::findFirst($parameters);
    }

    /**
     * Get total price for an invoice
     *
     * @param Invoices $invoice
     * @return float
     */
    public static function getTotalPrice(Invoices $invoice): float
    {
        $total_price = 0;
        foreach ($invoice->InvoiceDetails as $invoice_detail) {
            $quantity = $invoice_detail->quantity;
            $item_price = $invoice_detail->products->unit_price;

            $price = $quantity * $item_price;

            $total_price += $price;
        }

        return $total_price;
    }

    /**
     * get total price plus tax
     *
     * @param Invoices $invoice
     * @param float $tax
     * @return float
     */
    public static function getTotalPriceWithTax(Invoices $invoice, float $tax): float
    {
        $total_price = self::getTotalPrice($invoice);
        return $total_price + $total_price * (100 / $tax);
    }

}

<?php

class InvoiceDetails extends \Phalcon\Mvc\Model
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
    public $invoice_id;

    /**
     *
     * @var integer
     */
    public $product_id;

    /**
     *
     * @var integer
     */
    public $quantity;

    /**
     *
     * @var string
     */
    public $notes;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("invoice");
        $this->setSource("invoice_details");
        $this->belongsTo('invoice_id', '\Invoices', 'invoice_id', ['alias' => 'Invoices']);
        $this->belongsTo('product_id', '\Products', 'id', ['alias' => 'Products']);
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return InvoiceDetails[]|InvoiceDetails|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null): \Phalcon\Mvc\Model\ResultsetInterface
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return InvoiceDetails|\Phalcon\Mvc\Model\ResultInterface|\Phalcon\Mvc\ModelInterface|null
     */
    public static function findFirst($parameters = null): ?\Phalcon\Mvc\ModelInterface
    {
        return parent::findFirst($parameters);
    }

}
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
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("invoice");
        $this->setSource("invoices");
        $this->hasMany('id', 'InvoiceDetails', 'invoice_id', ['alias' => 'InvoiceDetails']);
        $this->belongsTo('for', '\Customers', 'id', ['alias' => 'Customers']);
        $this->belongsTo('from', '\Customers', 'id', ['alias' => 'Customers']);
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

}

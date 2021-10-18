<?php

class Products extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var string
     */
    public $name;

    /**
     *
     * @var integer
     */
    public $product_type_id;

    /**
     *
     * @var double
     */
    public $unit_price;

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
        $this->setSource("products");
        $this->hasMany('id', 'InvoiceDetails', 'product_id', ['alias' => 'InvoiceDetails']);
        $this->belongsTo('product_type_id', '\ProductTypes', 'id', ['alias' => 'ProductTypes']);
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Products[]|Products|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null): \Phalcon\Mvc\Model\ResultsetInterface
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Products|\Phalcon\Mvc\Model\ResultInterface|\Phalcon\Mvc\ModelInterface|null
     */
    public static function findFirst($parameters = null): ?\Phalcon\Mvc\ModelInterface
    {
        return parent::findFirst($parameters);
    }

}

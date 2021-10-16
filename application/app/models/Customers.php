<?php

class Customers extends \Phalcon\Mvc\Model
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
     * @var string
     */
    public $address;

    /**
     *
     * @var string
     */
    public $country;

    /**
     *
     * @var string
     */
    public $country_code;

    /**
     *
     * @var string
     */
    public $city;

    /**
     *
     * @var string
     */
    public $postcode;

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
        $this->setSource("customers");
        $this->hasMany('id', 'Invoices', 'for', ['alias' => 'Invoices']);
        $this->hasMany('id', 'Invoices', 'from', ['alias' => 'Invoices']);
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Customers[]|Customers|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null): \Phalcon\Mvc\Model\ResultsetInterface
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Customers|\Phalcon\Mvc\Model\ResultInterface|\Phalcon\Mvc\ModelInterface|null
     */
    public static function findFirst($parameters = null): ?\Phalcon\Mvc\ModelInterface
    {
        return parent::findFirst($parameters);
    }

}

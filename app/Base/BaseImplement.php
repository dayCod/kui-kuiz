<?php

namespace App\Base;

use App\Base\BaseInterface;

abstract class BaseImplement implements BaseInterface
{
    /**
     * return expected array results
     *
     * @var array
     */
    protected $results;

    /**
     * construct protected variable results to array
     *
     * @var array
     */
    public function __construct()
    {
        $this->results = ['response_code' => null, 'success' => false, 'message' => null, 'data' => null];
    }

    /**
     * pass the data transfer object to the process function services
     *
     * @param array
     */
    abstract protected function process( array $dto );

    /**
     * implement execute data transfer object from controller
     *
     * @param array
     */
    public function execute( array $dto )
    {
        $this->process( $dto );

        return $this->results;
    }
}

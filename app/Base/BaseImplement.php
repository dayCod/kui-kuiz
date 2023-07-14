<?php

namespace App\Base;

use App\Base\BaseInterface;

abstract class BaseImplement implements BaseInterface
{
    protected $results;

    public function __construct()
    {
        $this->results = ['response_code' => null, 'success' => false, 'message' => null, 'data' => null];
    }

    abstract protected function process( $dto );

    public function execute( $input_data )
    {
        $this->process( $input_data );

        return $this->results;
    }
}

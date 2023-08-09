<?php

namespace App\Base;

interface BaseInterface
{
    /**
     * execute data transfer object from controller
     *
     * @param array $dto
     */
    public function execute( array $dto );
}

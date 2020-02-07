<?php


namespace App\Image\Filter\Contracts;


interface FilterInterface
{
    public function apply(array $options);
}
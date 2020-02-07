<?php


namespace App\Image\Filter;


use App\Image\Filter\Contracts\FilterInterface;

class Blur extends FilterAbstract implements FilterInterface
{
    
    public function apply(array $options)
    {
        return $this->image->blur($options[0] ?: 0);
    }
}
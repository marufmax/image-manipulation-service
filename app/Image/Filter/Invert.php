<?php


namespace App\Image\Filter;


use App\Image\Filter\Contracts\FilterInterface;

class Invert extends FilterAbstract implements FilterInterface
{
    
    public function apply(array $options)
    {
        return $this->image->invert();
    }
}
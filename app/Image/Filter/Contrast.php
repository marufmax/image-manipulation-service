<?php


namespace App\Image\Filter;


use App\Image\Filter\Contracts\FilterInterface;

class Contrast extends FilterAbstract implements FilterInterface
{
    
    public function apply(array $options)
    {
        return $this->image->contrast($options[0] ?: 0);
    }
}
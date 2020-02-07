<?php


namespace App\Image\Filter;


use App\Image\Filter\Contracts\FilterInterface;

class Brightness extends FilterAbstract implements FilterInterface
{
    
    public function apply(array $options)
    {
        return $this->image->brightness($options[0]);
    }
}
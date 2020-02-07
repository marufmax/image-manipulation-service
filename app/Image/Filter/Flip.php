<?php


namespace App\Image\Filter;


use App\Image\Filter\Contracts\FilterInterface;

class Flip extends FilterAbstract implements FilterInterface
{
    
    public function apply(array $options)
    {
        return $this->image->flip($options[0]);
    }
}
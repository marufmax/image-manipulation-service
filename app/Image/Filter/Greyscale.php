<?php


namespace App\Image\Filter;


use App\Image\Filter\Contracts\FilterInterface;

class Greyscale extends FilterAbstract implements FilterInterface
{
    
    public function apply(array $options)
    {
        return $this->image->greyscale();
    }
}
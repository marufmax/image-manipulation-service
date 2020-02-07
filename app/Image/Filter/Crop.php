<?php


namespace App\Image\Filter;


use App\Image\Filter\Contracts\FilterInterface;

class Crop extends FilterAbstract implements FilterInterface
{
    
    public function apply(array $options)
    {
        list($width, $height, $offsetX, $offsetY) = $options;
        
        return $this->image->crop($width, $height, $offsetX, $offsetY);
    }
}
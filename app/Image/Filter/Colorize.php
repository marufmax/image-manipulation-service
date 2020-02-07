<?php


namespace App\Image\Filter;


use App\Image\Filter\Contracts\FilterInterface;

class Colorize extends FilterAbstract implements FilterInterface
{
    
    public function apply(array $options)
    {
        $red = $options[0] ?: 0;
        $green = $options[1] ?: 0;
        $blue = $options[2] ?: 0;
        
        return $this->image->colorize($red, $green, $blue);
    }
}
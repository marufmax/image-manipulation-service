<?php


namespace App\Image\Filter;


use App\Image\Filter\Contracts\FilterInterface;

class Resize extends FilterAbstract implements FilterInterface
{
    
    public function apply(array $options)
    {
        return $this->image->resize($options[0] ?? null, $options[1] ?? null, function ($constrain) use ($options) {
            if (isset($options[2]) && $options[2] === 'aspect') {
                $constrain->aspectRatio();
            }
    
            if (isset($options[3]) && $options[3] === 'upsize') {
                $constrain->upsize();
            }
        });
    }
}
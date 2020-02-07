<?php


namespace App\Image;


use Intervention\Image\ImageManager;
use Noodlehaus\Config;

class Manipulator
{
    /**
     * @var ImageManager
     */
    private $manager;
    
    private $image;
    /**
     * @var Config
     */
    private $config;
    
    public function __construct(ImageManager $manager, Config $config)
    {
        $this->manager = $manager;
        $this->config = $config;
    }
    
    public function load($file)
    {
        $this->image = $this->manager->make($file);
        
        return $this;
    }
    
    public function withFilters(array $filters)
    {
        $this->applyFilters($filters);
        
        return $this;
    }
    
    public function stream()
    {
        return $this->image->encode('png')->stream();
    }
    
    protected function applyFilters(array $filters)
    {
        $availableFilters = $this->config->get('image.filters');
    
        foreach ($filters as $filter => $option) {
            if (!in_array($filter, array_keys($availableFilters))) {
                continue;
            }
        
            $this->image = (new $availableFilters[$filter]($this->image))->apply(explode(',', $option));
        }
    }
}
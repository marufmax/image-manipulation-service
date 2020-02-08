<?php


namespace App\Storage;


use App\Storage\Contracts\StorageInterface;
use League\Flysystem\Adapter\Local;
use League\Flysystem\FileNotFoundException;
use League\Flysystem\Filesystem;

class FileStorage implements StorageInterface
{
    /**
     * @var Filesystem
     */
    private $filesystem;
    
    public function __construct(Filesystem $filesystem)
    {
        $this->filesystem = $filesystem;
    }
    
    public function get($pathToFile)
    {
        try {
            return $this->filesystem->get($pathToFile);
        } catch (FileNotFoundException $e) {
            throw new \App\Storage\Exceptions\FileNotFoundException();
        }
    }
}
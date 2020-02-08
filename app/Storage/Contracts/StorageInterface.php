<?php


namespace App\Storage\Contracts;


interface StorageInterface
{
    public function get($pathToFile);
}
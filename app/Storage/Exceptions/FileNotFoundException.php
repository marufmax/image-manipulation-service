<?php


namespace App\Storage\Exceptions;


use Exception;

class FileNotFoundException extends Exception
{
    protected $message = 'That file could not be found';
}
<?php

namespace App\services\data\Utility;

interface ILoggerService
{
    // static function getLogger();
    public  function debug($message, $data);
    public  function info($message, $data);
    public  function warning($message, $data);
    public  function error($message, $data);
}
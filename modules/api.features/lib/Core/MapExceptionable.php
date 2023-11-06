<?php
namespace Api\Core;

interface MapExceptionable
{
    public function mapExceptions(\Exception $e): void;

}
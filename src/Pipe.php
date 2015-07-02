<?php

namespace AZnC\PipeArray;


class Pipe
{
    public static function Start($elements)
    {
        return new PipeArray($elements);
    }
}
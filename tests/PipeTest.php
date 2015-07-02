<?php

namespace AZnC\PipeArray;


class PipeTest extends \PHPUnit_Framework_TestCase {
    public function testStart()
    {
        $score = [40, 55, 32, 63];

        // add bonus and check passed score
        $passedScore = Pipe::Start($score)
            ->map(function($e){ return intval(sqrt($e) * 10); }) // [63, 74, 56, 79]
            ->filter(function($e){ return $e >= 60; })
            ->values() // reset index number
            ->rawData();

        $this->assertSame(3, count($passedScore));
        $this->assertSame(63, $passedScore[0]);
        $this->assertSame(74, $passedScore[1]);
        $this->assertSame(79, $passedScore[2]);
    }
}

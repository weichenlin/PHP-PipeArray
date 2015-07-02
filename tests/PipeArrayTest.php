<?php

namespace AZnC\PipeArray;


class PipeArrayTest extends \PHPUnit_Framework_TestCase {

    public function testArrayAccessGet()
    {
        $p = new PipeArray([5]);

        $this->assertSame(5, $p[0]);
    }

    public function testArrayAccessSet()
    {
        $p = new PipeArray([4, 5]);

        $p[0] = 10;

        $this->assertSame(10, $p[0]);
    }

    public function testArrayAccessPut()
    {
        $p = new PipeArray([3]);

        $p[] = "foo";

        $this->assertSame("foo", $p[1]);
    }

    public function testConstructByNonArray()
    {
        $p = new PipeArray("hmm");

        $this->assertSame("hmm", $p[0]);
    }

    public function testCount()
    {
        $p = new PipeArray([1, 2, 3]);
        $this->assertSame(3, $p->count());

        $p[] = 4;
        $this->assertSame(4, $p->count());

        unset($p[0]);
        $this->assertSame(3, $p->count());
    }

    public function testCountable()
    {
        $p = new PipeArray();

        $p[] = "hmm";

        $this->assertSame(1, count($p));
        $this->assertSame("hmm", $p[0]);
    }

    public function testPush()
    {
        $p = new PipeArray();

        $size = $p->push("bar");

        $this->assertSame(1, $size);
        $this->assertSame("bar", $p[0]);
    }

    public function testMap()
    {
        $p = new PipeArray([1, 2, 3]);

        $q = $p->map( function($e) { return $e + 1; } );

        $this->assertSame(3, $q->count());
        $this->assertSame(2, $q[0]);
        $this->assertSame(3, $q[1]);
        $this->assertSame(4, $q[2]);
    }

    public function testMapNotChangeArray()
    {
        $p = new PipeArray([1, 2, 3]);

        $p->map( function($e) { return $e + 1; } );

        $this->assertSame(3, $p->count());
        $this->assertSame(1, $p[0]);
        $this->assertSame(2, $p[1]);
        $this->assertSame(3, $p[2]);
    }

    public function testPipeMap()
    {
        $p = new PipeArray([1, 2, 3]);

        $q = $p->map( function($e) { return $e + 1; } )
            ->map( function($e) { return $e * 2; } );

        $this->assertSame(3, $q->count());
        $this->assertSame(4, $q[0]);
        $this->assertSame(6, $q[1]);
        $this->assertSame(8, $q[2]);
    }

    public function testUnshift()
    {
        $p = new PipeArray([1, 2]);

        $p->unshift(0, 9);

        $this->assertSame(4, $p->count());
        $this->assertSame(0, $p[0]);
        $this->assertSame(9, $p[1]);
        $this->assertSame(1, $p[2]);
        $this->assertSame(2, $p[3]);
    }

    public function testGrep()
    {
        $p = new PipeArray(["a.txt", "b.txt", "c.dat", "ddtxt"]);

        $q = $p->grep('/\.txt/');

        $this->assertSame(2, $q->count());
        $this->assertSame("a.txt", $q[0]);
        $this->assertSame("b.txt", $q[1]);
    }
}

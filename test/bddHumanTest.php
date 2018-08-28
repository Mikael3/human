<?php
/**
 * Created by PhpStorm.
 * User: Lukas Lepez
 * Date: 21/08/2018
 * Time: 23:15
 */

use PHPUnit\Framework\TestCase;
include '../bddHuman.php';

class BddHumanTest extends TestCase
{
    protected $bdd;

    public function setUp()
    {
        $this->bdd = new BddHuman();
    }

    public function testEmpty()
    {
        $this->assertNotEmpty($this->bdd);

        return $this->bdd;
    }
}
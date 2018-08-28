<?php
/**
 * Created by PhpStorm.
 * User: Lukas Lepez
 * Date: 21/08/2018
 * Time: 22:52
 */

use PHPUnit\Framework\TestCase;
include '../personnage.php';

class PersonnageTest extends TestCase
{
    protected $personnage;

    public function setUp()
    {
        $this->personnage = new Personnage(1);
    }


    public function testEmpty()
    {
        $this->assertNotEmpty($this->personnage);

        return $this->personnage;
    }
}
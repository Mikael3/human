<?php
/**
 * Created by PhpStorm.
 * User: Lukas Lepez
 * Date: 22/08/2018
 * Time: 07:48
 */

use PHPUnit\Framework\TestCase;
include '../partie.php';

class PartieTest extends TestCase
{
    protected $partie;

    public function setUp()
    {
        $this->partie = new Partie();
    }

    public function testEmpty()
    {

        $this->assertNotEmpty($this->partie);

        return $this->partie;
    }
}
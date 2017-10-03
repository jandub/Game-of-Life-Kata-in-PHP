<?php

namespace Kata\Tests;

use Kata\GameOfLife;

class GameOfLifeTest extends \PHPUnit_Framework_TestCase
{
    public function testCountNeighboursInEmptyMatrix()
    {
        $game = new GameOfLife(5, 5);
        $this->assertEquals(0, $game->countNeighboursAlive(3, 3));
    }

    public function testCountNeighboursIsZero()
    {
        $game = new GameOfLife(5, 5);
        $game->setCellAlive(3, 3);

        $this->assertEquals(0, $game->countNeighboursAlive(3, 3));
    }

    public function testCountNeighboursIsOne()
    {
        $game = new GameOfLife(5, 5);
        $game->setCellAlive(3, 4);

        $this->assertEquals(1, $game->countNeighboursAlive(3, 3));
    }

    public function testCountNeighboursIsTwo()
    {
        $game = new GameOfLife(5, 5);
        $game->setCellAlive(3, 4);
        $game->setCellAlive(4, 4);

        $this->assertEquals(2, $game->countNeighboursAlive(3, 3));
    }

    public function testCountNeighboursIsFour()
    {
        $game = new GameOfLife(5, 5);
        $game->setCellAlive(2, 2);
        $game->setCellAlive(4, 4);
        $game->setCellAlive(2, 4);
        $game->setCellAlive(4, 2);

        $this->assertEquals(4, $game->countNeighboursAlive(3, 3));
    }

    public function testCountNeighboursIsEight()
    {
        $game = new GameOfLife(5, 5);
        $game->setCellAlive(2, 2);
        $game->setCellAlive(2, 3);
        $game->setCellAlive(2, 4);
        $game->setCellAlive(3, 2);
        $game->setCellAlive(3, 3);
        $game->setCellAlive(3, 4);
        $game->setCellAlive(4, 2);
        $game->setCellAlive(4, 3);
        $game->setCellAlive(4, 4);

        $this->assertEquals(8, $game->countNeighboursAlive(3, 3));
    }

    public function testCountNeighboursTopLeft()
    {
        $game = new GameOfLife(5, 5);
        $game->setCellAlive(0, 1);
        $game->setCellAlive(1, 1);
        $game->setCellAlive(1, 0);

        $this->assertEquals(3, $game->countNeighboursAlive(0, 0));
    }

    public function testCountNeighboursBottomRight()
    {
        $game = new GameOfLife(5, 5);
        $game->setCellAlive(3, 4);
        $game->setCellAlive(3, 3);
        $game->setCellAlive(4, 3);

        $this->assertEquals(3, $game->countNeighboursAlive(4, 4));
    }

    public function testSingleAliveDies()
    {
        $game = new GameOfLife(5, 5);
        $game->setCellAlive(3, 3);
        $game->tick();

        $this->assertTrue($game->isDead(3, 3));
    }

    public function testTwoAliveDie()
    {
        $game = new GameOfLife(5, 5);
        $game->setCellAlive(3, 3);
        $game->setCellAlive(2, 3);
        $game->tick();

        $this->assertTrue($game->isDead(3, 3));
        $this->assertTrue($game->isDead(2, 3));
    }

    public function testThreeNeighboursCreateNewCell()
    {
        $game = new GameOfLife(5, 5);
        $game->setCellAlive(3, 3);
        $game->setCellAlive(2, 3);
        $game->setCellAlive(3, 2);
        $game->tick();

        $this->assertTrue($game->isAlive(2, 2));
    }

    public function testThreeAliveStayAlive()
    {
        $game = new GameOfLife(5, 5);
        $game->setCellAlive(3, 3);
        $game->setCellAlive(2, 3);
        $game->setCellAlive(3, 2);
        $game->tick();

        $this->assertTrue($game->isAlive(2, 3));
        $this->assertTrue($game->isAlive(3, 2));
        $this->assertTrue($game->isAlive(3, 3));
    }

    public function testFourNeighboursKillTheCell()
    {
        $game = new GameOfLife(5, 5);
        $game->setCellAlive(1, 2);
        $game->setCellAlive(2, 2);
        $game->setCellAlive(2, 3);
        $game->setCellAlive(3, 2);
        $game->setCellAlive(3, 3);
        $game->tick();

        $this->assertTrue($game->isDead(2, 2));
    }
}
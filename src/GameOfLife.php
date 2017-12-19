<?php

namespace Kata;

class GameOfLife
{
    const DEAD = 0;
    const ALIVE = 1;

    private $width, $height;
    private $matrix = array();


    public function __construct($width, $height)
    {
        $this->width = $width;
        $this->height = $height;

        // initialize the matrix with all dead
        $this->matrix = array_fill(0, $height, array_fill(0, $width, self::DEAD));
    }

    public function tick()
    {
        foreach ($this->matrix as $rowIndex => $row) {
            foreach ($row as $cellIndex => $cellValue) {
                $aliveNeighboursCount = $this->countNeighboursAlive($rowIndex, $cellIndex);

                if ($this->isAlive($rowIndex, $cellIndex)) {
                    // check for underpopulation and overcrowding
                    if ($aliveNeighboursCount < 2 || $aliveNeighboursCount > 3) {
                        $this->setCellDead($rowIndex, $cellIndex);
                    }
                } else {
                    if ($aliveNeighboursCount == 3) {
                        $this->setCellAlive($rowIndex, $cellIndex);
                    }
                }
            }
        }

        return $this->matrix;
    }

    public function countNeighboursAlive($cellRow, $cellCol)
    {
        $count = 0;

        for ($row = ($cellRow - 1); $row <= ($cellRow + 1); $row++) {
            for ($col = ($cellCol - 1); $col <= ($cellCol + 1); $col++) {
                if (isset($this->matrix[$row][$col]) && 
                        !($row == $cellRow && $col == $cellCol) && 
                        $this->isAlive($row, $col)) {
                    $count++;
                }
            }
        }

        return $count;
    }

    public function setCellAlive($row, $col)
    {
        if (isset($this->matrix[$row][$col])) {
            $this->matrix[$row][$col] = self::ALIVE;
        }
    }

    public function setCellDead($row, $col)
    {
        if (isset($this->matrix[$row][$col])) {
            $this->matrix[$row][$col] = self::DEAD;
        }
    }

    public function isAlive($row, $col)
    {
        if (isset($this->matrix[$row][$col])) {
            return $this->matrix[$row][$col] == self::ALIVE;
        }
        
        throw new Exception('Coordinates out of the matrix!');
    }

    public function isDead($row, $col)
    {
        if (isset($this->matrix[$row][$col])) {
            return $this->matrix[$row][$col] == self::DEAD;
        }
        
        throw new Exception('Coordinates out of the matrix!');
    }
}
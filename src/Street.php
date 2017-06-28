<?php

namespace kouinkouin\StreetParser;

class Street
{
    /** @var string */
    private $name;
    /** @var string */
    private $number;
    /** @var string */
    private $box;
    /** @var int */
    private $score;

    public function getName(): string
    {
        return (string)$this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getNumber(): string
    {
        return (string)$this->number;
    }

    public function setNumber(string $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getBox(): string
    {
        return (string)$this->box;
    }

    public function setBox(string $box): self
    {
        $this->box = $box;

        return $this;
    }

    public function getScore(): int
    {
        return $this->score;
    }

    public function setScore(int $score): self
    {
        $this->score = $score;

        return $this;
    }
}

<?php

namespace kouinkouin\StreetParser;

class StreetParser
{
    public function getStreetDataFromFullStreet(string $fullStreet): Street
    {
        $bestResult = $this->getEmptyStreet();

        foreach ($this->getRegexLines() as $regexLine) {
            $result = $this->getLineResult($regexLine, $fullStreet);

            if ($result->getScore() > $bestResult->getScore()) {
                $bestResult = $result;
            }
        }

        return $bestResult;
    }

    private function getEmptyStreet(): Street
    {
        return (new Street)->setScore(-1);
    }

    /**
     * @return array
     */
    private function getRegexLines()
    {
        // Use https://www.regex101.com to debug regex :)
        return [
            [
                'regex'  => '/(.*)/', // basic
                'name'   => 1,
                'number' => -1,
                'box'    => -1,
            ],
            // Belgian format. "," mandatory to separate the street and the number+box
            [
                'regex'  => '/^(.*\w)\ *\,\ *(\d+\w*)[\/\ ]*(\d*\w*)$/',
                'name'   => 1,
                'number' => 2,
                'box'    => 3,
            ],
            // Belgian format. Without "," to separate the street and the number. Don't detect the box
            [
                'regex'  => '/^(.*[a-zA-Z])\ *(\d+\w*)([\/\ ]*)(\d*\w*)$/',
                'name'   => 1,
                'number' => 2,
                'box'    => -1,
            ],
            // Belgian format. Without "," to separate the street and the number. Don't detect the box
            [
                'regex'  => '/^(.*[a-zA-Z])\ *(\d+\w*)[\/\ ]+(\d+\w*)$/',
                'name'   => 1,
                'number' => 2,
                'box'    => 3,
            ],
        ];
    }

    private function getLineResult(array $regexLine, string $fullStreet): Street
    {
        if (preg_match($regexLine['regex'], $fullStreet, $matches)) {
            return $this->getMatchResult($matches, $regexLine);
        }

        return $this->getEmptyStreet();
    }

    private function getMatchResult(array $matches, array $regexLine): Street
    {
        $result = new Street();
        $score  = 0;

        foreach (['name', 'number', 'box'] as $streetItem) {
            $setter = 'set' . ucfirst($streetItem);
            if (isset($matches[$regexLine[$streetItem]])) {
                $result->$setter($matches[$regexLine[$streetItem]]);
                $score++;
            }
        }

        $result->setScore($score);

        return $result;
    }
}

<?php

namespace kouinkouin\StreetParser;

class StreetParser
{
    /**
     * @param string $fullStreet
     *
     * @return array
     */
    public function getStreetDataFromFullStreet($fullStreet)
    {
        // Use https://www.regex101.com to debug regex :)

        $regexLines = [
            [
                'regex'  => '/(.*)/', // basic
                'street' => 1,
                'number' => -1,
                'box'    => -1,
            ],
            [ // Belgian format. "," mandatory to separate the street and the number+box
              'regex'  => '/^(.*\w)\ *\,\ *(\d+\w*)[\/\ ]*(\d*\w*)$/',
              'street' => 1,
              'number' => 2,
              'box'    => 3,
            ],
            [ // Belgian format. Without "," to separate the street and the number. Don't detect the box
              'regex'  => '/^(.*[a-zA-Z])\ *(\d+\w*)([\/\ ]*)(\d*\w*)$/',
              'street' => 1,
              'number' => 2,
              'box'    => -1,
            ],
            [ // Belgian format. Without "," to separate the street and the number. Don't detect the box
              'regex'  => '/^(.*[a-zA-Z])\ *(\d+\w*)[\/\ ]+(\d+\w*)$/',
              'street' => 1,
              'number' => 2,
              'box'    => 3,
            ],
        ];

        $bestResult = ['score' => -1];

        foreach ($regexLines as $regexLine) {
            $result = ['score' => -1];

            if (preg_match($regexLine['regex'], $fullStreet, $matches)) {
                $result = $this->getResult($matches, $regexLine);
            }

            if ($result['score'] > $bestResult['score']) {
                $bestResult = $result;
            }
        }

        return $bestResult;
    }

    /**
     * @param array $matches
     * @param array $regexLine
     *
     * @return array
     */
    private function getResult(array $matches, array $regexLine)
    {
        $result = [];
        $score  = 0;

        foreach (['street', 'number', 'box'] as $streetItem) {
            if (isset($matches[$regexLine[$streetItem]])) {
                $score++;
                $result[$streetItem] = $matches[$regexLine[$streetItem]];
            } else {
                $result[$streetItem] = '';
            }
        }

        $result['score'] = $score;

        return $result;
    }
}

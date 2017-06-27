<?php

namespace kouinkouin\StreetParser\StreetSolverTests;

use kouinkouin\StreetParser\StreetParser;

class StreetSolverTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider provider_test_init_street_number()
     *
     * @param string $input_street
     * @param string $expected_street
     * @param string $expected_number
     * @param string $expected_box
     */
    public function testGetStreetDataFromFullStreet($input_street, $expected_street, $expected_number, $expected_box)
    {

        $bpost_street_solver = new StreetParser();

        $output_address = $bpost_street_solver->getStreetDataFromFullStreet($input_street);

        $this->assertSame($expected_street, $output_address['street'], 'Street');
        $this->assertSame($expected_number, $output_address['number'], 'Number');
        $this->assertSame($expected_box, $output_address['box'], 'Box');
    }

    /**
     * @return array
     */
    public function provider_test_init_street_number()
    {
        return [
            [
                'input_street'    => 'Le Grand Ecotay',
                'expected_street' => 'Le Grand Ecotay',
                'expected_number' => '',
                'expected_box'    => '',
            ],
            [
                'input_street'    => 'Rue du Grand Duc, 13',
                'expected_street' => 'Rue du Grand Duc',
                'expected_number' => '13',
                'expected_box'    => '',
            ],
            [
                'input_street'    => 'Rue du Grand Duc 13',
                'expected_street' => 'Rue du Grand Duc',
                'expected_number' => '13',
                'expected_box'    => '',
            ],
            [
                'input_street'    => 'Place van Meenen, 3G/005',
                'expected_street' => 'Place van Meenen',
                'expected_number' => '3G',
                'expected_box'    => '005',
            ],
            [
                'input_street'    => 'Place van Meenen, 3G 5',
                'expected_street' => 'Place van Meenen',
                'expected_number' => '3G',
                'expected_box'    => '5',
            ],
            [
                'input_street'    => 'Place van Meenen ,3g 5',
                'expected_street' => 'Place van Meenen',
                'expected_number' => '3g',
                'expected_box'    => '5',
            ],
            [
                'input_street'    => 'Place van Meenen 3 002G',
                'expected_street' => 'Place van Meenen',
                'expected_number' => '3',
                'expected_box'    => '002G',
            ],
            [
                'input_street'    => 'Place van Meenen 3 / 002G',
                'expected_street' => 'Place van Meenen',
                'expected_number' => '3',
                'expected_box'    => '002G',
            ],
            [
                'input_street'    => 'Place van Meenen, 3 002G',
                'expected_street' => 'Place van Meenen',
                'expected_number' => '3',
                'expected_box'    => '002G',
            ],
            [
                'input_street'    => 'Place van Meenen, 4k 003G',
                'expected_street' => 'Place van Meenen',
                'expected_number' => '4k',
                'expected_box'    => '003G',
            ],
        ];
    }
}

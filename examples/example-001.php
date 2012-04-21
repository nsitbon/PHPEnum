<?php
require_once('../src/enum.php');

use \nsitbon\Enum;

class Color extends Enum
{
    const RED   = 0, ORANGE = 1, YELLOW = 2,
          GREEN = 3, BLUE   = 4, INDIGO = 5, VIOLET = 6;
}

class Test
{
    public static function main()
    {
        $color1 = Color::BLUE();
        $color2 = Color::YELLOW();
        $color3 = Color::BLUE();

        self::displayColor($color1);
        self::displayColor($color2);
        self::displayColor($color3);

        self::compareColor($color1, $color2);
        self::compareColor($color2, $color3);
        self::compareColor($color1, $color3);
        self::compareColor($color1, $color1);

        try
        {
            $invalidColor = Color::BLACK();
        }
        catch(\BadFunctionCallException $e)
        {
            echo 'error : ' . $e->getMessage() . "\n";
        }
    }

    private static function compareColor(Color $color1, Color $color2)
    {
        printf("$color1 %s $color2\n", $color1 === $color2 ? "===" : "!==");
        printf("$color1 %s $color2\n", $color1 == $color2 ? "==" : "!=");
    }

    private static function displayColor(Color $color)
    {
        echo $color . " is my favorite color!\n";
    }
}

Test::main();
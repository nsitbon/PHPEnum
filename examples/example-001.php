<?php
function autoload($className)
{
    require_once('..\\src\\' . $className . '.php');
}

spl_autoload_register('autoload', true);

use \NSitbon\Enum;

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

        switch ($color1)
        {
            case Color::RED(): echo 'red' . "\n"; break;
            case Color::ORANGE(): echo 'orange' . "\n"; break;
            case Color::YELLOW(): echo 'yellow' . "\n"; break;
            case Color::GREEN(): echo 'green' . "\n"; break;
            case Color::BLUE(): echo 'blue' . "\n"; break;
            case Color::INDIGO(): echo 'indigo' . "\n"; break;
            case Color::VIOLET(): echo 'violet' . "\n"; break;
        }

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
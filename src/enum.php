<?php
namespace nsitbon;
/**
 * Created by JetBrains PhpStorm.
 * User: nsitbon
 * Date: 20/04/12
 * Time: 18:33
 */
class BadEnumValueException extends \Exception
{
    public function __construct($enumType, $value)
    {
        parent::__construct("Enum $enumType doesn't contain value '$value'");
    }
}

class Enum
{
    private $value;
    private static $instances;

    public function __toString()
    {
        return array_search($this, self::$instances, true);
    }

    public static function __callStatic($name, $arguments)
    {
        if (!isset(self::$instances))
        {
            self::createInstances();
        }

        if (isset(self::$instances[$name]))
        {
            return self::$instances[$name];
        }
        else
        {
            throw new BadEnumValueException(get_called_class(), $name);
        }
    }

    private function __construct($value)
    {
        $this->value = $value;
    }

    private static function createInstances()
    {
        self::$instances = array();
        $reflector = new \ReflectionClass(get_called_class());

        foreach($reflector->getConstants() as $key => $value)
        {
            self::$instances[$key] = new static($value);
        }
    }
}
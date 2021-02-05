<?php

namespace AllDigitalRewards\IndustryProgramEnum;

use ReflectionClass;
use ReflectionException;

abstract class BasicEnum
{
    private static ?array $constCacheArray = null;

    /**
     * @return array|mixed
     * @throws ReflectionException
     */
    protected static function getConstants(): array
    {
        if (self::$constCacheArray == null) {
            self::$constCacheArray = [];
        }
        $calledClass = get_called_class();
        if (!array_key_exists($calledClass, self::$constCacheArray)) {
            $reflect = new ReflectionClass($calledClass);
            self::$constCacheArray[$calledClass] = $reflect->getConstants();
        }
        return self::$constCacheArray[$calledClass];
    }

    /**
     * @param $status
     * @return bool
     * @throws ReflectionException
     */
    public function isValid($status): bool
    {
        return self::isValidName($status) || self::isValidValue($status);
    }

    /**
     * @param $industry
     * @param bool $returnKeyName //get KEY or VALUE
     * @return mixed
     * @throws ReflectionException
     */
    public function hydrate($industry, $returnKeyName = false)
    {
        $industry = strtolower($industry);
        $values = self::getConstants();
        foreach ($values as $key => $value) {
            if ($industry === strtolower($key) || $industry === strtolower($value)) {
                return $returnKeyName === false ? $value : $key;
            }
        }

        return null;
    }

    /**
     * @param $name
     * @param false $strict
     * @return bool
     * @throws ReflectionException
     */
    private static function isValidName($name, $strict = false): bool
    {
        $constants = self::getConstants();

        if ($strict) {
            return array_key_exists($name, $constants);
        }

        $keys = array_map('strtolower', array_keys($constants));
        return in_array(strtolower($name), $keys);
    }

    /**
     * @param $value
     * @param bool $strict
     * @return bool
     * @throws ReflectionException
     */
    private static function isValidValue($value, $strict = true): bool
    {
        if ($value === null || is_numeric($value) === false || ctype_digit((string)$value) === false) {
            return false;
        }

        $values = array_values(self::getConstants());
        return in_array((int) $value, $values, $strict);
    }
}

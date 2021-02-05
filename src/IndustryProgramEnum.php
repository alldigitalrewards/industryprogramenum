<?php

namespace AllDigitalRewards\IndustryProgramEnum;

use ReflectionException;

class IndustryProgramEnum extends BasicEnum
{
    const Health_Wellness = 1;
    const Channel_Sales = 2;
    const Employee_Recognition = 3;
    const Consumer = 4;
    const Market_Research = 5;
    const Loyalty_Marketing = 6;
    const Rebates = 7;

    /**
     * This is helpful for Report Api (maybe displaying)
     *
     * @return array
     * @throws ReflectionException
     */
    public function getAvailableIndustries(): array
    {
        return self::getConstants();
    }
}

<?php

namespace AllDigitalRewards\Tests;

use AllDigitalRewards\IndustryProgramEnum\IndustryProgramEnum;
use PHPUnit\Framework\TestCase;

class IndustryProgramEnumTest extends TestCase
{
    public function testReturnsAvailableIndustries()
    {
        $this->assertSame(1, IndustryProgramEnum::Health_Wellness);
        $this->assertSame(2, IndustryProgramEnum::Channel_Sales);
        $this->assertSame(3, IndustryProgramEnum::Employee_Recognition);
        $this->assertSame(4, IndustryProgramEnum::Consumer);
        $this->assertSame(5, IndustryProgramEnum::Market_Research);
        $this->assertSame(6, IndustryProgramEnum::Loyalty_Marketing);
        $this->assertSame(7, IndustryProgramEnum::Rebates);
    }

    public function testHasValidIndustryNameReturnsFalse()
    {
        $this->assertFalse((new IndustryProgramEnum())->isValid('HealthWellness'));
        $this->assertFalse((new IndustryProgramEnum())->isValid('ChannelSales'));
        $this->assertFalse((new IndustryProgramEnum())->isValid('EmployeeRecognition'));
        $this->assertFalse((new IndustryProgramEnum())->isValid('Consume'));
        $this->assertFalse((new IndustryProgramEnum())->isValid('MarketResearch'));
        $this->assertFalse((new IndustryProgramEnum())->isValid('LoyaltyMarketing'));
        $this->assertFalse((new IndustryProgramEnum())->isValid('Rebate'));
        $this->assertFalse((new IndustryProgramEnum())->isValid('Ishouldntpass'));
    }

    public function testHasValidIndustryNameReturnsTrue()
    {
        $this->assertTrue((new IndustryProgramEnum())->isValid('Health_Wellness'));
        $this->assertTrue((new IndustryProgramEnum())->isValid('Channel_Sales'));
        $this->assertTrue((new IndustryProgramEnum())->isValid('Employee_Recognition'));
        $this->assertTrue((new IndustryProgramEnum())->isValid('Consumer'));
        $this->assertTrue((new IndustryProgramEnum())->isValid('Market_Research'));
        $this->assertTrue((new IndustryProgramEnum())->isValid('Loyalty_Marketing'));
        $this->assertTrue((new IndustryProgramEnum())->isValid('Rebates'));
    }

    public function testHasValidIndustryValueReturnsFalse()
    {
        $this->assertFalse((new IndustryProgramEnum())->isValid('1.2'));
        $this->assertFalse((new IndustryProgramEnum())->isValid(0));
        $this->assertFalse((new IndustryProgramEnum())->isValid(8)); //test should fail if we add in future
    }

    public function testHasValidIndustryValueReturnsTrue()
    {
        $this->assertTrue((new IndustryProgramEnum())->isValid(1));
        $this->assertTrue((new IndustryProgramEnum())->isValid(2));
        $this->assertTrue((new IndustryProgramEnum())->isValid(3));
        $this->assertTrue((new IndustryProgramEnum())->isValid(4));
        $this->assertTrue((new IndustryProgramEnum())->isValid(5));
        $this->assertTrue((new IndustryProgramEnum())->isValid(6));
        $this->assertTrue((new IndustryProgramEnum())->isValid(7));
    }

    public function testHydrateNameReturnsNull()
    {
        $this->assertSame(null, (new IndustryProgramEnum())->hydrate(8, true)); //adding more constants this will fail eventually
        $this->assertSame(null, (new IndustryProgramEnum())->hydrate('rebate', true));
        $this->assertSame(null, (new IndustryProgramEnum())->hydrate(null, true));
    }

    public function testHydrateNameReturnsNameStringAssertionIsTrue()
    {
        $this->assertSame('Market_Research', (new IndustryProgramEnum())->hydrate(5, true));
        $this->assertSame('Market_Research', (new IndustryProgramEnum())->hydrate('Market_Research', true));
    }

    public function testHydrateReturnsValueAssertionIsTrue()
    {
        $this->assertSame(1, (new IndustryProgramEnum())->hydrate('Health_Wellness'));
        $this->assertSame(2, (new IndustryProgramEnum())->hydrate('Channel_Sales'));
        $this->assertSame(3, (new IndustryProgramEnum())->hydrate('Employee_Recognition'));
        $this->assertSame(4, (new IndustryProgramEnum())->hydrate('Consumer'));
        $this->assertSame(5, (new IndustryProgramEnum())->hydrate('Market_Research'));
        $this->assertSame(6, (new IndustryProgramEnum())->hydrate('Loyalty_Marketing'));
        $this->assertSame(7, (new IndustryProgramEnum())->hydrate('Rebates'));
    }

    public function testGetConstantsReturnsComparedArrayKeysIsTrue()
    {
        $expected = [
            'Health_Wellness',
            'Channel_Sales',
            'Employee_Recognition',
            'Consumer',
            'Market_Research',
            'Loyalty_Marketing',
            'Rebates',
        ];
        $keys = array_keys((new IndustryProgramEnum())->getAvailableIndustries());
        $this->assertSame($expected, $keys);
    }
}

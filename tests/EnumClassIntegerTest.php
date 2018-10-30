<?php

namespace MadWeb\Enum\Test;

class EnumClassIntegerTest extends TestCase
{
    /** @test */
    public function default_value()
    {
        $Enum = new DaysOfWeekEnum();

        $this->assertEquals($Enum->getValue(), DaysOfWeekEnum::__default);
    }

    /** @test */
    public function is()
    {
        $Enum = new DaysOfWeekEnum;

        $this->assertTrue($Enum->is(DaysOfWeekEnum::MONDAY));
    }

    /** @test */
    public function is_by_object()
    {
        $Enum = DaysOfWeekEnum::MONDAY();

        $this->assertTrue($Enum->is(new DaysOfWeekEnum));
    }

    /** @test */
    public function values()
    {
        $this->assertEquals(
            [
                'SUNDAY' => DaysOfWeekEnum::SUNDAY(),
                'MONDAY' => DaysOfWeekEnum::MONDAY(),
                'TUESDAY' => DaysOfWeekEnum::TUESDAY(),
                'WEDNESDAY' => DaysOfWeekEnum::WEDNESDAY(),
                'THURSDAY' => DaysOfWeekEnum::THURSDAY(),
                'FRIDAY' => DaysOfWeekEnum::FRIDAY(),
                'SATURDAY' => DaysOfWeekEnum::SATURDAY(),
            ],
            DaysOfWeekEnum::values()
        );
    }

    /** @test */
    public function keys()
    {
        $this->assertSame(
            [
                'SUNDAY',
                'MONDAY',
                'TUESDAY',
                'WEDNESDAY',
                'THURSDAY',
                'FRIDAY',
                'SATURDAY',
            ],
            DaysOfWeekEnum::keys()
        );
    }

    /** @test */
    public function random_value()
    {
        $value = DaysOfWeekEnum::randomValue();

        $this->assertContains($value, DaysOfWeekEnum::values());
    }

    /** @test */
    public function random_key()
    {
        $value = DaysOfWeekEnum::randomKey();

        $this->assertContains($value, DaysOfWeekEnum::keys());
    }

    /** @test */
    public function get_constants_list()
    {
        $this->assertSame(
            [
                'SUNDAY' => 0,
                'MONDAY' => 1,
                'TUESDAY' => 2,
                'WEDNESDAY' => 3,
                'THURSDAY' => 4,
                'FRIDAY' => 5,
                'SATURDAY' => 6,
            ],
            (new DaysOfWeekEnum)->getConstList()
        );
    }

    /** @test */
    public function get_constants_list_with_default()
    {
        $this->assertSame(
            [
                '__default' => 1,
                'SUNDAY' => 0,
                'MONDAY' => 1,
                'TUESDAY' => 2,
                'WEDNESDAY' => 3,
                'THURSDAY' => 4,
                'FRIDAY' => 5,
                'SATURDAY' => 6,
            ],
            (new DaysOfWeekEnum)->getConstList(true)
        );
    }
}

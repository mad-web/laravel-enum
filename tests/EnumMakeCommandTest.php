<?php

namespace MadWeb\Enum\Test;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class EnumMakeCommandTest extends TestCase
{
    public $mockConsoleOutput = false;

    protected function tearDown(): void
    {
        File::deleteDirectory($this->app->basePath('app/Enums'));
        parent::tearDown();
    }

    /**
     * @test
     * @dataProvider makeCommandDataProvider
     */
    public function make_command($arguments)
    {
        $exitCode = $this->artisan('make:enum', $arguments);

        $this->assertEquals(0, $exitCode);
        $this->assertContains('Enum created successfully', Artisan::output());
        $this->assertFileExists($this->app->basePath("app/Enums/{$arguments['name']}.php"));
        $this->assertFileEquals(
            __DIR__."/fixtures/{$arguments['name']}.php",
            $this->app->basePath("app/Enums/{$arguments['name']}.php")
        );
    }

    public function makeCommandDataProvider()
    {
        return [
            [[
                'name' => 'MyEnumNoArguments',
            ]],
            [[
                'name' => 'MyEnumValuelessArguments',
                'values' => ['SMALL', 'MEDIUM', 'LARGE'],
            ]],
            [[
                'name' => 'MyEnumValuedArguments',
                'values' => ['SMALL=s', 'MEDIUM=m', 'LARGE=l'],
            ]],
            [[
                'name' => 'MyEnumMixedValueValuelessArguments',
                'values' => ['WITH1=with1', 'WITHOUT1', 'WITH2=with2', 'WITHOUT2', 'WITHOUT3', 'WITH3=with3'],
            ]],
        ];
    }
}

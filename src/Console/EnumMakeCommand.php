<?php

namespace MadWeb\Enum\Console;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputArgument;

class EnumMakeCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:enum';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new enum class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Enum';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__.'/stubs/enum.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param string $rootNamespace
     *
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Enums';
    }

    /**
     * Build the class with the given name.
     *
     * @param  string  $name
     * @return string
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    protected function buildClass($name)
    {
        $stub = $this->files->get($this->getStub());

        return $this
          ->replaceDocblock($stub)
          ->replaceConstants($stub)
          ->replaceNamespace($stub, $name)
          ->replaceClass($stub, $name);
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return array_merge(parent::getArguments(), [
            ['values', InputArgument::IS_ARRAY, 'The const maps e.g. ACTIVE=active DELETED=deleted; or FOO BAR BAZ for FOO=0 BAR=1 BAZ=2'],
        ]);
    }

    /**
     * Get the constants for the enum.
     *
     * @return array
     */
    protected function getConstants()
    {
        $inputValues = $this->argument('values');
        if (empty($inputValues)) {
            $inputValues = ['FOO', 'BAR', 'BAZ'];
        }

        $outputValues = [];
        $mapIndex = 0;

        foreach ($inputValues as $inputValue) {
            $parts = explode('=', $inputValue);
            $outputValues[$parts[0]] = ($parts[1] ?? $mapIndex++);
        }

        return $outputValues;
    }

    /**
     * Replace the docblock for the given stub.
     *
     * @param string $stub
     *
     * @return $this
     */
    protected function replaceDocblock(&$stub)
    {
        $docBlock = [];
        foreach ($this->getConstants() as $const => $value) {
            $docBlock[] = " * @method static DummyClass {$const}()";
        }

        $stub = str_replace('DOCBLOCK', implode(PHP_EOL, $docBlock), $stub);

        return $this;
    }

    /**
     * Replace the constants for the given stub.
     *
     * @param string $stub
     *
     * @return $this
     */
    protected function replaceConstants(&$stub)
    {
        $constList = [];
        foreach ($this->getConstants() as $const => $value) {
            $constList[] = is_int($value) ? "    const {$const} = {$value};" : "    const {$const} = '{$value}';";
        }

        $stub = str_replace(['DEFAULTVALUE', 'CONSTLIST'], [array_keys($this->getConstants())[0], implode(PHP_EOL, $constList)], $stub);

        return $this;
    }
}

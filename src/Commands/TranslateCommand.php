<?php
/**
 * Created by Aktaa.
 * User: Mohammad Aktaa
 * Date: 5/6/2018
 * Time: 4:11 AM
 */

namespace Aktaa\translatable\Commands;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class TranslateCommand extends GeneratorCommand
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'make:translate-init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'publish and initialize all files.';

    protected $langs = [];

    protected function getArguments()
    {
        return array(
            ['name', InputArgument::OPTIONAL, 'The Name of translate Model.'],
        );
    }

    protected function getOptions()
    {
        return array(
            ['dir', 'd', InputArgument::OPTIONAL, 'The Dir of translate Model.'],
            ['langs', 'l', InputOption::VALUE_REQUIRED |InputOption::VALUE_OPTIONAL | InputOption::VALUE_IS_ARRAY, 'The langs of translate needed.'],

        );
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__ . '/stubs/Translate.stub';
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getWordStub()
    {
        return __DIR__ . '/stubs/words.stub';
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getModelStub()
    {
        return __DIR__ . '/stubs/Translate.stub';
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getMigrationStub()
    {
        return __DIR__ . '/stubs/translate_table.stub';
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getComposerStub()
    {
        return __DIR__ . '/stubs/TransalteComposer.stub';
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getProviderStub()
    {
        return __DIR__ . '/stubs/provider.stub';
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getHelperStub()
    {
        return __DIR__ . '/stubs/helper.stub';
    }

    /**
     * @return bool|null|void
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function fire()
    {
        $this->langs = $this->option('langs');
        $this->buildWordFile();
        $this->buildModel();
        $this->buildTableMigration();
        $this->buildComposer();
        $this->buildProvider();
        $this->buildHelper();
    }


    /**
     * @return mixed
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    protected function buildWordFile()
    {
        $stub = $this->files->get($this->getWordStub());
        $data = '';
        $langs = explode(',', $this->langs[0]);
        foreach ($langs as $lang) {
            $data = "'text_$lang' => ' ' ";
            $this->replaceArray($stub, 'DUMMY_VALUES', $data);
            $this->files->put(base_path("resources\\lang\\$lang\\") . 'words.php', $stub);
            $this->line('Done create Words File at resources/lang/' . $lang . '/words.php   ');
        }
    }

    /**
     * @return mixed
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    protected function buildModel()
    {
        $stub = $this->files->get($this->getModelStub());
        $data = '';
        $langs = explode(',', $this->langs[0]);
        $dir = $this->option('dir');
        $name = $this->getNameInput() ? $this->getNameInput() : 'Translate';
        $path = base_path("\\App\\$name") . '.php';
        if ($dir != '') {
            if (!is_dir(base_path("\\App\\$dir"))) {
                mkdir(base_path("\\App\\$dir"));
            }
            $path = base_path("\\App\\$dir\\$name") . '.php';
        }
        foreach ($langs as $lang) {
            $data .= "'text_$lang',";
        }
        $data .= "'word'";
        $this->replace($stub, 'DummyFillable', $data);
        $this->replace($stub, 'DummyClass', $name);
        $this->replace($stub, 'DummyNamespace', $this->getNamespaceCustom());
        $this->files->put($path, $stub);
    }

    /**
     * @return mixed
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    protected function buildHelper()
    {
        $stub = $this->files->get($this->getHelperStub());
        $dir = $this->option('dir');
        $name = $this->getNameInput() ? $this->getNameInput() : 'Translate';
        $class = "'App\\$name'";
        $path = base_path("App\\Helper\\Helpers.php");
        if ($dir != '') {
             $class = "'App\\$dir\\$name'";
        }
        $this->replace($stub, 'DUMMYNAME', $class);
        $this->files->put($path, $stub);
    }

    /**
     * @return mixed
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    protected function buildComposer()
    {
        $stub = $this->files->get($this->getComposerStub());
        $dir = $this->option('dir');
        $name = $this->getNameInput() ? $this->getNameInput() : 'Translate';
        $data = "App\\$name";
        if ($dir != '')
            $data = "App\\$dir\\$name";
        if (!is_dir(app_path('Http\ViewComposer'))) {
            mkdir(app_path('Http\ViewComposer'));
        }
        $path = app_path('Http\ViewComposer\TranslateComposer.php');
        $this->replace($stub, 'MODELNAMESPACE', $data);
        $this->replace($stub, 'MODELNAME', $name);
        $this->files->put($path, $stub);
    }

    /**
     * @return mixed
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    protected function buildProvider()
    {
        $stub = $this->files->get($this->getProviderStub());
        if (is_dir(app_path('Http\ViewComposer'))) {
            $data = 'App\Http\ViewComposer';
        } else {
            $data = 'App\Http\ViewComposers';

        }
        $path = app_path('Providers\ComposerServiceProvider.php');
        $this->replace($stub, 'DUMMYCOMPOSER', $data);
        $this->files->put($path, $stub);
    }

    /**
     * @return mixed
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    protected function buildTableMigration()
    {
        $stub = $this->files->get($this->getMigrationStub());
        $data = '';
        $langs = explode(',', $this->langs[0]);
        foreach ($langs as $lang) {
            $data .= '$table->string(\'text_' . $lang . '\')->default(\'0\'); ';
            $data .= "\r\n";
        }
        $date = date('Y_m_d');
        $name = $date . '_124224_create_translates_table.php';
        $this->replace($stub, 'DUMMY_COLUMNS', $data);
        $this->files->put(base_path("\\database\\migrations\\$name"), $stub);
        $this->info('Done Create Migration Table at database/migrations/' . $name);
    }

    public function getNamespaceCustom()
    {
        $namespace = "App";
        $dir = $this->option('dir');
        if ($dir != '')
            $namespace = "App\\$dir";
        return $namespace;

    }

    protected function replaceArray(&$stub, $rep, $name)
    {
        $stub = str_replace(
            [$rep],
            $name,
            $stub
        );
        return $stub;
    }

    protected function replace(&$stub, $rep, $name)
    {
        $stub = str_replace(
            [$rep],
            $name,
            $stub
        );

        return $this;
    }
}

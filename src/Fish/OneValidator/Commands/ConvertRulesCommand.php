<?php
namespace Fish\OneValidator\Commands;


use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Fish\OneValidator\Convert\RulesConverter;
use Fish\OneValidator\JS\RulesSaver;
use Fish\OneValidator\JS\TemplateRenderer;
use Fish\OneValidator\PHP\Extractor\RulesExtractor;
use Fish\OneValidator\PHP\FileFetcher\FileFetcher;
use Fish\OneValidator\Convert\MessagesFetcher;
use Fish\OneValidator\JS\OutputHandler;
use \App;

class ConvertRulesCommand extends MyCommand {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'validator:convert';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Convert laravel validation to JQuery validation.';

    protected $renderer;

    protected $messages;

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct(TemplateRenderer $renderer)
	{
		parent::__construct();
        $this->renderer = $renderer;
        $this->messagesFetcher = new MessagesFetcher(App::getLocale());

	}

	/**
	 * Execute the console command.
	 */
	public function fire()
	{

        $controller = $this->laravelVersion()<5?'controllers/OneValidatorController.php':"Http/Controllers/OneValidator.php";
        if (!file_exists(app_path($controller))):
            $this->error("The validator has not been initalized. Please run 'php artisan validator:init'");
            return false;
        endif;

        $file = preg_replace("/^\//","",$this->argument('file'));
        $filePath =app_path($file);
        $fetcher = new FileFetcher($filePath);
        $file = $fetcher->fetch();

        if (!$file):
            $this->error("File was not found at the specified path");
        return false;
        endif;

        $target = $this->option('target')?app_path($this->option('target')):false;
        $extractor = new RulesExtractor($file);
        $rules = $extractor->extract();

        if (!$rules):
            $this->error("\$rules array was not found in the file");
            return false;
        endif;

        $converter = new RulesConverter($rules);

        $jsRules = $converter->convert();
        $jsMessages = $this->messagesFetcher->fetch();
        $converted = $this->renderer->render($jsRules, $jsMessages);

        if (file_exists($target) &&
            !$this->confirm('The file already exists. Do you wish to overwrite it? [yes|no]')):
            $this->info("Aborted by user");
            return false;
        endif;

        $output = (new OutputHandler($converted, $target))->get();
        $this->info($output);

        return true;

	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return [
			['file', InputArgument::REQUIRED, 'The full path to the validation file relative to the app folder.'],
		];
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return [
			array('target', null, InputOption::VALUE_OPTIONAL, 'The target path for the JS file.', null),
		];
	}

}

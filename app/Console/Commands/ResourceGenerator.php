<?php

namespace App\Console\Commands;

use Doctrine\DBAL\Driver\PDOException;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ResourceGenerator extends Command
{
    protected $signature = 'resource:generator
        {name : Class (singular) for example User}
        {path="" : Path (singular) for example Admin}';
    protected $description = 'Create CRUD operations';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $name = $this->argument('name');
        $path = $this->argument('path');
        $this->route($name, $path);
        $this->controller($name, $path);
        $this->model($name);
        $this->request($name, $path);
        $this->view($name, Str::lower($path));
    }

    protected function controller($name, $path)
    {
        $nameSpace = ($path == '""') ? "" : "\\$path";
        $path = ($path == '""') ? "" : "$path/";
        $controllerTemplate = str_replace([
            '{{modelName}}',
            '{{modelNamePlural}}',
            '{{modelNamePluralLowerCase}}',
            '{{modelNameSingularLowerCase}}',
            '{{modelNameSingularCamelCase}}',
            '{{modelNamePluralCamelCase}}',
            '{{nameSpace}}',
        ], [
            $name,
            Str::plural($name),
            Str::lower(Str::plural($name)),
            Str::lower($name),
            lcfirst($name),
            Str::plural(lcfirst($name)),
            $nameSpace,
        ],
            $this->getStub('Controller', $path)
        );

        try {
            file_put_contents(app_path("/Http/Controllers/{$path}{$name}Controller.php"), $controllerTemplate);
            $this->info("Controller {$name}Controller.php generated");
        } catch (\Exception $exception) {
            $this->error("Error: {$exception->getMessage()} Row: {$exception->getLine()}");
        }
    }

    protected function view(string $name, string $prefix)
    {
        $types = [
            "index",
            "trashed",
            "create",
            "edit",
            "blocks/form",
        ];
        foreach ($types as $type) {
            $template = str_replace([
                '{{modelName}}',
                '{{modelNamePlural}}',
                '{{modelNamePluralLowerCase}}',
                '{{modelNameSingularLowerCase}}',
                '{{modelNameSingularCamelCase}}',
                '{{modelNamePluralCamelCase}}',
            ], [
                $name,
                Str::plural($name),
                strtolower(Str::plural($name)),
                strtolower($name),
                lcfirst($name),
                Str::plural(lcfirst($name)),
            ], file_get_contents(resource_path("stubs/{$prefix}/views/{$type}.stub")));

            try {
                $folder = strtolower(Str::plural($name));

                if (!Storage::disk('resource')->exists($path = "views/{$prefix}/{$folder}")) {
                    Storage::disk('resource')->makeDirectory($path);
                }

                if (!Storage::disk('resource')->exists($path = "views/{$prefix}/{$folder}/blocks")) {
                    Storage::disk('resource')->makeDirectory($path);
                }

                if (Storage::disk('resource')->put("views/{$prefix}/{$folder}/{$type}.blade.php", $template)) {
                    $this->info("View {$prefix}.{$folder}.{$type} generated");
                }
            } catch (\Exception $exception) {
                $this->error("Error: {$exception->getMessage()} Row: {$exception->getLine()}");
            }
        }
    }

    protected function model(string $name)
    {
        try {
            try {
                $table = Str::lower(Str::plural($name));
                Artisan::call("code:models --table={$table}");
            } catch (\Exception $argumentException) {
                Artisan::call("make:model Models/{$name}");
            }
            $this->info("Model {$name} generated");
        } catch (PDOException $PDOException) {
            $this->error("Error: {$PDOException->getMessage()}");
        }
    }

    protected function request(string $name, string $path)
    {
        try {
            Artisan::call("make:request {$path}/{$name}Request");
            $this->info("{$name}Request generated, do you need change authorize method for true or rules access control");
        } catch (\InvalidArgumentException $argumentException) {
            $this->error("Error: {$argumentException->getMessage()} Row: {$argumentException->getLine()}");
        }
    }

    protected function route(string $name, string $prefix)
    {
        $namePlural = strtolower(Str::plural($name));
        preg_match_all("/[A-Z]/", $name, $matche);
        $routeName = $name;
        if (!empty($matche[0])) {
            foreach ($matche[0] as $key => $value) {
                if ($key > 0) {
                    $routeName = str_replace($value, "-{$value}", $routeName);
                }
            }
        }
        $routeName = trim(Str::lower(Str::plural($routeName)), '-');
        $route = "
        // {$name}
        Route::prefix('/{$routeName}')->group(function () {
            Route::get('/', '{$name}Controller@index')->name('{$namePlural}.index');
            Route::get('/trashed', '{$name}Controller@trashed')->name('{$namePlural}.trashed');
            Route::delete('/destroy/{id}', '{$name}Controller@destroy')->name('{$namePlural}.destroy');
            Route::get('/{id}/restore', '{$name}Controller@restore')->name('{$namePlural}.restore');
            Route::delete('/{id}/forceDelete', '{$name}Controller@forceDelete')->name('{$namePlural}.forceDelete');
            Route::match(['post', 'get'], '/{id}/edit', '{$name}Controller@edit')->name('{$namePlural}.edit');
            Route::match(['post', 'get'], '/create', '{$name}Controller@create')->name('{$namePlural}.create');
        });
        ";
        if (file_put_contents(base_path('routes/' . Str::lower($prefix) . '.php'), $route, FILE_APPEND)) {
            $this->info("Routes from {$name} generated, do you need agruped now");
            return;
        }
        $this->error('Error: Route not generated.');
    }

    protected function getStub(string $type, string $path)
    {
        return file_get_contents(resource_path("stubs/" . Str::lower($path) . "/{$type}.stub"));
    }
}

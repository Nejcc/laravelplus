<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

final class AddLocalizationsCommand extends Command
{
    private $example = 'php artisan localization:add company_industries name,description --key=slug --type=json|array';

    protected $signature = 'localization:add {table} {fields} {--key=id} {--type=array}';

    protected $description = 'Add localization support for a database table - ';

    public function handle(): void
    {
        /** @var TYPE_NAME $table */
        $table = $this->argument('table');

        /** @var TYPE_NAME $fields */
        $fields = $this->argument('fields');
        $fields_array = explode(',', $fields);

        /** @var TYPE_NAME $key */
        $key = $this->option('key') ?: 'slug';

        /** @var TYPE_NAME $type */
        $type = $this->option('type') ?: 'array';

        $localization = $this->getLocalization($table, $fields_array, $key);

        $this->preapre($type, $localization, $table);

        $this->info("Localization file for table '{$table}' created successfully.");
    }

    private function getLocalization(bool|array|string|null $table, array $fields_array, bool|array|string $key): array
    {
        $data = DB::table($table)->get();

        $localization = [];
        foreach ($data as $item) {
            foreach ($fields_array as $field) {
                $localization[$field.'.'.$item->{$key}] = $item->{$field};
            }
        }

        return $localization;
    }

    private function preapre(bool|array|string $type, array $localization, bool|array|string|null $table): void
    {
        if ($type === 'array') {
            $output = var_export($localization, true);
        } else {
            $output = json_encode($localization, JSON_PRETTY_PRINT);
        }

        $filename = mb_strtolower($table).'.json';
        $path = base_path('lang/'.app()->getLocale().'/'.$filename);
        file_put_contents($path, $output);
    }
}

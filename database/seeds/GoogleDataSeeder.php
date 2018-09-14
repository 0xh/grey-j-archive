<?php

use Illuminate\Database\Seeder;

class GoogleDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Does the google_data.json file exist?
        if (file_exists('google_data/google_data.json')) {
            $json_data = json_decode(file_get_contents('google_data/google_data.json'));
            foreach ($json_data as $model => $rows) {
                $model_class = 'App\\'.$model;
                if (!class_exists($model_class)) throw new \RuntimeException('unknown model class '.$model_class);
                foreach ($rows as $row) {
                    $record = new $model_class((array) $row);
                    $record->save();
                    unset($record);
                }
            }
        } else {
            throw new \RuntimeException('google_data/google_data.json not found');
        }
    }
}

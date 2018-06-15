<?php

use Illuminate\Database\Seeder;

class FornecedoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Fornecedor::class, 50)->create();
    }
}

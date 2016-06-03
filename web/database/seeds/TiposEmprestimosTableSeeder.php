<?php

use Illuminate\Database\Seeder;

class TiposEmprestimosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $emprestimos = [
            ['nome' => 'Dinheiro'],
            ['nome' => 'Livro'],
            ['nome' => 'Roupa'],
            ['nome' => 'Panela'],
            ['nome' => 'Jogo']
        ];

        DB::table('tipos_emprestimos')->insert($emprestimos);

    }
}

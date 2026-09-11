<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categorias = [
            // Receitas (3)
            ['nome' => 'Salário', 'tipo' => 'receita', 'icone' => 'wallet', 'user_id' => null, 'eh_personalizada' => false, 'esta_oculta' => false],
            ['nome' => 'Investimentos', 'tipo' => 'receita', 'icone' => 'trending-up', 'user_id' => null, 'eh_personalizada' => false, 'esta_oculta' => false],
            ['nome' => 'Outras Receitas', 'tipo' => 'receita', 'icone' => 'dollar-sign', 'user_id' => null, 'eh_personalizada' => false, 'esta_oculta' => false],

            // Despesas (13)
            ['nome' => 'Alimentação', 'tipo' => 'despesa', 'icone' => 'utensils', 'user_id' => null, 'eh_personalizada' => false, 'esta_oculta' => false],
            ['nome' => 'Moradia', 'tipo' => 'despesa', 'icone' => 'home', 'user_id' => null, 'eh_personalizada' => false, 'esta_oculta' => false],
            ['nome' => 'Transporte', 'tipo' => 'despesa', 'icone' => 'car', 'user_id' => null, 'eh_personalizada' => false, 'esta_oculta' => false],
            ['nome' => 'Saúde', 'tipo' => 'despesa', 'icone' => 'heart', 'user_id' => null, 'eh_personalizada' => false, 'esta_oculta' => false],
            ['nome' => 'Educação', 'tipo' => 'despesa', 'icone' => 'book', 'user_id' => null, 'eh_personalizada' => false, 'esta_oculta' => false],
            ['nome' => 'Lazer', 'tipo' => 'despesa', 'icone' => 'smile', 'user_id' => null, 'eh_personalizada' => false, 'esta_oculta' => false],
            ['nome' => 'Vestuário', 'tipo' => 'despesa', 'icone' => 'shopping-bag', 'user_id' => null, 'eh_personalizada' => false, 'esta_oculta' => false],
            ['nome' => 'Cuidados Pessoais', 'tipo' => 'despesa', 'icone' => 'user', 'user_id' => null, 'eh_personalizada' => false, 'esta_oculta' => false],
            ['nome' => 'Assinaturas e Serviços', 'tipo' => 'despesa', 'icone' => 'tv', 'user_id' => null, 'eh_personalizada' => false, 'esta_oculta' => false],
            ['nome' => 'Pets', 'tipo' => 'despesa', 'icone' => 'dog', 'user_id' => null, 'eh_personalizada' => false, 'esta_oculta' => false],
            ['nome' => 'Presentes e Doações', 'tipo' => 'despesa', 'icone' => 'gift', 'user_id' => null, 'eh_personalizada' => false, 'esta_oculta' => false],
            ['nome' => 'Impostos e Taxas', 'tipo' => 'despesa', 'icone' => 'file-text', 'user_id' => null, 'eh_personalizada' => false, 'esta_oculta' => false],
            ['nome' => 'Outras Despesas', 'tipo' => 'despesa', 'icone' => 'more-horizontal', 'user_id' => null, 'eh_personalizada' => false, 'esta_oculta' => false],
        ];

        DB::table('categorias')->insert($categorias);
    }
}
<?php

use Illuminate\Database\Seeder;

class RestsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('rests')->delete();
        
        \DB::table('rests')->insert(array (
            0 => 
            array (
                'id' => 1,
                'id_user' => 1,
                'name' => 'Sabor Família',
                'url' => 'sabor-familia',
                'desc' => 'De Terça à sábado, das 10:00 às 16:00',
                'end' => 'R. Sei lá, 00 - Vila Onde - SP',
                'horFunc' => '09:00 às 16:00',
            'tel' => '(11) 2222-2222',
                'color' => '#c0392b',
                'logo_path' => 'https://static.vecteezy.com/ti/vetor-gratis/p3/274987-rotulo-de-restaurante-logotipo-de-servico-de-comida-gr%C3%A1tis-vetor.jpg',
                'status' => 'on',
                'remember_token' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}
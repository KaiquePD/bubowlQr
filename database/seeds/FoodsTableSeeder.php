<?php



use Illuminate\Database\Seeder;

class FoodsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('foods')->delete();
        
        \DB::table('foods')->insert(array (
            0 => 
            array (
                'id' => 1,
                'id_segment' => 1,
                'name' => 'Veg Burguer',
                'desc' => 'Pão brioche, hamburguer de alho poró, queijo veg mussarela e alface.',
                'price' => 22.0,
                'status' => 'on',
                'remember_token' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 3,
                'id_segment' => 1,
                'name' => 'Soja Burguer',
                'desc' => 'Pão brioche, hamburguer de soja, queijo veg mussarela e cebola caramelizada.',
                'price' => 19.0,
                'status' => 'on',
                'remember_token' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}
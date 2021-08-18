<?php



use Illuminate\Database\Seeder;

class SegmentsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('segments')->delete();
        
        \DB::table('segments')->insert(array (
            0 => 
            array (
                'id' => 1,
                'id_rest' => 1,
                'name' => 'Lanches',
                'desc' => '',
                'status' => 'on',
                'remember_token' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}
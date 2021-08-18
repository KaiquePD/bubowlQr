<?php



use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'emerson',
                'email' => 'emersong21.12@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$cIFingGgOMsZn9C9obCJz.QMgKTlHZWshinbP7J.f3a5ldEvA6LJK',
                'remember_token' => NULL,
                'created_at' => '2021-08-17 21:33:12',
                'updated_at' => '2021-08-17 21:33:12',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Emerson G R Gomes',
                'email' => 'admin@admin',
                'email_verified_at' => NULL,
                'password' => '$2y$10$fVYaZ6bCPlR8huR2qrZW0eBQuQ2Tz2brEosxe5RzGVZ7O.NFSTZOW',
                'remember_token' => NULL,
                'created_at' => '2021-08-18 00:25:01',
                'updated_at' => '2021-08-18 00:25:01',
            ),
        ));
        
        
    }
}
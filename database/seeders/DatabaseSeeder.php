<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $firstname=["Bob","Joe","Nancy","Keith","Kelly","Frank"];
        $lastname=["Smith","Jarrot","Soley","Widjaja","Smalls","Nguyen"];
        $hiredate=["2009-06-20","2010-02-12","2012-03-14","2013-09-10","2013-04-10","2015-04-10"];
        $terminatedate=["2016-01-01",NUll,NULL,"2014-01-01",NULL,"2015-05-01"];
        $salary=[10000,20000,30000,20000,20000,60000];

        for($i = 0; $i < count($firstname); $i++){
 
            // insert data ke table pegawai menggunakan Faker
          DB::table('employee')->insert([
              'firstname' => $firstname[$i],
              'lastname' => $lastname[$i],
              'hiredate' => $hiredate[$i],
              'terminationdate' => $terminatedate[$i],
              "salary"=>$salary[$i]
          ]);

      }
    }
}

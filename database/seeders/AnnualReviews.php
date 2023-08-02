<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AnnualReviews extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $empid=[1,2,10,22,11,12,13,1,1];
        $reviewdate=["2016-01-01","2016-04-12","2015-02-13","2010-10-12","2009-01-01","2009-03-03","2008-12-01","2003-04-12","2014-04-30"];

        for($i = 0; $i < count($empid); $i++){
 
            // insert data ke table pegawai menggunakan Faker
          DB::table('annualreviews')->insert([
              'empid' => $empid[$i],
              'reviewDate' => $reviewdate[$i]
          ]);
        }
    }
}

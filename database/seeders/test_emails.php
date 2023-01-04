<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\testEmails;

class test_emails extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $email = 'gursharan@vsrkcapital.com';
        for($i=0;$i<5000;$i++){
            if($i > 1000 && $i <=1999 ){
                $email = 'gursharan.dfr@gmail.com';
            }
            elseif($i > 2000 && $i <=2999){
                $email = 'gs06.calligraphyindia@gmail.com';
            }
            elseif($i > 3000 && $i <=3999){
                $email = 'gursharan.smartdesignhut@gmail.com';
            }
            elseif($i > 4000){
                $email = 'gs01.calligraphyindia@gmail.com';
            }
            testEmails::create([
                'email' => $email,
                'status' => '-'
            ]);
        }
    }
}

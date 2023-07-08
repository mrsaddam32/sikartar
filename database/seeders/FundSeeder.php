<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Fund;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FundSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create(env('FAKER_LOCALE', 'en_US'));
        $totalPemasukkan = 0;

        for ($i = 0; $i < 30; $i++) {
            $sumberDana = 'Dana Operasional Bulanan';
            $jumlahNominal = 500000;
            $tanggalPemasukkan =  Carbon::create(2023, $faker->numberBetween(1, 12), $faker->numberBetween(1, 28));

            Fund::create([
                'sumber_dana' => $sumberDana,
                'jumlah_nominal' => $jumlahNominal,
                'tanggal_pemasukkan' => $tanggalPemasukkan,
                'total_pemasukkan' => $totalPemasukkan += $jumlahNominal,
            ]);
        }
    }
}

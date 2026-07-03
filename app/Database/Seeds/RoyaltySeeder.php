<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\RoyaltyModel;

class RoyaltySeeder extends Seeder
{
    public function run()
    {
        $royaltyModel = new RoyaltyModel();

        $samples = [
            [
                'song_title'    => "Wonderwall",
                'musician_name' => "Oasis",
                'income_source' => "Platform Streaming Digital",
                'plays_count'   => 25000,
                'total_royalty' => 25000 * 150,
            ],
            [
                'song_title'    => "Don't Look Back in Anger",
                'musician_name' => "Oasis",
                'income_source' => "Konser Musik Komersial",
                'plays_count'   => 18500,
                'total_royalty' => 18500 * 150, 
            ],
            [
                'song_title'    => "Live Forever",
                'musician_name' => "Oasis",
                'income_source' => "Radio & Televisi Penyiaran",
                'plays_count'   => 12000,
                'total_royalty' => 12000 * 150, 
            ],
            [
                'song_title'    => "Champagne Supernova",
                'musician_name' => "Oasis",
                'income_source' => "Tempat Karaoke Keluarga",
                'plays_count'   => 9500,
                'total_royalty' => 9500 * 150, 
            ]
        ];

        foreach ($samples as $sample) {
            $royaltyModel->insert($sample);
        }
    }
}
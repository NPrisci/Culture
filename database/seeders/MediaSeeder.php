<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Media;

class MediaSeeder extends Seeder
{
    public function run(): void
    {
        $medias = [
            [
                'chemin' => 'medias/images/culture_fon.jpg',
                'description' => 'Image illustrant la culture Fon',
                'id_contenu' => 1,
                'id_type_media' => 1, // Image
            ],
            [
                'chemin' => 'medias/videos/festival_ouidah.mp4',
                'description' => 'Vidéo du festival culturel de Ouidah',
                'id_contenu' => 2,
                'id_type_media' => 2, // Vidéo
            ],
            [
                'chemin' => 'medias/audios/conte_bariba.mp3',
                'description' => 'Conte traditionnel Bariba',
                'id_contenu' => 3,
                'id_type_media' => 3, // Audio
            ],
            [
                'chemin' => 'medias/images/danse_adja.jpg',
                'description' => 'Danse traditionnelle Adja',
                'id_contenu' => 4,
                'id_type_media' => 1, // Image
            ],
            [
                'chemin' => 'medias/videos/ceremonie_yoruba.mp4',
                'description' => 'Cérémonie traditionnelle Yoruba',
                'id_contenu' => 5,
                'id_type_media' => 2, // Vidéo
            ],
        ];

        foreach ($medias as $media) {
            Media::create($media);
        }
    }
}

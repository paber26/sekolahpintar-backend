<?php

namespace Database\Seeders;

use App\Models\Central\Kurikulum;
use App\Models\Central\Materi;
use App\Models\Central\Soal;
use Illuminate\Database\Seeder;

class MasterDataSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Kurikulum
        $kurikulumNasional = Kurikulum::firstOrCreate(
            ['nama' => 'Kurikulum Merdeka'],
            ['tahun' => '2022', 'is_active' => true]
        );

        $kurikulumCambridge = Kurikulum::firstOrCreate(
            ['nama' => 'Cambridge IGCSE'],
            ['tahun' => '2023', 'is_active' => true]
        );

        // 2. Materi
        $materiBiologi = Materi::firstOrCreate(
            ['judul' => 'Sistem Reproduksi Manusia'],
            [
                'kurikulum_id' => $kurikulumNasional->id,
                'mata_pelajaran' => 'Biologi',
                'tingkat' => '11',
                'semester' => '1',
                'tipe' => 'video',
                'deskripsi' => 'Materi tentang sistem reproduksi manusia.',
                'video_url' => 'https://example.com/video-reproduksi.mp4',
            ]
        );

        $materiFisika = Materi::firstOrCreate(
            ['judul' => 'Hukum Newton I, II, dan III'],
            [
                'kurikulum_id' => $kurikulumNasional->id,
                'mata_pelajaran' => 'Fisika',
                'tingkat' => '10',
                'semester' => '2',
                'tipe' => 'pdf',
                'deskripsi' => 'Pengenalan hukum newton.',
                'file_path' => 'uploads/hukum-newton.pdf',
            ]
        );

        $materiMath = Materi::firstOrCreate(
            ['judul' => 'Algebraic Expressions'],
            [
                'kurikulum_id' => $kurikulumCambridge->id,
                'mata_pelajaran' => 'Mathematics',
                'tingkat' => '9',
                'semester' => '1',
                'tipe' => 'teks',
                'konten' => 'An algebraic expression is a mathematical phrase that can contain ordinary numbers, variables (like x or y), and operators.',
            ]
        );

        // 3. Soal
        Soal::firstOrCreate(
            ['pertanyaan' => 'Hukum Newton yang menyatakan aksi = reaksi adalah?'],
            [
                'materi_id' => $materiFisika->id,
                'pilihan_a' => 'Hukum Newton I',
                'pilihan_b' => 'Hukum Newton II',
                'pilihan_c' => 'Hukum Newton III',
                'pilihan_d' => 'Hukum Hooke',
                'jawaban_benar' => 'C',
                'pembahasan' => 'Aksi = Reaksi adalah bunyi hukum newton ke-3.',
                'bobot' => 1
            ]
        );

        Soal::firstOrCreate(
            ['pertanyaan' => 'Simplify the expression: 3x + 4y - x + 2y'],
            [
                'materi_id' => $materiMath->id,
                'pilihan_a' => '2x + 6y',
                'pilihan_b' => '4x + 6y',
                'pilihan_c' => '2x + 2y',
                'pilihan_d' => '4x + 2y',
                'jawaban_benar' => 'A',
                'pembahasan' => '(3x - x) + (4y + 2y) = 2x + 6y',
                'bobot' => 2
            ]
        );
    }
}

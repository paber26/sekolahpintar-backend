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
        // 1. Kurikulum (Sudah ada, atau buat baru)
        $kurikulumNasional = Kurikulum::firstOrCreate(
            ['nama' => 'Kurikulum Merdeka'],
            ['tahun' => '2024', 'is_active' => true]
        );

        // 2. Mata Pelajaran
        $matematika = \App\Models\Central\MataPelajaran::firstOrCreate(
            ['nama' => 'Matematika'],
            ['tingkat' => 'SMA', 'kurikulum_id' => $kurikulumNasional->id, 'is_active' => true]
        );

        // 3. Bab
        $babBangunDatar = \App\Models\Central\Bab::firstOrCreate(
            ['mata_pelajaran_id' => $matematika->id, 'judul' => 'Bangun Datar'],
            ['urutan' => 1, 'deskripsi' => 'Mempelajari berbagai macam bangun datar dua dimensi.', 'is_active' => true]
        );

        $babGarisSudut = \App\Models\Central\Bab::firstOrCreate(
            ['mata_pelajaran_id' => $matematika->id, 'judul' => 'Garis dan Sudut'],
            ['urutan' => 2, 'deskripsi' => 'Mempelajari hubungan antar garis dan sudut.', 'is_active' => true]
        );

        // 4. Sub Bab untuk Bangun Datar
        $subBabs = [
            'Persegi',
            'Persegi Panjang',
            'Layang layang',
            'Belah Ketupat',
            'Jajar Genjang',
            'Trapesium',
            'Lingkaran',
            'Segitiga',
            'Segi Empat',
            'Segi Lima',
        ];

        foreach ($subBabs as $index => $judul) {
            $subBab = \App\Models\Central\SubBab::firstOrCreate(
                ['bab_id' => $babBangunDatar->id, 'judul' => $judul],
                ['urutan' => $index + 1, 'is_active' => true]
            );

            // 5. Konten Belajar (Beri contoh konten untuk Persegi)
            if ($judul === 'Persegi') {
                \App\Models\Central\Konten::firstOrCreate(
                    ['sub_bab_id' => $subBab->id, 'judul' => 'Video Penjelasan Persegi'],
                    ['tipe' => 'video', 'url_file' => 'https://www.youtube.com/watch?v=12345', 'durasi_menit' => 15, 'urutan' => 1]
                );

                \App\Models\Central\Konten::firstOrCreate(
                    ['sub_bab_id' => $subBab->id, 'judul' => 'Sifat-sifat Persegi'],
                    ['tipe' => 'teks', 'isi_konten' => 'Persegi adalah bangun datar yang memiliki 4 sisi sama panjang dan 4 sudut siku-siku.', 'urutan' => 2]
                );

                $kuis = \App\Models\Central\Konten::firstOrCreate(
                    ['sub_bab_id' => $subBab->id, 'judul' => 'Kuis Latihan Persegi'],
                    ['tipe' => 'kuis', 'urutan' => 3]
                );

                // 6. Soal Kuis
                \App\Models\Central\Soal::firstOrCreate(
                    ['konten_id' => $kuis->id, 'pertanyaan' => 'Berapakah jumlah titik sudut pada persegi?'],
                    [
                        'pilihan_a' => '2',
                        'pilihan_b' => '3',
                        'pilihan_c' => '4',
                        'pilihan_d' => '5',
                        'jawaban_benar' => 'C',
                        'bobot' => 10,
                    ]
                );
            }
        }
    }
}

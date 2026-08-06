<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Article;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Seed Users (Admin, Editor, Penulis)
        $admin = User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name'     => 'Administrator Portal',
                'password' => Hash::make('password'),
                'role'     => 'admin',
            ]
        );

        $editor = User::firstOrCreate(
            ['email' => 'editor@gmail.com'],
            [
                'name'     => 'Redaktur Berita',
                'password' => Hash::make('password'),
                'role'     => 'editor',
            ]
        );

        $penulis = User::firstOrCreate(
            ['email' => 'penulis@gmail.com'],
            [
                'name'     => 'Jurnalis Utama',
                'password' => Hash::make('password'),
                'role'     => 'penulis',
            ]
        );

        // 2. Seed Categories
        $categoriesData = [
            'Teknologi' => Category::firstOrCreate(['category_name' => 'Teknologi']),
            'Politik'   => Category::firstOrCreate(['category_name' => 'Politik']),
            'Olahraga'  => Category::firstOrCreate(['category_name' => 'Olahraga']),
            'Hiburan'   => Category::firstOrCreate(['category_name' => 'Hiburan']),
            'Edukasi'   => Category::firstOrCreate(['category_name' => 'Edukasi']),
            'Kesehatan' => Category::firstOrCreate(['category_name' => 'Kesehatan']),
        ];

        // 3. Seed Sample Articles if none exist
        if (Article::count() === 0) {
            $dummyArticles = [
                [
                    'title'       => 'Perkembangan Kecerdasan Buatan (AI) Mengubah Lanskap Industri Global',
                    'content'     => 'Teknologi Kecerdasan Buatan (Artificial Intelligence) terus berkembang pesat dan mulai diterapkan di berbagai sektor seperti kesehatan, keuangan, hingga pendidikan. Banyak perusahaan global yang mengadopsi AI untuk efisiensi operasional dan meningkatkan pengalaman pengguna.',
                    'status'      => 'published',
                    'category_id' => $categoriesData['Teknologi']->id,
                    'user_id'     => $admin->id,
                ],
                [
                    'title'       => 'Timnas Indonesia Siap Menghadapi Laga Kualifikasi Piala Dunia',
                    'content'     => 'Tim Nasional Indonesia terus mematangkan persiapan menjelang pertandingan krusial dalam Kualifikasi Piala Dunia. Pelatih menyatakan bahwa kondisi fisik dan mental para pemain saat ini dalam performa puncak untuk meraih poin penuh.',
                    'status'      => 'published',
                    'category_id' => $categoriesData['Olahraga']->id,
                    'user_id'     => $penulis->id,
                ],
                [
                    'title'       => 'DPR Sahkan Rancangan Undang-Undang Terbaru untuk Kesejahteraan Masyarakat',
                    'content'     => 'Rapat Paripurna DPR RI secara resmi mengesahkan Rancangan Undang-Undang (RUU) terbaru yang berfokus pada penguatan perlindungan sosial dan peningkatan fasilitas publik di daerah terpencil.',
                    'status'      => 'published',
                    'category_id' => $categoriesData['Politik']->id,
                    'user_id'     => $editor->id,
                ],
                [
                    'title'       => 'Konser Musik Internasional Sukses Mengguncang Jakarta Akhir Pekan Ini',
                    'content'     => 'Ribuan penonton memadati arena konser musik internasional di Jakarta. Acara yang menampilkan musisi papan atas dunia tersebut berlangsung meriah dengan tata panggung dan pencahayaan yang spektakuler.',
                    'status'      => 'published',
                    'category_id' => $categoriesData['Hiburan']->id,
                    'user_id'     => $penulis->id,
                ],
                [
                    'title'       => 'Pentingnya Menjaga Pola Makan Seimbang dan Olahraga Rutin',
                    'content'     => 'Pola hidup sehat sangat penting untuk menjaga daya tahan tubuh di musim pancaroba. Para ahli kesehatan merekomendasikan konsumsi makanan bergizi seimbang, cukup minum air putih, dan berolahraga minimal 30 menit sehari.',
                    'status'      => 'published',
                    'category_id' => $categoriesData['Kesehatan']->id,
                    'user_id'     => $editor->id,
                ],
                [
                    'title'       => 'Inovasi Pembelajaran Digital Tingkatkan Kualitas Pendidikan di Daerah',
                    'content'     => 'Penerapan metode pembelajaran berbasis digital mulai meluas ke sekolah-sekolah di daerah. Dengan akses internet dan perangkat teknologi yang memadai, para siswa kini dapat belajar secara interaktif.',
                    'status'      => 'published',
                    'category_id' => $categoriesData['Edukasi']->id,
                    'user_id'     => $admin->id,
                ],
            ];

            foreach ($dummyArticles as $art) {
                Article::create($art);
            }
        }
    }
}

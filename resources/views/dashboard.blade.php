<x-app-layout>

<div style="background:#f5f3ed;padding:30px;min-height:100vh;">

    <h1 style="font-size:36px;font-weight:bold;margin-bottom:25px;">
        Dashboard Admin
    </h1>

    <!-- CARD STATISTIK -->
    <div style="
        display:grid;
        grid-template-columns:repeat(4,1fr);
        gap:20px;
        margin-bottom:30px;
    ">

        <div style="background:white;padding:25px;border-radius:12px;box-shadow:0 2px 8px rgba(0,0,0,.08);">

            <div style="color:#666;">
                📰 Total Berita
            </div>

            <h1 style="font-size:42px;font-weight:bold;color:#0B3766;">
                {{ $totalBerita }}
            </h1>

            <small style="color:green;">
                Seluruh artikel
            </small>

        </div>

        <div style="background:white;padding:25px;border-radius:12px;box-shadow:0 2px 8px rgba(0,0,0,.08);">

            <div style="color:#666;">
                ✅ Published
            </div>

            <h1 style="font-size:42px;font-weight:bold;color:green;">
                {{ $totalPublished }}
            </h1>

            <small>
                Artikel yang sudah dipublish
            </small>

        </div>

        <div style="background:white;padding:25px;border-radius:12px;box-shadow:0 2px 8px rgba(0,0,0,.08);">

            <div style="color:#666;">
                📂 Total Kategori
            </div>

            <h1 style="font-size:42px;font-weight:bold;color:#0B3766;">
                {{ $totalKategori }}
            </h1>

            <small>
                Kategori tersedia
            </small>

        </div>

        <div style="background:white;padding:25px;border-radius:12px;box-shadow:0 2px 8px rgba(0,0,0,.08);">

            <div style="color:#666;">
                👤 Total Pengguna
            </div>

            <h1 style="font-size:42px;font-weight:bold;color:#0B3766;">
                {{ $totalUser }}
            </h1>

            <small>
                Admin terdaftar
            </small>

        </div>

    </div>

    <!-- BERITA TERBARU + RINGKASAN -->

    <div style="
        display:grid;
        grid-template-columns:2fr 1fr;
        gap:20px;
    ">

        <div style="
            background:white;
            padding:25px;
            border-radius:12px;
            box-shadow:0 2px 8px rgba(0,0,0,.08);
        ">

            <h2 style="font-size:26px;margin-bottom:20px;">
                📰 Berita Terbaru
            </h2>

            <table width="100%" cellpadding="10" style="border-collapse:collapse;">

                <tr style="background:#f4f4f4;">

                    <th align="left">
                        Judul
                    </th>

                    <th>
                        Status
                    </th>

                </tr>

                @foreach($latestArticles as $article)

                <tr style="border-bottom:1px solid #eee;">

                    <td>

                        {{ $article->title }}

                    </td>

                    <td>

                        @if($article->status=='published')

                            <span style="
                                background:#d1fae5;
                                color:#065f46;
                                padding:6px 12px;
                                border-radius:20px;
                                font-size:13px;
                            ">

                                Published

                            </span>

                        @else

                            <span style="
                                background:#fef3c7;
                                color:#92400e;
                                padding:6px 12px;
                                border-radius:20px;
                                font-size:13px;
                            ">

                                Draft

                            </span>

                        @endif

                    </td>

                </tr>

                @endforeach

            </table>

        </div>
                <div style="
            background:white;
            padding:25px;
            border-radius:12px;
            box-shadow:0 2px 8px rgba(0,0,0,.08);
        ">

            <h2 style="font-size:26px;margin-bottom:20px;">
                📊 Ringkasan Sistem
            </h2>

            <div style="margin-bottom:18px;">
                <b>Total Berita :</b> {{ $totalBerita }}
            </div>

            <div style="margin-bottom:18px;">
                <b>Published :</b> {{ $totalPublished }}
            </div>

            <div style="margin-bottom:18px;">
                <b>Draft :</b> {{ $totalDraft }}
            </div>

            <div style="margin-bottom:18px;">
                <b>Total Kategori :</b> {{ $totalKategori }}
            </div>

            <div>
                <b>Total Pengguna :</b> {{ $totalUser }}
            </div>

        </div>

    </div>

    <!-- GRAFIK -->

    <div style="
        margin-top:25px;
        background:white;
        padding:25px;
        border-radius:12px;
        box-shadow:0 2px 8px rgba(0,0,0,.08);
    ">

        <h2 style="
            font-size:26px;
            margin-bottom:20px;
        ">
            📈 Statistik Artikel
        </h2>

        <canvas id="articleChart" height="90"></canvas>

    </div>

    <!-- ALERT -->

    <div style="
        margin-top:25px;
        background:#fff7d6;
        border-left:6px solid orange;
        padding:20px;
        border-radius:10px;
        display:flex;
        justify-content:space-between;
        align-items:center;
    ">

        <div>

            Saat ini terdapat

            <b>{{ $totalDraft }}</b>

            artikel yang masih berstatus Draft.

        </div>

        <a
            href="{{ route('articles.list') }}"
            style="
                background:#0B3766;
                color:white;
                text-decoration:none;
                padding:12px 20px;
                border-radius:8px;
            "
        >

            Kelola Berita

        </a>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

const ctx = document.getElementById('articleChart');

new Chart(ctx, {

    type: 'bar',

    data: {

        labels: @json($chartLabels),

        datasets: [{

            label: 'Jumlah Artikel',

            data: @json($chartData),

            backgroundColor: [

                '#16a34a',

                '#f59e0b'

            ],

            borderRadius:8

        }]

    },

    options: {

        responsive:true,

        plugins:{

            legend:{
                display:false
            }

        },

        scales:{

            y:{

                beginAtZero:true,

                ticks:{
                    stepSize:1
                }

            }

        }

    }

});

</script>

</x-app-layout>
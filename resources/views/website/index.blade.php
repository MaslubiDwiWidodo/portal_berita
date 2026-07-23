<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Portal Berita</title>

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:Arial, Helvetica, sans-serif;
        }

        body{
            background:#f4f6f9;
        }

        a{
            text-decoration:none;
        }

        /* ================= NAVBAR ================= */

        .navbar{

            background:#0B3766;

            color:white;

            display:flex;

            justify-content:space-between;

            align-items:center;

            padding:18px 60px;

        }

        .logo{

            font-size:30px;

            font-weight:bold;

        }

        .menu{

            display:flex;

            gap:25px;

            align-items:center;

        }

        .menu a{

            color:white;

            font-weight:bold;

        }

        .login{

            background:white;

            color:#0B3766 !important;

            padding:10px 18px;

            border-radius:8px;

        }

        /* ================= CONTAINER ================= */

        .container{

            width:90%;

            margin:35px auto;

        }

        /* ================= HERO ================= */

        .hero{

            display:grid;

            grid-template-columns:2fr 1fr;

            gap:30px;

            margin-bottom:45px;

        }

        .hero-card{

            background:white;

            border-radius:14px;

            overflow:hidden;

            box-shadow:0 5px 15px rgba(0,0,0,.08);

        }

        .hero-card img{

            width:100%;

            height:420px;

            object-fit:cover;

        }

        .hero-content{

            padding:30px;

        }

        .badge{

            display:inline-block;

            background:#0B3766;

            color:white;

            padding:6px 14px;

            border-radius:20px;

            font-size:13px;

            margin-bottom:15px;

        }

        .hero-title{

            font-size:36px;

            line-height:1.5;

            margin-bottom:20px;

        }

        .hero-desc{

            color:#666;

            line-height:1.8;

            margin-bottom:25px;

        }

        .btn{

            background:#0B3766;

            color:white;

            padding:12px 22px;

            border-radius:8px;

            display:inline-block;

        }

        /* ================= SIDEBAR ================= */

        .sidebar{

            background:white;

            padding:25px;

            border-radius:14px;

            box-shadow:0 5px 15px rgba(0,0,0,.08);

        }

        .sidebar h2{

            margin-bottom:20px;

            color:#0B3766;

        }

        .trending{

            padding:15px 0;

            border-bottom:1px solid #e5e7eb;

        }

        .trending:last-child{

            border:none;

        }

        .trending a{

            color:black;

            font-weight:bold;

            line-height:1.6;

        }

        .section-title{

            font-size:30px;

            color:#0B3766;

            margin-bottom:25px;

        }

        .cards{

            display:grid;

            grid-template-columns:repeat(auto-fill,minmax(320px,1fr));

            gap:25px;

        }

        .card{

            background:white;

            border-radius:14px;

            overflow:hidden;

            box-shadow:0 5px 15px rgba(0,0,0,.08);

            transition:.3s;

        }

        .card:hover{

            transform:translateY(-5px);

        }

        .card img{

            width:100%;

            height:220px;

            object-fit:cover;

        }

        .card-body{

            padding:20px;

        }

        .card-body h3{

            margin:15px 0;

            line-height:1.5;

        }

        .card-body p{

            color:#666;

            line-height:1.7;

        }

        footer{

            margin-top:60px;

            background:#0B3766;

            color:white;

            text-align:center;

            padding:35px;

        }

    </style>

</head>

<body>

<div class="navbar">

    <div class="logo">

        Portal Berita

    </div>

    <div class="menu">

        <a href="/">Home</a>

        <a href="/login" class="login">

            Login Admin

        </a>

    </div>

</div>

<div class="container">
<form method="GET" action="{{ route('website') }}" style="
display:flex;
justify-content:center;
align-items:center;
gap:10px;
margin-bottom:35px;
flex-wrap:wrap;
">

<input
type="text"
name="search"
placeholder="Cari berita..."
value="{{ $search }}"
style="
width:320px;
padding:14px;
border:1px solid #ddd;
border-radius:8px;
font-size:15px;
">

<select
name="category"
style="
padding:14px;
border:1px solid #ddd;
border-radius:8px;
font-size:15px;
">

<option value="">Semua Kategori</option>

@foreach($categories as $cat)

<option
value="{{ $cat->id }}"
{{ $category == $cat->id ? 'selected' : '' }}>

{{ $cat->category_name }}

</option>

@endforeach

</select>

<button
type="submit"
style="
background:#0B3766;
color:white;
border:none;
padding:14px 24px;
border-radius:8px;
cursor:pointer;
">

Cari

</button>

</form>

@if($articles->count())

@php

$headline = $articles->first();

@endphp

<!-- ================= HERO ================= -->

<div class="hero">

    <div class="hero-card">

        @if($headline->image)

            <img src="{{ asset('storage/'.$headline->image) }}" alt="">

        @else

            <img src="https://via.placeholder.com/900x420?text=Portal+Berita" alt="">

        @endif

        <div class="hero-content">

            <span class="badge">

                {{ $headline->category->category_name }}

            </span>

            <h1 class="hero-title">

                {{ $headline->title }}

            </h1>

            <p class="hero-desc">

                {{ \Illuminate\Support\Str::limit($headline->content,250) }}

            </p>

            <a
                href="{{ route('berita.show',$headline->id) }}"
                class="btn">

                Baca Selengkapnya →

            </a>

        </div>

    </div>

    <!-- ================= SIDEBAR ================= -->

    <div class="sidebar">

        <h2>🔥 Berita Terbaru</h2>

        @foreach($articles->take(5) as $news)

            <div class="trending">

                <a href="{{ route('berita.show',$news->id) }}">

                    {{ $news->title }}

                </a>

                <br><br>

                <small style="color:gray;">

                    {{ $news->category->category_name }}

                </small>

            </div>

        @endforeach

    </div>

</div>

<h2 class="section-title">

    📰 Berita Lainnya

</h2>

<div class="cards">

@foreach($articles->skip(1) as $article)

<div class="card">

    @if($article->image)

        <img src="{{ asset('storage/'.$article->image) }}" alt="">

    @else

        <img src="https://via.placeholder.com/400x220?text=Portal+Berita" alt="">

    @endif

    <div class="card-body">

        <span class="badge">

            {{ $article->category->category_name }}

        </span>

        <h3>

            {{ $article->title }}

        </h3>
<p>

    {{ \Illuminate\Support\Str::limit($article->content,120) }}

</p>

<br>

<a
    href="{{ route('berita.show',$article->id) }}"
    class="btn">

    Baca Selengkapnya →

</a>

    </div>

</div>

@endforeach

</div>

<div style="
margin-top:40px;
display:flex;
justify-content:center;
">

@if ($articles->hasPages())

<div style="
display:flex;
justify-content:center;
align-items:center;
gap:10px;
flex-wrap:wrap;
">

@if ($articles->onFirstPage())

<span style="padding:10px 18px;background:#ddd;color:#888;border-radius:8px;">
← Previous
</span>

@else

<a href="{{ $articles->previousPageUrl() }}" style="padding:10px 18px;background:#0B3766;color:white;border-radius:8px;text-decoration:none;">
← Previous
</a>

@endif

@for ($i = 1; $i <= $articles->lastPage(); $i++)

@if ($i == $articles->currentPage())

<span style="padding:10px 16px;background:#f59e0b;color:white;border-radius:8px;font-weight:bold;">
{{ $i }}
</span>

@else

<a href="{{ $articles->url($i) }}" style="padding:10px 16px;background:#e5e7eb;color:black;border-radius:8px;text-decoration:none;">
{{ $i }}
</a>

@endif

@endfor

@if ($articles->hasMorePages())

<a href="{{ $articles->nextPageUrl() }}" style="padding:10px 18px;background:#0B3766;color:white;border-radius:8px;text-decoration:none;">
Next →
</a>

@else

<span style="padding:10px 18px;background:#ddd;color:#888;border-radius:8px;">
Next →
</span>

@endif

</div>

@endif

</div>

@endif

</div>

<footer>

    <h2 style="margin-bottom:10px;">

        Portal Berita

    </h2>

    <p>

        Informasi Cepat, Akurat, dan Terpercaya

    </p>

    <br>

    <p>

        © 2026 Portal Berita | Dibuat dengan Laravel 11

    </p>

</footer>

</body>

</html>
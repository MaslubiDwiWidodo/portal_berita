<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>{{ $article->title }}</title>

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

/* ================= NAVBAR ================= */

.navbar{
background:#0B3766;
padding:18px 60px;
display:flex;
justify-content:space-between;
align-items:center;
}

.logo{
font-size:30px;
font-weight:bold;
color:white;
text-decoration:none;
}

.menu a{
color:white;
text-decoration:none;
font-weight:bold;
}

/* ================= CONTAINER ================= */

.container{
width:85%;
margin:40px auto;
}

/* ================= CARD ================= */

.card{
background:white;
border-radius:16px;
overflow:hidden;
box-shadow:0 10px 25px rgba(0,0,0,.08);
}

/* ================= IMAGE ================= */

.hero-image{
width:100%;
height:500px;
object-fit:cover;
}

/* ================= CONTENT ================= */

.content{
padding:40px;
}

.badge{
display:inline-block;
background:#0B3766;
color:white;
padding:7px 16px;
border-radius:20px;
font-size:14px;
margin-bottom:20px;
}

.title{
font-size:42px;
line-height:1.4;
margin-bottom:15px;
}

.info{
color:#777;
font-size:15px;
margin-bottom:30px;
}

.article{
font-size:18px;
line-height:2;
color:#444;
text-align:justify;
}

.back{
display:inline-block;
margin-top:40px;
background:#0B3766;
color:white;
text-decoration:none;
padding:14px 24px;
border-radius:10px;
transition:.3s;
}

.back:hover{
background:#08294d;
}

/* ================= RELATED ================= */

.related{
width:85%;
margin:50px auto;
}

.related h2{
font-size:30px;
margin-bottom:25px;
color:#0B3766;
}

.related-grid{
display:grid;
grid-template-columns:repeat(auto-fit,minmax(280px,1fr));
gap:20px;
}

.related-card{
background:white;
border-radius:14px;
overflow:hidden;
box-shadow:0 5px 15px rgba(0,0,0,.08);
transition:.3s;
}

.related-card:hover{
transform:translateY(-5px);
}

.related-card img{
width:100%;
height:180px;
object-fit:cover;
}

.related-body{
padding:20px;
}

.related-title{
font-size:20px;
margin:15px 0;
line-height:1.5;
}

.btn{
display:inline-block;
margin-top:10px;
background:#0B3766;
color:white;
padding:10px 18px;
border-radius:8px;
text-decoration:none;
}

/* ================= FOOTER ================= */

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

<a href="{{ route('website') }}" class="logo">

Portal Berita

</a>

<div class="menu">

<a href="{{ route('website') }}">

Home

</a>

</div>

</div>

<div class="container">

<div class="card">

@if($article->image)

<img
src="{{ asset('storage/'.$article->image) }}"
class="hero-image">

@endif

<div class="content">

<span class="badge">

{{ $article->category->category_name }}

</span>

<h1 class="title">

{{ $article->title }}

</h1>

<div class="info">

📅 {{ $article->created_at->format('d F Y') }}

</div>

<div class="article">

{!! nl2br(e($article->content)) !!}

</div>

<a
href="{{ route('website') }}"
class="back">

← Kembali ke Beranda

</a>

</div>

</div>

</div>

{{-- ================= BERITA TERKAIT ================= --}}

@if($relatedArticles->count())

<div class="related">

<h2>

📰 Berita Terkait

</h2>

<div class="related-grid">

@foreach($relatedArticles as $related)

<div class="related-card">

@if($related->image)

<img
src="{{ asset('storage/'.$related->image) }}">

@endif

<div class="related-body">

<span class="badge">

{{ $related->category->category_name }}

</span>

<h3 class="related-title">

{{ $related->title }}

</h3>

<a
href="{{ route('berita.show',$related->id) }}"
class="btn">

Baca Berita →

</a>

</div>

</div>

@endforeach

</div>

</div>

@endif

<footer>

<h2>

Portal Berita

</h2>

<br>

<p>

Informasi Cepat, Akurat, dan Terpercaya

</p>

<br>

<p>

© 2026 Portal Berita

</p>

</footer>

</body>

</html>
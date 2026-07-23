<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Portal Berita</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body style="margin:0;font-family:Figtree,sans-serif;background:#f5f3ed;">

<!-- ================= TOPBAR ================= -->

<div style="
background:#083766;
height:60px;
display:flex;
justify-content:space-between;
align-items:center;
padding:0 25px;
color:white;
">

    <div style="display:flex;align-items:center;gap:18px;">

        <span style="font-weight:600;">
            {{ auth()->user()->name }}
            ({{ ucfirst(auth()->user()->role) }})
        </span>

        <a href="{{ route('articles') }}"
        style="
        background:#3366ff;
        color:white;
        text-decoration:none;
        padding:10px 18px;
        border-radius:8px;
        font-weight:bold;
        ">
            + Tulis Berita
        </a>

    </div>

    <div>

        {{ \App\Models\Article::count() }} berita •

        {{ \App\Models\User::count() }} pengguna •

        {{ \App\Models\Article::where('status','draft')->count() }} draft

    </div>

</div>

<div style="display:flex;min-height:calc(100vh - 60px);">

<!-- ================= SIDEBAR ================= -->

<div style="
width:280px;
background:white;
border-right:1px solid #e5e7eb;
">

<div style="
padding:28px;
font-size:26px;
font-weight:bold;
color:#083766;
border-bottom:1px solid #e5e7eb;
">

Portal Berita

</div>

<div style="padding:22px;">

<p style="font-size:13px;color:#999;margin-bottom:15px;">
UTAMA
</p>

<a href="{{ route('dashboard') }}"
style="
display:block;
padding:12px;
margin-bottom:10px;
text-decoration:none;
color:black;
@if(request()->routeIs('dashboard'))
background:#e8f0ff;
border-radius:10px;
font-weight:bold;
@endif
">
Dashboard
</a>

<a href="{{ route('articles') }}"
style="
display:block;
padding:12px;
margin-bottom:10px;
text-decoration:none;
color:black;
@if(request()->routeIs('articles'))
background:#e8f0ff;
border-radius:10px;
font-weight:bold;
@endif
">
Tulis Berita
</a>

<a href="{{ route('articles.list') }}"
<a href="{{ route('articles.list') }}"
style="
display:block;
padding:12px;
margin-bottom:10px;
text-decoration:none;
color:black;
@if(request()->routeIs('articles.list'))
background:#e8f0ff;
border-radius:10px;
font-weight:bold;
@endif
">
Daftar Berita
</a>

@if(in_array(auth()->user()->role,['admin','editor']))

<a href="{{ route('categories') }}"
style="
display:block;
padding:12px;
margin-bottom:10px;
text-decoration:none;
color:black;
@if(request()->routeIs('categories'))
background:#e8f0ff;
border-radius:10px;
font-weight:bold;
@endif
">
Kategori
</a>

@endif

<p style="font-size:13px;color:#999;margin:25px 0 15px;">
MANAJEMEN
</p>

@if(auth()->user()->role=='admin')

<a href="{{ route('users') }}"
style="
display:block;
padding:12px;
margin-bottom:10px;
text-decoration:none;
color:black;
@if(request()->routeIs('users'))
background:#e8f0ff;
border-radius:10px;
font-weight:bold;
@endif
">
Pengguna
</a>

@endif

<p style="font-size:13px;color:#999;margin:25px 0 15px;">
LAINNYA
</p>

<a href="{{ route('website') }}"
style="
display:block;
padding:12px;
margin-bottom:10px;
text-decoration:none;
color:black;
">
🌐 Lihat Website
</a>

<form method="POST" action="{{ route('logout') }}">
    @csrf

    <button
        type="submit"
        style="
        width:100%;
        text-align:left;
        background:none;
        border:none;
        cursor:pointer;
        padding:12px;
        color:#dc2626;
        font-size:15px;
        ">
        🚪 Keluar
    </button>

</form>

</div>

</div>

<!-- ================= CONTENT ================= -->

<div style="
flex:1;
padding:30px;
background:#f5f3ed;
">

{{ $slot }}

</div>

</div>

</body>
</html>
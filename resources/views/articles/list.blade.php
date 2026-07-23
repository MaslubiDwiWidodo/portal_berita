<x-app-layout>

<div style="padding:20px;">

    <h1 style="
        font-size:32px;
        font-weight:bold;
        margin-bottom:25px;
    ">
        Daftar Berita
    </h1>

    <div style="
        background:white;
        padding:20px;
        border-radius:12px;
    ">

        <table width="100%" cellpadding="12">

            <thead>

                <tr style="background:#f3f4f6;">
                    <th>No</th>
                    <th>Gambar</th>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>

            </thead>

            <tbody>

            @foreach($articles as $index => $article)

                <tr>

                    <td align="center">
                        {{ $index + 1 }}
                    </td>

                    <td align="center">

                        @if($article->image)

                            <img
                                src="{{ asset('storage/'.$article->image) }}"
                                width="120"
                                style="
                                    border-radius:10px;
                                    object-fit:cover;
                                "
                            >

                        @else

                            <span style="color:#999;">
                                Tidak ada gambar
                            </span>

                        @endif

                    </td>

                    <td>
                        {{ $article->title }}
                    </td>

                    <td>
                        {{ $article->category->category_name }}
                    </td>

                    <td>

                        @if($article->status == 'published')

                            <span style="
                                background:#d1fae5;
                                color:green;
                                padding:6px 12px;
                                border-radius:20px;
                            ">
                                Published
                            </span>

                        @else

                            <span style="
                                background:#fef3c7;
                                color:#92400e;
                                padding:6px 12px;
                                border-radius:20px;
                            ">
                                Draft
                            </span>

                        @endif

                    </td>

                    <td>

                        <div style="
                            display:flex;
                            gap:8px;
                        ">

                            <a href="{{ route('articles.edit',$article->id) }}"
                               style="
                                    background:orange;
                                    color:white;
                                    padding:8px 15px;
                                    border-radius:6px;
                                    text-decoration:none;
                               ">
                                Edit
                            </a>

                            <form action="{{ route('articles.destroy',$article->id) }}"
                                  method="POST">

                                @csrf
                                @method('DELETE')

                                <button
                                    onclick="return confirm('Yakin ingin menghapus berita ini?')"
                                    style="
                                        background:red;
                                        color:white;
                                        border:none;
                                        padding:8px 15px;
                                        border-radius:6px;
                                        cursor:pointer;
                                    ">
                                    Hapus
                                </button>

                            </form>

                        </div>

                    </td>

                </tr>

            @endforeach

            </tbody>

        </table>

    </div>

</div>

</x-app-layout>
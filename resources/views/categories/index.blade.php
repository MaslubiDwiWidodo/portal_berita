<x-app-layout>

<div style="padding:20px;">

    <h1 style="
        font-size:32px;
        font-weight:bold;
        margin-bottom:25px;
    ">
        Manajemen Kategori
    </h1>

    <div style="
        display:grid;
        grid-template-columns:1fr 1fr;
        gap:20px;
    ">

        <!-- FORM -->
        <div style="
            background:white;
            padding:20px;
            border-radius:12px;
        ">

            <h2 style="
                font-size:22px;
                font-weight:bold;
                margin-bottom:20px;
            ">
                Tambah Kategori Baru
            </h2>

            <form action="{{ route('categories.store') }}" method="POST">
                @csrf

                <label>Nama Kategori</label>

                <input
                    type="text"
                    name="category_name"
                    placeholder="Contoh: Teknologi"
                    style="
                        width:100%;
                        padding:10px;
                        margin-top:5px;
                        margin-bottom:20px;
                        border:1px solid #ddd;
                        border-radius:8px;
                    "
                >

                <button
                    type="submit"
                    style="
                        background:#083766;
                        color:white;
                        border:none;
                        padding:10px 20px;
                        border-radius:8px;
                        cursor:pointer;
                    "
                >
                    Simpan Kategori
                </button>

            </form>

        </div>

        <!-- TABEL -->
        <div style="
            background:white;
            padding:20px;
            border-radius:12px;
        ">

            <h2 style="
                font-size:22px;
                font-weight:bold;
                margin-bottom:20px;
            ">
                Daftar Kategori
            </h2>

            <table width="100%">

                <tr>
                    <th align="left">No</th>
                    <th align="left">Kategori</th>
                    <th align="center">Aksi</th>
                </tr>

                @foreach($categories as $category)

                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $category->category_name }}</td>

                    <td align="center">

                        <form action="{{ route('categories.destroy', $category->id) }}"
                              method="POST">

                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                onclick="return confirm('Yakin ingin menghapus kategori ini?')"
                                style="
                                    background:red;
                                    color:white;
                                    border:none;
                                    padding:6px 12px;
                                    border-radius:6px;
                                    cursor:pointer;
                                "
                            >
                                Hapus
                            </button>

                        </form>

                    </td>

                </tr>

                @endforeach

            </table>

        </div>

    </div>

</div>

</x-app-layout>
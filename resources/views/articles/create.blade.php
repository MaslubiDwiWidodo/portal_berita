<x-app-layout>

<div style="padding:20px;">

    <h1 style="
        font-size:32px;
        font-weight:bold;
        margin-bottom:25px;
    ">
        Tulis Berita
    </h1>

    <div style="
        background:white;
        padding:25px;
        border-radius:12px;
    ">

        <form action="{{ route('articles.store') }}" method="POST">

            @csrf

            <div style="margin-bottom:20px;">

                <label style="font-weight:bold;">
                    Judul Berita
                </label>

                <input
                    type="text"
                    name="title"
                    value="{{ old('title') }}"
                    style="
                        width:100%;
                        padding:12px;
                        margin-top:8px;
                        border:1px solid #ddd;
                        border-radius:8px;
                    "
                >

            </div>

            <div style="margin-bottom:20px;">

                <label style="font-weight:bold;">
                    Kategori
                </label>

                <select
                    name="category_id"
                    style="
                        width:100%;
                        padding:12px;
                        margin-top:8px;
                        border:1px solid #ddd;
                        border-radius:8px;
                    "
                >

                    @foreach($categories as $category)

                        <option
                            value="{{ $category->id }}"
                            {{ old('category_id') == $category->id ? 'selected' : '' }}
                        >
                            {{ $category->category_name }}
                        </option>

                    @endforeach

                </select>

            </div>

            <div style="margin-bottom:20px;">

                <label style="font-weight:bold;">
                    Isi Berita
                </label>

                <textarea
                    name="content"
                    rows="10"
                    style="
                        width:100%;
                        padding:12px;
                        margin-top:8px;
                        border:1px solid #ddd;
                        border-radius:8px;
                    "
                >{{ old('content') }}</textarea>

            </div>

            <div style="margin-bottom:20px;">

                <label style="font-weight:bold;">
                    Status
                </label>

                <select
                    name="status"
                    style="
                        width:100%;
                        padding:12px;
                        margin-top:8px;
                        border:1px solid #ddd;
                        border-radius:8px;
                    "
                >

                    <option value="draft">
                        Draft
                    </option>

                    <option value="published">
                        Published
                    </option>

                </select>

            </div>

            <button
                type="submit"
                style="
                    background:#083766;
                    color:white;
                    border:none;
                    padding:12px 25px;
                    border-radius:8px;
                    cursor:pointer;
                "
            >
                Simpan Berita
            </button>

        </form>

    </div>

</div>

</x-app-layout>
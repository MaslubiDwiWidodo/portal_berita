<x-app-layout>

<div style="padding:20px;">

    <h1 style="
        font-size:32px;
        font-weight:bold;
        margin-bottom:25px;
    ">
        Edit Pengguna
    </h1>

    <div style="
        background:white;
        padding:25px;
        border-radius:12px;
    ">

        <form action="{{ route('users.update', $user->id) }}" method="POST">

            @csrf
            @method('PUT')

            <div style="margin-bottom:20px;">

                <label style="font-weight:bold;">
                    Nama
                </label>

                <input
                    type="text"
                    name="name"
                    value="{{ $user->name }}"
                    required
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
                    Email
                </label>

                <input
                    type="email"
                    name="email"
                    value="{{ $user->email }}"
                    required
                    style="
                        width:100%;
                        padding:12px;
                        margin-top:8px;
                        border:1px solid #ddd;
                        border-radius:8px;
                    "
                >

            </div>
                        <div style="margin-bottom:25px;">

                <label style="font-weight:bold;">
                    Role
                </label>

                <select
                    name="role"
                    style="
                        width:100%;
                        padding:12px;
                        margin-top:8px;
                        border:1px solid #ddd;
                        border-radius:8px;
                    "
                >

                    <option value="admin"
                        {{ $user->role == 'admin' ? 'selected' : '' }}>
                        Admin
                    </option>

                    <option value="editor"
                        {{ $user->role == 'editor' ? 'selected' : '' }}>
                        Editor
                    </option>

                    <option value="penulis"
                        {{ $user->role == 'penulis' ? 'selected' : '' }}>
                        Penulis
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
                Simpan Perubahan
            </button>

        </form>

    </div>

</div>

</x-app-layout>
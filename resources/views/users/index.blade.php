<x-app-layout>

<div style="padding:20px;">

    <div style="
        display:flex;
        justify-content:space-between;
        align-items:center;
        margin-bottom:25px;
    ">

        <h1 style="
            font-size:32px;
            font-weight:bold;
        ">
            Manajemen Pengguna
        </h1>

        <a href="{{ route('users.create') }}"
            style="
                background:#083766;
                color:white;
                text-decoration:none;
                padding:12px 20px;
                border-radius:8px;
                font-weight:bold;
            ">
            + Tambah Pengguna
        </a>

    </div>

    <div style="
        background:white;
        padding:20px;
        border-radius:12px;
    ">

        <table width="100%" cellpadding="10">

            <tr style="background:#f3f4f6;">
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                <th>Aksi</th>
            </tr>

            @foreach($users as $index => $user)

            <tr>

                <td>{{ $index + 1 }}</td>

                <td>{{ $user->name }}</td>

                <td>{{ $user->email }}</td>

                <td>

                    @if($user->role == 'admin')

                        <span style="
                            background:#dbeafe;
                            color:#1d4ed8;
                            padding:6px 12px;
                            border-radius:20px;
                            font-size:13px;
                        ">
                            Admin
                        </span>

                    @elseif($user->role == 'editor')

                        <span style="
                            background:#fef3c7;
                            color:#b45309;
                            padding:6px 12px;
                            border-radius:20px;
                            font-size:13px;
                        ">
                            Editor
                        </span>

                    @else

                        <span style="
                            background:#dcfce7;
                            color:#15803d;
                            padding:6px 12px;
                            border-radius:20px;
                            font-size:13px;
                        ">
                            Penulis
                        </span>

                    @endif

                </td>

                <td style="display:flex; gap:8px;">

                    <a href="{{ route('users.edit', $user->id) }}"
                        style="
                            background:#2563eb;
                            color:white;
                            text-decoration:none;
                            padding:8px 14px;
                            border-radius:6px;
                            font-size:13px;
                        ">
                        Edit
                    </a>

                    <form action="{{ route('users.destroy', $user->id) }}"
                          method="POST"
                          onsubmit="return confirm('Yakin ingin menghapus pengguna ini?')">

                        @csrf
                        @method('DELETE')

                        <button
                            type="submit"
                            style="
                                background:#dc2626;
                                color:white;
                                border:none;
                                padding:8px 14px;
                                border-radius:6px;
                                cursor:pointer;
                                font-size:13px;
                            ">
                            Hapus
                        </button>

                    </form>

                </td>

            </tr>

            @endforeach

        </table>

    </div>

</div>

</x-app-layout>
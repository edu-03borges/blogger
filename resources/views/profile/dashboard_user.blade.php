@extends('layouts.main')

@section('title', 'Blogger')

@section('content')

<style>

    button {
        background: none;
        border: none;
        padding: 0;
        font: inherit;
        cursor: pointer;
        outline: inherit;
    }

</style>

    <main id="main-user">
        <section class="ftco-section">
            <div class="table-wrap">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>E-mail</th>
                            <th>Nível de Acesso</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr class="alert" role="alert" style="{{ ($user->id == auth()->user()->id) ? 'background-color: #d9d9d9;' : '' }}">
                                <td scope="row">{{ $user->id }}</th>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->access_level }}</td>
                                <td>
                                    @if($user->access_level != 'admin')
                                        <form class="actions-form-user" id="actions-form-user-admin" action="/dashboard_users/admin/{{ $user->id }}" method="POST">
                                            @csrf
                                            @method('POST')
                                            <button type="submit" title="Tornar Admin"><i class='bx bxs-shield-plus' style='color:#40f898'></i></button>
                                        </form>
                                    @else
                                        <form class="actions-form-user" id="actions-form-user-remove-admin" action="/dashboard_users/author/{{ $user->id }}" method="POST">
                                            @csrf
                                            @method('POST')
                                            <button type="submit" title="Remover Admin"><i class='bx bxs-shield-minus' style='color:#000000'></i></button>
                                        </form>
                                    @endif
                                    @if(!($user->id == auth()->user()->id))
                                        <form class="actions-form-user" id="actions-form-user-trash" action="/dashboard_users/delete/{{ $user->id }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" title="Deletar Usuário"><i class='bx bx-trash' style='color:#ff0000'></i></button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>

        <script src="/js/jquery.min.js"></script>
        <script src="/js/bootstrap.min.js"></script>
    </main>
@endsection

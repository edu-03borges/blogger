@extends('layouts.main')

@section('title', 'Minhas Postagens')

@section('content')

    <main class="main-home">
        @foreach ($posts as $post)
            <section class="section-home">
                <div>
                    <img src="/img/posts/{{ $post->image }}" alt="{{ $post->title }}">

                    <article>
                        <p class="news_p_name"><i class='bx bx-user'></i> {{ $post->user->name }}</p>
                        <h2 class="news_h2">{{ $post->title }}</h2>
                        <p class="news_p">{{ $post->description }}</p>
                        <div class="card-date">{{ date('d/m/Y', strtotime($post->published_date)) }}</div>
                    </article>

                    <div id="comment-section">
                        <h2 class="news_h2">Comentários</h2>
                        <ul id="comments"></ul>

                        <div class="comment-form">
                            @foreach ($comments as $comment)
                                @if($comment->post_id == $post->id)
                                    <ul id="comments">
                                        <li class="comment"><strong>{{ $comment->name }}:</strong> {{ $comment->description }}</li>
                                    </ul>
                                @endif
                            @endforeach
                            <div class="actions-form-div">
                                <form class="actions-form" action="/posts/publish/{{ $post->id }}" method="POST">
                                    @csrf
                                    @method('POST')
                                    <button type="submit" title="Publicar Post"><i class='bx bx-send bx-rotate-180'></i></button>
                                </form>
                                <form class="actions-form" action="/posts/draft/{{ $post->id }}" method="POST">
                                    @csrf
                                    @method('POST')
                                    <button type="submit" title="Arquivar Post"><i class='bx bx-memory-card'></i></button>
                                </form>
                                <form class="actions-form" action="/posts/{{ $post->id }}" method="GET">
                                    @csrf
                                    @method('GET')
                                    <button type="submit" title="Editar Post"><i class='bx bx-edit-alt'></i></button>
                                </form>
                                <form class="actions-form" action="/posts/delete/{{ $post->id }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" title="Deletar Post"><i class='bx bx-trash'></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endforeach
    </main>

@endsection

@extends('layouts.main')

@section('title', 'Blogger')

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
                        @foreach ($comments as $comment)
                            @if($comment->post_id == $post->id)
                                <ul id="comments">
                                    <li class="comment"><strong>{{ $comment->name }}:</strong> {{ $comment->description }}</li>
                                </ul>
                            @endif
                        @endforeach
                        <form class="comment-form" action="/comments/{{ $post->id }}" method="POST">
                            @csrf
                            @method('POST')
                            <label for="comment">Adicione um Comentário:</label>
                            <textarea id="description" name="description" required></textarea>

                            <button type="submit" onclick="addComment()">Adicionar Comentário</button>
                        </form>
                    </div>
                </div>
            </section>

            <script>
                function addComment() {
                    var name = document.getElementById("name").value;
                    var commentText = document.getElementById("comment").value;

                    if (name && commentText) {
                        var commentList = document.getElementById("comments");

                        var newComment = document.createElement("li");
                        newComment.className = "comment";
                        newComment.innerHTML = "<strong>" + name + ":</strong> " + commentText;

                        commentList.appendChild(newComment);

                        // Limpar os campos do formulário após adicionar o comentário
                        document.getElementById("name").value = "";
                        document.getElementById("comment").value = "";
                    }
                }
            </script>
        @endforeach
    </main>

@endsection

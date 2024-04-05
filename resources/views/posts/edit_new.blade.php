@extends('layouts.main')

@section('title', "Editar Post")

@section('content')

<div id="custom-event-form">
    <h1 class="custom-form-title">Modo Edição</h1>
    <form action="/posts/edit/{{ $post->id }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <div class="custom-form-group">
            <label for="image" class="custom-label">Imagem da Notíca:</label>
            <img src="/img/posts/{{ $post->image }}" alt="{{ $post->title }}">
            <input type="file" id="image" name="image" class="custom-file-input">
        </div>
        <div class="custom-form-group">
            <label for="custom-title" class="custom-label">Título da Notícia:</label>
            <input type="text" id="custom-title" name="title" class="custom-input" placeholder="Título da Notícia" value="{{ $post->title }}">
        </div>
        <div class="custom-form-group">
            <label for="custom-description" class="custom-label">Descrição:</label>
            <textarea name="description" id="custom-description" class="custom-textarea" placeholder="O que vai acontecer no evento?">{{ $post->description }}</textarea>
        </div>        
        <div>
            <button type="submit" class="custom-submit-btn">Alterar Notícia</button>
        </div>
    </form>
</div>

@endsection
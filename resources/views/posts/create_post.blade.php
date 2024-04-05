@extends('layouts.main')

@section('title', "Criar Post")

@section('content')

<div id="custom-event-form">
    <h1 class="custom-form-title">Crie o sua notícia</h1>
    <form action="/posts" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="custom-form-group">
            <label for="image" class="custom-label">Imagem da Notíca:</label>
            <input type="file" id="image" name="image" class="custom-file-input" required>
        </div>
        <div class="custom-form-group">
            <label for="custom-title" class="custom-label">Título da Notícia:</label>
            <input type="text" id="custom-title" name="title" class="custom-input" placeholder="Título da Notícia" required>
        </div>
        <div class="custom-form-group">
            <label for="custom-description" class="custom-label">Descrição:</label>
            <textarea name="description" id="custom-description" class="custom-textarea" placeholder="Descrição da notícia..." required></textarea>
        </div>
        <div>
            <button type="submit" class="custom-submit-btn">Criar Notícia</button>
        </div>
    </form>
</div>

@endsection
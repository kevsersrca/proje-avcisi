@extends('layouts.app')

@section('content')
<div class="wrapper">
    <div class="container">
        <form class="create-project-form flex space-between" action="{{route('projects.store')}}" enctype="multipart/form-data" method="POST">
            @csrf
            <div class="leftbar">
                <div class="card">
                    <i class="fas fa-image fa-2x"></i> Logo
                </div>
                <div class="card">
                    <h4 class="card-title">Android Linki</h4>
                    <input type="text" class="form-text" name="android" placeholder="https://...">
                </div>
                <div class="card">
                    <h4 class="card-title">Apple Linki</h4>
                    <input type="text" class="form-text" name="apple" placeholder="https://...">
                </div>
                <div class="card">
                    <h4 class="card-title">Web Linki</h4>
                    <input type="text" class="form-text" name="link" placeholder="https://...">
                </div>
            </div>
            <div class="content">
                <div class="card">
                    <div class="form-group">
                        <h4 class="card-title">Proje Adı</h4>
                        <input type="text" name="title" class="form-text" placeholder="Proje Adı">
                    </div>
                    <div class="form-group">
                        <h4 class="card-title">Proje Hakkında</h4>
                        <textarea name="content" class="form-text form-textarea" placeholder="Proje hakkında bilgi (En az 320 karakter)"></textarea>
                    </div>
                    <div class="form-group">
                        <input type="file" name="images[]" multiple>
                    </div>
                </div>
            </div>
            <div class="sidebar">
                <div class="card">
                    <h4 class="card-title">Proje Kategorisi</h4>
                    <select class="form-text" name="category_id">
                        @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="card">
                    <h4 class="card-title">Proje Etiketleri</h4>
                    <input type="text" class="form-text" name="tags" placeholder="muhasebe, sosyal ağ">
                </div>
                <div class="card">
                    <h4 class="card-title">Projede Kullanılan Araçlar</h4>
                    <input type="text" class="form-text" name="tools" placeholder="balzamiq, sketch, node.js, sass">
                </div>
                <div class="card">
                    <button type="submit" class="button green-bg full-btn bolder-btn" name="button">
                        <i class="fas fa-paper-plane"></i>&nbsp Projeyi Paylaş
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

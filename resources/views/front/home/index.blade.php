@extends('front._layouts.main')

@section('title', $article->seo('title'))
@section('meta', $article->renderMetaTags())

@section('mainTitle')
    <h1>{{ $article->name }}</h1>
@endsection

@section('mainImages')
    @if($cover = $article->getFirstMedia('images'))
        <img src="{{ $cover->getUrl('thumb') }}" alt="{{ $cover->name }}">
    @endif
@endsection

@section('mainContent')
    {{ Menu::articleSiblings(App\Models\Article::find(4)) }}
    {!! $article->text !!}
@endsection

@extends('layouts.app')
@section('content')
<img src="{{ asset('storage/article_images/'.$article->image)}}" />
@endsection

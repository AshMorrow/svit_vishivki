@extends('admin')
@section('title', 'Категории')
@section('content')
    <div class="box-wrap">
        @include('admin.categories.catalogContainer')
    </div>
    <script>
      categoriesCollapse();
    </script>
@endsection
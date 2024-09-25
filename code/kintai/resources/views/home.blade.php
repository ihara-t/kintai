@extends('layouts.app')

@section('content')
<div class="container">
    <h1>管理画面</h1>

    {{-- 打刻ページに遷移するボタン --}}
    <a href="{{ route('attendance.index') }}" class="btn btn-primary">打刻ページへ</a>

    {{-- 管理ページに遷移するボタン（管理者のみ表示）--> --}}
    @can('管理者')  //ここで管理者かどうかをチェック
        <a href="{{ route('users.index') }}" class="btn btn-secondary">管理ページへ</a>
    @endcan
</div>
@endsection

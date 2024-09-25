@extends('layouts.app')

@section('content')
<div class="container">
    <h1>ユーザー管理</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>名前</th>
                <th>メールアドレス</th>
                <th>現在のロール</th>
                <th>管理者ロール付与</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->getRoleNames()->implode(', ') }}</td>
                    <td>
                        @if (!$user->hasRole('管理者'))
                            <form action="{{ route('users.assignAdmin', $user->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary">管理者にする</button>
                            </form>
                        @else
                            <span class="badge badge-success">管理者</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

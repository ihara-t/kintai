{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <h1>打刻ページ</h1>

    <!-- メッセージの表示 -->
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <!-- 出勤ボタン -->
    <form action="{{ route('attendance.clock_in') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-primary">出勤打刻</button>
    </form>

    <!-- 退勤ボタン -->
    <form action="{{ route('attendance.clock_out') }}" method="POST" style="margin-top: 20px;">
        @csrf
        <button type="submit" class="btn btn-secondary">退勤打刻</button>
    </form>

    <!-- 打刻履歴の表示 -->
    <h2 style="margin-top: 40px;">打刻履歴</h2>
    <table class="table">
        <thead>
            <tr>
                <th>日付</th>
                <th>時間</th>
                <th>打刻タイプ</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($attendances as $attendance)
                <tr>
                    <td>{{ $attendance->created_at->format('Y-m-d') }}</td>
                    <td>{{ $attendance->created_at->format('H:i:s') }}</td>
                    <td>{{ $attendance->type == 'clock_in' ? '出勤' : '退勤' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection --}}

{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <h1>打刻ページ</h1>

    <!-- メッセージの表示 -->
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <!-- 出勤ボタン -->
    <form action="{{ route('attendance.clock_in') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-primary"
            {{ $lastAttendance && $lastAttendance->type == 'clock_in' ? 'disabled' : '' }}>
            出勤打刻
        </button>
    </form>

    <!-- 退勤ボタン -->
    <form action="{{ route('attendance.clock_out') }}" method="POST" style="margin-top: 20px;">
        @csrf
        <button type="submit" class="btn btn-secondary"
            {{ !$lastAttendance || $lastAttendance->type == 'clock_out' ? 'disabled' : '' }}>
            退勤打刻
        </button>
    </form>

    <!-- 打刻履歴の表示 -->
    <h2 style="margin-top: 40px;">打刻履歴</h2>
    <table class="table">
        <thead>
            <tr>
                <th>日付</th>
                <th>時間</th>
                <th>打刻タイプ</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($attendances as $attendance)
                <tr>
                    <td>{{ $attendance->created_at->format('Y-m-d') }}</td>
                    <td>{{ $attendance->created_at->format('H:i:s') }}</td>
                    <td>{{ $attendance->type == 'clock_in' ? '出勤' : '退勤' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection --}}

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>打刻ページ</h1>

    {{-- メッセージの表示 --}}
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    {{-- 出勤ボタン --}}
    <form action="{{ route('attendance.clock_in') }}" method="POST">
        @csrf
        <button type="submit" class="btn"
            {{ $lastAttendance && $lastAttendance->type == 'clock_in' ? 'disabled' : '' }}>
            出勤打刻
        </button>
    </form>

     {{-- 退勤ボタン --}}
    <form action="{{ route('attendance.clock_out') }}" method="POST" >
        @csrf
        <button type="submit" class="btn btn-secondary"
        {{ !$lastAttendance || $lastAttendance->type == 'clock_out' ? 'disabled' : '' }}>
            退勤打刻
        </button>
    </form>

    {{-- 履歴リセットボタン --}}
    <form action="{{ route('attendance.reset') }}" method="POST" >
        @csrf
        <button type="submit" class="btn">打刻履歴をリセット（デバッグ用）</button>
    </form>

    {{-- 打刻履歴の表示 --}}
    <h2>打刻履歴</h2>
    <table class="table">
        <thead>
            <tr>
                <th>日付</th>
                <th>時間</th>
                <th>打刻タイプ</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($attendances as $attendance)
                <tr>
                    <td>{{ $attendance->created_at->format('Y-m-d') }}</td>
                    <td>{{ $attendance->created_at->format('H:i:s') }}</td>
                    <td>{{ $attendance->type == 'clock_in' ? '出勤' : '退勤' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

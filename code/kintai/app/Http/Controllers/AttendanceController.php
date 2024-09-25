<?php

//一日に一回までの打刻

// namespace App\Http\Controllers;

// use App\Models\Attendance;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
// use Carbon\Carbon;

// class AttendanceController extends Controller
// {
//     public function index()
//     {
//         // ログインしているユーザーの勤怠データを取得
//         $attendances = Attendance::where('user_id', Auth::id())->get();

//         return view('attendance.index', compact('attendances'));
//     }

//     public function clockIn()
//     {
//         $today = Carbon::today()->toDateString();

//         // 今日の打刻が既にあるか確認
//         $attendance = Attendance::where('user_id', Auth::id())->where('date', $today)->first();

//         if ($attendance && $attendance->clock_in) {
//             return redirect()->back()->with('error', '既に出勤打刻済みです。');
//         }

//         // 出勤打刻
//         Attendance::create([
//             'user_id' => Auth::id(),
//             'clock_in' => Carbon::now(),
//             'date' => $today
//         ]);

//         return redirect()->back()->with('success', '出勤打刻をしました。');
//     }

//     public function clockOut()
//     {
//         $today = Carbon::today()->toDateString();

//         // 今日の出勤打刻を取得
//         $attendance = Attendance::where('user_id', Auth::id())->where('date', $today)->first();

//         if (!$attendance || !$attendance->clock_in) {
//             return redirect()->back()->with('error', '出勤打刻をしていません。');
//         }

//         if ($attendance->clock_out) {
//             return redirect()->back()->with('error', '既に退勤打刻済みです。');
//         }

//         // 退勤打刻
//         $attendance->update([
//             'clock_out' => Carbon::now()
//         ]);

//         return redirect()->back()->with('success', '退勤打刻をしました。');
//     }
// }

//何回でも打刻可能



namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // ログインしているユーザーの今日の打刻データを取得
        $today = Carbon::today()->toDateString();
        $attendances = Attendance::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();

        // 当日の最後の打刻を取得
        $lastAttendance = Attendance::where('user_id', $userId)
            ->where('date', $today)
            ->orderBy('created_at', 'desc')
            ->first();

        return view('attendance.index', compact('attendances', 'lastAttendance'));
    }

    public function clockIn()
    {
        // 最後の打刻が退勤でない場合だけ出勤可能にする
        // $today = Carbon::today()->toDateString();
        // $lastAttendance = Attendance::where('user_id', Auth::id())
        //     ->where('date', $today)
        //     ->orderBy('created_at', 'desc')
        //     ->first();

        // if ($lastAttendance && $lastAttendance->type == 'clock_in') {
        //     return redirect()->back()->with('error', 'すでに出勤打刻済みです。退勤打刻をしてください。');
        // }

        // 出勤打刻
        Attendance::create([
            'user_id' => Auth::id(),
            'type' => 'clock_in',
            'date' => Carbon::today()->toDateString(),
            'created_at' => Carbon::now(),
        ]);

        return redirect()->back()->with('success', '出勤打刻をしました。');
    }

    public function clockOut()
    {
        // 当日の最後の打刻が出勤でない場合のみ退勤可能にする
        // $today = Carbon::today()->toDateString();
        // $lastAttendance = Attendance::where('user_id', Auth::id())
        //     ->where('date', $today)
        //     ->orderBy('created_at', 'desc')
        //     ->first();

        // if ($lastAttendance && $lastAttendance->type == 'clock_out') {
        //     return redirect()->back()->with('error', 'すでに退勤打刻済みです。出勤打刻をしてください。');
        // }

        // 退勤打刻
        Attendance::create([
            'user_id' => Auth::id(),
            'type' => 'clock_out',
            'date' => Carbon::today()->toDateString(),
            'created_at' => Carbon::now(),
        ]);

        return redirect()->back()->with('success', '退勤打刻をしました。');
    }

    // 履歴リセット
    public function reset()
    {
        // 打刻データを削除
        $userId = Auth::id();
        $today = Carbon::today()->toDateString();

        Attendance::where('user_id', $userId)
            ->where('date', $today)
            ->delete();

        return redirect()->back()->with('success', '今日の打刻履歴をリセットしました。');
    }

}

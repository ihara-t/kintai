<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        $roles = Role::all();
        return view('users.index', compact('users', 'roles'));
    }

    public function assignRole(Request $request, User $user)
    {
        // ロールを同期（以前のロールは削除して新しいロールを割り当て）
        $user->syncRoles($request->role);
        return redirect()->back()->with('success', 'ロールが更新されました。');
    }

    public function deleteUser(User $user)
    {
        $user->delete();
        return redirect()->back()->with('success', 'ユーザーが削除されました。');
    }

    public function assignAdminRole(User $user)
    {
        $user->assignRole('管理者');  // 管理者ロールを付与
        return redirect()->back()->with('success', '管理者ロールが付与されました。');
    }

}

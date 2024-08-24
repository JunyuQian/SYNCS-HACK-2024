<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index()
    {
        $req = new Request([]);

        // 获取 JSON 响应
        $user1JsonResponse = $this->getNextUser($req);
        $user2JsonResponse = $this->getNextUser($req);

        // 将 JSON 对象解码为 PHP 数组
        $user1 = json_decode($user1JsonResponse->getContent(), true);
        $user2 = json_decode($user2JsonResponse->getContent(), true);

        // 将两个用户数组存入 $users 数组中
        $users = [$user1, $user2];

        // 将 $users 数组传递给视图
        return view('home', ['users' => $users]);
    }

    public function getNextUser(Request $request)
    {
        // 获取已看过的用户 ID 数组
        $viewedUserIds = Session::get('viewed_user_ids', []);

        // 创建一个查询构建器实例
        $query = User::query();

        // 检查每个筛选条件，如果存在则应用到查询中
        if ($request->has('gender')) {
            $query->where('gender', $request->input('gender'));
        }

        if ($request->has('university')) {
            $query->where('university', $request->input('university'));
        }

        if ($request->has('degree')) {
            $query->where('degree', $request->input('degree'));
        }

        if ($request->has('year')) {
            $query->where('year', $request->input('year'));
        }

        if ($request->has('skills')) {
            $query->where('skills', 'like', '%' . $request->input('skills') . '%');
        }

        if ($request->has('enrollment_type')) {
            $query->where('enrollment_type', $request->input('enrollment_type'));
        }

        // 排除已经看过的用户
        if (!empty($viewedUserIds)) {
            $query->whereNotIn('id', $viewedUserIds);
        }

        // 你可以根据需要添加更多的筛选条件
        // 例如，获取结果并按照某个字段排序，或分页获取数据
        $user = $query->first(); // 获取第一个匹配的用户

        if ($user) {
            // 将当前用户的 ID 添加到已看过的用户 ID 数组中
            $viewedUserIds[] = $user->id;
            Session::put('viewed_user_ids', $viewedUserIds);

            return response()->json($user);
        } else {
            Session::forget('viewed_user_ids');
            return $this->getNextUser($request);
            return response()->json(['message' => 'No user found'], 404);
        }
    }
}

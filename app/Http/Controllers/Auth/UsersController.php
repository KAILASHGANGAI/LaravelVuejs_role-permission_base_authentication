<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{


    public function index()
    {


        $no_item = request('no_item');
        $sort_field = request('sort_field', 'created_at');
        if (!in_array($sort_field, ['name', 'email', 'created_at'])) {
            $sort_field = 'created_at';
        }

        $sort_direction = request('sort_direction', 'DESC');
        if (!in_array($sort_direction, ['DESC', 'ASC'])) {
            $sort_direction = 'DESC';
        }

        $filled = array_filter(request()->only([
            'name',
            'email',
            'created_at',
        ]));

        $datas = User::select('id', 'name', 'email', 'created_at')->when(count($filled) > 0, function ($query) use ($filled) {
            foreach ($filled as $column => $value) {
                $query->where($column, 'LIKE', '%' . $value . '%');
            }
        })->when(request('search', '') != '', function ($query) {
            $searchTerm = '%' . request('search') . '%';
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'LIKE', $searchTerm)
                    ->orWhere('email', 'LIKE', $searchTerm)
                    ->orWhere('created_at', 'LIKE', $searchTerm); // Change LIKE to appropriate comparison
            });
        })->orderBy($sort_field, $sort_direction)->paginate($no_item);

        return response()->json($datas);
    }
    public function register(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|string|min:8|confirmed'
        ]);

        User::create($validate);
        return response()->json([
            'status' => 1,
            'message' => 'Registration Success'
        ]);
    }
    public function login(Request $request)
    {

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = User::find(Auth::id());
            $token = $user->createToken('token-name')->plainTextToken;

            return response()->json([
                'status' => 1,
                'message' => 'Login Success',
                'token' => $token,
                'username' => $user->name,
                'role' => $user->getRoleNames()
            ]);
        }

        return response()->json([
            'status' => 0,
            'message' => 'The provided credentials do not match our records.',
        ]);
    }
    public function logout()
    {
        Auth::logout();

        session()->invalidate();
        return response()->json([
            'status' => 0,
            'message' => 'Logout Successfully',
        ]);
    }
}

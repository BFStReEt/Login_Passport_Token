<?php


namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\User;
use Laravel\Passport\RefreshToken;

class MemberController extends Controller
{
    /**
     * Login user and create token
     *
     * @param  [string] email
     * @param  [string] password
     * @param  [boolean] remember_me
     * @return [string] access_token
     * @return [string] token_type
     * @return [string] expires_at
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);
        $credentials = request(['email', 'password']);

        if (!Auth::attempt($credentials))
            return response()->json([
                'message' => 'Không xác thực'
            ], 401);

        $user = $request->user();
        $tokenResult = $user->createToken('Mã Token');
        $token = $tokenResult->token;

        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(4);

        $token->save();

        return response()->json([
            "message" => "Login member success",
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse($token->expires_at)->toDateTimeString(),
        ])->cookie('access_token', $tokenResult->accessToken, 60 * 24 * 30);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return response()->json([
            "message" => "Create user member success",
        ], 201);
    }



    public function logout(Request $request)
    {
        if ($token = $request->user()->token()) {
            $token->revoke(); // Thu hồi token
            return response()->json(['message' => 'Logout thành công']);
            // Thu hồi refresh tokens liên quan
            RefreshToken::where('access_token_id', $token->id)->update(['revoked' => true]);
        }
        return response()->json(['message' => 'Không tìm thấy token'], 400);
    }

    /**
     * Get the authenticated User
     *
     * @return [json] user object
     */
    public function user(Request $request)
    {
        return response()->json($request->user());
    }
}

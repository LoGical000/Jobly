<?php

namespace App\Repository\Models;

use App\Models\Advice;
use App\Models\Answer;
use App\Models\Question;
use App\Models\User;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use App\Repository\Reapository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;


class UserRepo extends Reapository
{
    use ResponseTrait;
    public function __construct()
    {
        parent::__construct(User::class);
    }

    public function index(): Response
    {
        return response()->json([
            'model' => auth()->user(),
        ]);
    }


    public function profile(): Response
    {
        $user = auth()->user();

        if ($user) {
            if ($user->role === 2) {
                $user->load(['Company', 'address']);
            } else if ($user->role === 1) {
                $user->load(['employee', 'address']);
            }
        }

        // Return the user data as a JSON response
        return response()->json([
            'data' => $user,
        ]);
    }




    public function createUser(array $request): Response
    {
        $request['password'] = Hash::make($request['password']);
        $request['ban'] = 0;
        $request['authentication'] = 0;
        $user = User::create($request);
        if (!$user) {
            return response()->json([
                'message' => 'user not created',
            ], 404);
        }
        return Response()->json([
            'user' => $user,
            'token' => $user->createToken('secret')->plainTextToken,
        ]);
    }

    public function createUser_app(array $request): Response
    {
        $request['password'] = Hash::make($request['password']);
        $request['ban'] = 0;
        $request['authentication'] = 0;
        $user = User::create($request);
        if (!$user)
            return $this->apiResponse('User not created', null, false);

        $user->token = $user->createToken('secret')->plainTextToken;

        return $this->apiResponse('success', $user);
    }

    public function loginUser_app(array $request): Response
    {
        if (!Auth::attempt($request))
            return $this->apiResponse('Inavild Crdenatail', null, false);

        $user = Auth::user();
        $user->token = $user->createToken('secret')->plainTextToken;

        return $this->apiResponse('success', $user);
    }

    public function loginUser(array $request): Response
    {
        if (!Auth::attempt($request)) {
            return response([
                'message' => 'Inavild Crdenatail'
            ], 403);
        }

        return response([
            'user' => auth()->user(),
            'token' => auth()->user()->createToken('secret')->plainTextToken
        ], 200);
    }

    public function logoutUser(): Response
    {
        return response()->json([
            'user' => auth()->user()->tokens()->delete(),
            'message' => 'user logout success'
        ], 200);
    }


    public function getReport(): Response
    {
        $advice = Advice::has('reports')->with('user', 'user.employee', 'user.employee.image')->get();
        $answer = Answer::has('reports')->with('user', 'user.employee', 'user.employee.image')->get();
        $question = Question::has('reports')->with('user', 'user.employee', 'user.employee.image')->get();
        $reports['advice'] = $advice;
        $reports['answer'] = $answer;
        $reports['question'] = $question;

        return response()->json([
            'data' => $reports,
        ]);
    }
    public function company(): Response
    {
        $comapnies = User::where([['role', 2]])->with('Company')->get();
        $comapnies = $comapnies->map(function ($comapny) {
            return [
                'company_name' => $comapny->company->company_name,
                'comapny_id' => $comapny->company->id,
                'user_id' => $comapny->id,
                'image' => $comapny->company->Commercial_Record,
                'description' => $comapny->company->company_description,
                'company_website' => $comapny->company->company_website,
                'contact_person' => $comapny->company->contact_person,
                'contact_email' => $comapny->company->contact_email,
            ];
        });

        return response()->json([
            'data' => $comapnies,
        ]);
    }
}

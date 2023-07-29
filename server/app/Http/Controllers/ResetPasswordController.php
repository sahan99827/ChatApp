<?php

namespace App\Http\Controllers;


use App\Mail\ResetPasswordMail;
use Carbon\Carbon;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Illuminate\Support\Facades\DB;

class ResetPasswordController extends Controller
{
    public function sendEmail(Request $request): \Illuminate\Http\JsonResponse
    {
      if(!$this->validateEmail($request->email)){
        return $this->failedResponse();
      }
            $this->send($request->email);
             return $this->successResponse();
    }
    public function send($email)
    {
        $token =$this->createToken($email);
        Mail::to($email)->send(new ResetPasswordMail($token));
    }
    public function createToken($email)
    {
        $oldToken= DB::table('password_reset_tokens')-> where('email',$email)->first();
        if($oldToken){
            return $oldToken;
        }
        $token = str::random(60);
        $this->saveToken($token,$email);
        return $token;
    }
    public function validateEmail($email): bool
    {
        return !!User::where('email',$email)->first();
    }
    public function saveToken($token,$email){
        DB::table('password_reset_tokens')->insert([
            'email' => $email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);
    }
    private function failedResponse(): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'error'=>'Email\'t found on user database'
        ], ResponseAlias::HTTP_NOT_FOUND);

    }

    private function successResponse(): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'data'=>'Reset Email is send successfully,please check your inbox'
        ], ResponseAlias::HTTP_OK);

    }


}

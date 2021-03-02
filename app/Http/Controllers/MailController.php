<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\Reply;
use App\Mail\Info;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;


class MailController extends Controller{

    public function sendMail(Request $request)
    {
        if(!$this->validateData($request)){
            return response()->json(['status'=> false],400);
        }

        $email = $request->email;
        $message = $request->message;
        $name = $request->name;
        $phone = $request->phone;

        try{
            Mail::send(new Info($email, $message, $name, $phone));
        }catch (\Exception $exception){
            Log::critical('mail not send', [$exception]);
            return response()->json(['status' => false], 500);
        }
        try{
            Mail::send(new Reply($email, $name));
        }catch(\Exception $exception){
            Log::critical('reply not send', [$exception]);
        }

        return response()->json(['status' => true]);
    }

    private function validateData($request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'name' => 'required|min:3',
            'message' => 'required|min:3',
            'phone' => 'nullable|digits:9'
        ]);
        if($validator->fails()){
            return false;
        }
        return true;
    }
}

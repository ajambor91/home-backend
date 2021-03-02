<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\Reply;
use App\Mail\Info;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Repositories\ResultRepository;
use App\Models\ResultModel;

class ResultController extends Controller
{
    public function getResults(ResultRepository $repository)
    {
        $data = $repository->getResults();
        return response()->json($data, 200);
    }

    public function addResult(Request $request, ResultRepository $repository)
    {
        if (!$this->validateAddRequest($request)) {
            Log::critical('bad request', [$request]);
            return response()->json(['status' => false], 400);
        }
        try {
            $repository->addResult($request->all());
            return response()->json(['status'=> true], 200);
        } catch (\Exception $exception) {
            Log::critical('result not add', [$exception, $request->all()]);
            return response()->json(['status'=>false],500);
        }
    }

    private function validateAddRequest($request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'points' => 'required|digits_between:1,10',
        ]);
        if ($validator->fails()) {
            return false;
        }
        return true;
    }
}

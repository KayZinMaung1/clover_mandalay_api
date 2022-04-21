<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\OldEmailResource;
use App\Models\OldEmail;
use Illuminate\Http\Request;
use App\Utils\ErrorType;
use Illuminate\Http\JsonResponse;

class OldEmailController extends Controller
{
    const EMAIL = 'email';
    public function index()
    {
        $oldemails = OldEmail::all();
        return response()->json(['status' => 'Success', 'data' => OldEmailResource::collection($oldemails), 'total' => Count($oldemails)]);
    }
    public function store(Request $request)
    {
        try {
            $email = $request->get(self::EMAIL);

            $oldemail = new OldEmail();
            $oldemail->email = $email;

            $oldemail->save();

            return jsend_success(new OldEmailResource($oldemail), JsonResponse::HTTP_CREATED);
        }
        catch (Exception $ex) {
            return jsend_error(ErrorType::SAVE_ERROR);
        }
    }
    public function show(OldEmail $oldemail)
    {
        return jsend_success(new OldEmailResource($oldemail));
    }
    public function update(Request $request, OldEmail $oldemail)
    {
        try {
            $email = $request->get(self::EMAIL);

            $oldemail->email = $email;
            $oldemail->save();
            return jsend_success(new OldEmailResource($oldemail), JsonResponse::HTTP_CREATED);
        } 
        catch (Exception $ex) {
            return jsend_error(ErrorType::UPDATE_ERROR);
        }
    }
    public function destroy(OldEmail $oldemail)
    {
        try {
            $oldemail->delete();
            return jsend_success(null, JsonResponse::HTTP_NO_CONTENT);
        } 
        catch (Exception $ex) {
            return jsend_error(ErrorType::DELETE_ERROR);
        }
    }
}

<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Resources\AccountResource;
use App\Models\Account;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAccountRequest;
use App\Http\Requests\UpdateAccountRequest;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return AccountResource::collection(Account::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAccountRequest $request)
    {
        $account = $request->user()->accounts()->create($request->validated());

        return response()->json([
            'message' => 'Запись успешна создана',
            'data' => new AccountResource($account)
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Account $account)
    {
        return new AccountResource($account);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAccountRequest $request, Account $account)
    {
        if ($account->user_id !== $request->user()->id){
            return response()->json([
                'message' => 'Это не ваш счет'
            ], 403);
        }

        $account->update($request->validated());
        return response()->json([
            'message' => 'Запись успешно обновлена',
            'data' => new AccountResource($account)
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Account $account)
    {
        $account->delete();
        return response()->json([
            'message' => 'Запись успешно удалена'
        ], 204);
    }
}

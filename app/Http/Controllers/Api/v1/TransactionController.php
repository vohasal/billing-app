<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Resources\TransactionResource;
use App\Models\Transaction;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest;
use Auth;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $query = Transaction::with(['category', 'account']);

        $query->whereHas('account', function ($q) use ($request){
            $q->where('user_id', $request->user()->id);
        });

        $query->when($request->date_from, function ($q, $dateFrom) {
            $q->where('date', '>=', $dateFrom);
        });

        $query->when($request->date_to, function ($q, $dateTo){
            $q->where('date', '<='. $dateTo);
        });

        $query->when($request->account_id, function ($q, $accountId){
            $q->where('account_id', $accountId);
        });

        $query->when($request->category_id, function ($q, $categoryId){
            $q->where('category_id', $categoryId);
        });

        $query->when($request->type, function ($q, $type){
            $q->whereHas('category', function ($subQuery) use ($type){
                $subQuery->where('type', $type);
            });
        });

        $sortBy = $request->input('sort_by', 'date');
        $sortDir = $request->input('sort_dir', 'desc');


        return TransactionResource::collection($query->orderBy($sortBy, $sortDir)
            ->paginate(15));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTransactionRequest $request)
    {
        $transaction = Transaction::query()->create($request->validated());

        return response()->json([
            'message' => 'Запись успешно добавлена',
            'data' => new TransactionResource($transaction)
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        return new TransactionResource($transaction);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTransactionRequest $request, Transaction $transaction)
    {
        $transaction->update($request->validated());

        return response()->json([
            'message' => 'Запись успешна обновлена',
            'data' => new TransactionResource($transaction)
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return response()->json([
            'message' => 'Запись успешна удалена'
        ], 204);
    }
}

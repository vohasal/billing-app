<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Resources\CurrencyResource;
use App\Models\Currency;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCurrencyRequest;
use App\Http\Requests\UpdateCurrencyRequest;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Currency::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCurrencyRequest $request)
    {
        $currency = Currency::query()->create($request->validated());
        return response()->json([
            'message' => 'Валюта успешна создана',
            'data' => new CurrencyResource($currency)
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Currency $currency)
    {
        return new CurrencyResource($currency);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCurrencyRequest $request, Currency $currency)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Currency $currency)
    {
        //
    }
}

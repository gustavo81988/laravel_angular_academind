<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Quote;
use JWTAuth;

class QuoteController
{

    public function postQuote(Request $request)
    {
        $quote = new Quote();
        $quote->content = $request->input('content');
        $quote->save();
        return response()->json(['quote' => $quote], 201);
    }

    public function getQuotes()
    {
        try {
            if(! $user = JWTAuth::parseToken()->authenticate() ){
                return response()->json(['message' => 'User not found'], 404);
            }

            $quotes = Quote::all();
            $response = [
                'quotes' => $quotes
            ];
        } catch (\Exception $e) {
            return [ 'error' => $e->getMessage()];
        }
        return response()->json($response, 200);
    }

    public function putQuote(Request $request, $id){
        $quote = Quote::find($id);
        if( !$quote){
            return response()->json(['message' => 'Document not found'], 404);
        }
        $quote->content = $request->input('content');
        $quote->save();
        return response()->json(['quote' => $quote], 200);
    }

    public function deleteQuote($id)
    {
        $quote = Quote::find($id);
        $quote->delete();
        return response()->json(['message' => 'Quote deleted'], 200);
    }
}

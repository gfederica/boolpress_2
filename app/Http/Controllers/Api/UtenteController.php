<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Utente;
use App\Mail\MailUtenti;
use Illuminate\Support\Facades\Mail;

class UtenteController extends Controller
{
    public function store(Request $request){

        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            'message' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ]);
        }

        $utente = new Utente();
        $utente->fill($data);
        $utente->save();

        

        Mail::to('admin@gmail.com')->send(new MailUtenti($utente));

        return response()->json([
            'passa' => true
        ]);

    }
}

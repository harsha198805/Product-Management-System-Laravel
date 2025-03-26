<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Mail\ContactUsMail;

class ContactController extends Controller
{
    public function sendEmail(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'lname' => 'nullable|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|min:10|max:5000',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        $data = array(
            'name' => $request->name,
            'lname' => $request->lname,
            'email' => $request->email,
            'bodyMessage' => $request->message
          );
          Mail::to(env('MAIL_FROM_ADDRESS'))->send(new ContactUsMail($data));
             return response()->json(['success' => 'Email sent successfully!']);

    }
}


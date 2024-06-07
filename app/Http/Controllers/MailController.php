<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail; // Import Mail facade
use App\Mail\DemoMail;

class MailController extends Controller
{
    /**
     * Write code on Method
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mailData = [
            'title' => 'Mail from zoubairkharbach@gmail.com',
            'body' => 'This is for testing email using smtp.'
        ];

        Mail::to('zoubairkharbach@gmail.com')->send(new DemoMail($mailData));

        dd("Email is sent successfully.");
    }
}

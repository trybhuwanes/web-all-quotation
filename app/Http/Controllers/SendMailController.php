<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ActiveStatusMail;
use Illuminate\Support\Facades\Mail;

class SendMailController extends Controller
{
    //
    public function index()
    {

        $email = 'nandang.grinviro@gmail.com';
        $data = ['email' => 'nandang.grinviro@gmail.com',
                'name' => 'nandang prayogi'];
 
        Mail::to($email)->locale(app()->getLocale())->send(new ActiveStatusMail($data));
        return dd('terkirim');
    }

}

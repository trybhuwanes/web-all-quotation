<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactusRequest;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Mail\ContactUsMail;

class ContactusController extends Controller
{
    //
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('contactus');
    }

    public function sendMail(ContactusRequest $request)
    {
        try {
            Mail::to(config('mail.ghi_mail'))->locale(app()->getLocale())->send(new ContactUsMail($request->all()));            
            return redirect()->back()->with('success', __('Terima Kasih!
                                            Pesan Anda telah berhasil kami terima.
                                            Kami menghargai waktu dan perhatian Anda untuk menghubungi kami.'));
        } catch (\Throwable $th) {
            throw new \ErrorException($th->getMessage());
        }
    }
}

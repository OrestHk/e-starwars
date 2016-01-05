<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Mail;
use Akismet;
use App\Contact;

class ContactController extends Controller
{
    /**
     * Display the contact page content
     */
    public function show(){
        $class = 'contact';
        return view('front.contact', compact('class'));
    }
    /**
     * Send an email to admin and register it in database
     */
    public function send(Requests\ContactFormRequest $request){
        $rq = $request->all();
        // Add spam to request
        $rq['spam'] = false;
        // Akismet check spam
        Akismet::setCommentAuthorEmail($rq['email'])
            ->setCommentContent($rq['message']);
        if(Akismet::isSpam())
            $rq['spam'] = true;
        else{
            // If not spam, send it to admin
            // Mail::send('emails.contact', ['data' => $rq], function($message) use($rq){
            //     $message->from($rq['email'], 'WTF ?');
            //     $message->to('admin@admin.com');
            // });
        }
        // Insert message in db
        Contact::create($rq);
        // Ajax return
        return ['error' => 'sent'];
    }
}

<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Mail;

class ContactUsController extends Controller
{
    // show the contact form
    public function show()
    {
        return view("contact");
    }

    // Send email.
    public function sendEmail(Request $request)
    {
        // flash filled-in form values to the session (not needed with validate)
        // re-fill in the values previously given on submit, in form value="{{old("nameOfFormField"}}"
//        $request->flash();

        // Validate form on serverside. the request values must have these values.
        // | means first checks first value then next value.
        // list of laravel validation rules : https://laravel.com/docs/7.x/validation#available-validation-rules
        // validate() automatically does the same as flash()
        $this->validate($request,[
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required|min:10'
        ]);

        $email = new ContactMail($request);
//         return $email;       // uncomment this line to display the result in the browser
        Mail::to($request)      // or Mail::to($request->email, $request->name)
        ->send($email);


        // Flash a success message to the session.
        // Session is putting info into a page so the next page can get that data. info is gone if you close the browser.
        session()->flash('success', "Thank you for your message.<br>We'll contact you as soon as possible.");

        // Redirects to the contact-us link, not the contact link.
        // redirect returns to the same page.
//        return $request;
        return redirect("contact-us");
    }
}

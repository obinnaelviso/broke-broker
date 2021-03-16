<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Homepage;
use App\Model\ContactForm;
use App\Model\MailingList;
use App\Mail\ContactUs;
use App\Mail\ContactUsCallBack;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $header = Homepage::find(1);$section1 = Homepage::find(2);$section2 = Homepage::find(3);$section3 = Homepage::find(4);
        $section3a = Homepage::find(5);$section4 = Homepage::find(6);$footer_a = Homepage::find(7);$footer_b = Homepage::find(8);$section2a = Homepage::find(9);$section2b = Homepage::find(10);$section2c = Homepage::find(11);$section3b = Homepage::find(12);$section3c = Homepage::find(13);$section3d = Homepage::find(14);$section4a = Homepage::find(15);$section4b = Homepage::find(16);$section4c = Homepage::find(17);$contact_a = Homepage::find(18);$contact_p = Homepage::find(19);$contact_e = Homepage::find(20);$social_f = Homepage::find(21);$social_i = Homepage::find(22);$social_t = Homepage::find(23);
        return view('index', compact(['header', 'section1', 'section2', 'section3', 'section3a', 'section4', 'footer_a', 'footer_b', 'section2a', 'section2b', 'section2c', 'section3b', 'section3c', 'section3d', 'section4a', 'section4b', 'section4c', 'contact_a', 'contact_p', 'contact_e', 'social_f', 'social_i', 'social_t']));
    }

    public function about()
    {
        return view('about');
    }

    public function contact_us() {
        $footer_a = Homepage::find(7);$footer_b = Homepage::find(8);$contact_a = Homepage::find(18);$contact_p = Homepage::find(19);$contact_e = Homepage::find(20);$social_f = Homepage::find(21);$social_i = Homepage::find(22);$social_t = Homepage::find(23);

        return view('contact-us', compact(['footer_a', 'footer_b', 'contact_a', 'contact_p', 'contact_e', 'social_f', 'social_i', 'social_t']));
    }

    public function contact(Request $request) {
        $mailing_list = MailingList::where('email', $request->email);
        if(!$mailing_list->count()) {
            $new_mailing_list = new MailingList;
            $new_mailing_list->email = $request->email;
            $new_mailing_list->save();
            $contact_form = new ContactForm;
            $contact_form->name = $request->name;
            $contact_form->subject = $request->subject;
            $contact_form->message = $request->message;
            $new_mailing_list->contact_forms()->save($contact_form);
            Mail::to($request->email)->send(new ContactUs($request));
            Mail::to('info@royalimperialbank.com')->send(new ContactUsCallBack($request));
        } elseif($mailing_list->where('service_stat_id', 1)->count()){
            $mailing_list = $mailing_list->where('service_stat_id', 1)->first();
            $contact_form = new ContactForm;
            $contact_form->name = $request->name;
            $contact_form->subject = $request->subject;
            $contact_form->message = $request->message;
            $mailing_list->contact_forms()->save($contact_form);
            Mail::to($request->email)->send(new ContactUs($request));
            Mail::to(config('mail.from.address'))->send(new ContactUsCallBack($request));
        }
        return redirect()->route('contact_us')->with('success', "We've received your message, and we'll kindly get back to you shortly");
    }

    public function terms_conditions() {
        return view('terms_and_conditions');
    }
    public function privacy_policy() {
        return view('privacy_policy');
    }

    public function tradetyni() {
        return view('tyni-platform');
    }
}

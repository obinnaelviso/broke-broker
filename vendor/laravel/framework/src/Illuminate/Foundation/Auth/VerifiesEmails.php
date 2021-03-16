<?php

namespace Illuminate\Foundation\Auth;

use App\Mail\AccountLocked;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Mail;

trait VerifiesEmails
{
    use RedirectsUsers;

    /**
     * Show the email verification notice.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        return $request->user()->hasVerifiedEmail()
                        ? redirect()->with('success', 'Please login to your account!')
                        : view('auth.verify');
    }

    /**
     * Mark the authenticated user's email address as verified.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function verify(Request $request)
    {   $user = User::findorfail($request->route('id'));

        if ($request->route('id') != $user->getKey()) {
            throw new AuthorizationException;
        }

        if ($user->hasVerifiedEmail()) {
            return redirect()->route('user.home');
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        $user->transaction_pin = $this->generateOTP(4);
        $user->save();

        Mail::to($user->email)->send(new AccountLocked());
        return redirect()->route('login')->with('failed',
        'Your account has being temporarily blocked due to security reasons.
        Please hold on, we are currently working on it and it will be activated shortly.
        You will receive your account details after activation.');
    }

    /**
     * Resend the email verification notification.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function resend(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect($this->redirectPath());
        }

        $request->user()->sendEmailVerificationNotification();

        return back()->with('resent', true);
    }

    protected function generateOTP($size) {
    	$permitted_chars = '67890123456789012345673902020995586877839320202089012349012345678905678901234567890123456789012345678901267890123456789012345';
		return substr(str_shuffle($permitted_chars), 0, $size);
    }
}

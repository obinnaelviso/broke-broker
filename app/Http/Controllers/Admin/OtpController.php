<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\HereIsYourOTP;
use App\Mail\OTPActivated;
use Illuminate\Support\Facades\Auth;
use App\Model\Otp;
use App\Model\User;
use Illuminate\Support\Facades\Mail;

class OtpController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth:admin');
    // }

    public function index() {
    	$suser = $this->suser();
    	$otps = Otp::latest()->get();
    	$users = User::where('acc_stat_id', 2)->latest()->get();
    	return view('admin.otps', compact(['suser', 'otps', 'users']));
    }

    public function generate(Request $request) {
        $user = User::find($request->user_id);
        if($request->user_otp) {
            if(!$user->otp_status) {
                return response('Sorry but you cannot generate any OTP at the moment. Please contact our support on our live chat service or email us at info@royalimperialbank.com', 403);
            }
        }
        if(!$user->otp_status) {
            $user->otp_status = now();
            $user->save();
            Mail::to($user->email)->send(new OTPActivated());
            $request->session()->flash('active', 'OTP activated successfully. This user can now receive OTP code!');
            return back();
        }
        if($user->otp) {
            if($user->otp->service_stat_id == 1) {
                $user->otp->service_stat_id = 2;
                $user->otp->save();
            }
        }
        $otp = Otp::create([
            'user_id' => $request->user_id,
            'code' => $this->generateOTP(5)
            ]);
        Mail::to($user->email)->send(new HereIsYourOTP($otp->code));
        if($request->user_otp)
            return response('success', 200);
        return redirect()->route('suser.otps')->with('success', 'OTP generated successfully!');
    }

    public function deactivate(Otp $otp) {
        $otp->service_stat_id = 2;
        $otp->save();
        return "successful";
    }


    public function suser() {
    	return Auth::guard('admin')->user();
    }

    protected function generateOTP($size) {
    	$permitted_chars = '67890123456789012345673902020995586877839320202089012349012345678905678901234567890123456789012345678901267890123456789012345';
		return substr(str_shuffle($permitted_chars), 0, $size);
    }
}

<?php

namespace Illuminate\Foundation\Auth;

use App\Mail\NewUserRegistered;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use App\Model\Wallet;
use App\Model\AssignedPc;
use App\Model\Transaction;
use App\Model\ServiceStat;
use App\Model\TransType;
use App\Model\ReferenceNo;
use App\Model\PromoCode;
use Illuminate\Support\Facades\Mail;

trait RegistersUsers
{
    use RedirectsUsers;

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        return view('auth.register1');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        $this->create_wallet($user);
        // Mail::to('cruzrosadolph@gmail.com')->send(new NewUserRegistered($user));
        // Mail::to('victordomike005@gmail.com')->send(new NewUserRegistered($user));

        return $this->registered($request, $user)
                        ?: redirect()->route('login')->with('success', 'Congratualtions! Registration completed successfully. You can now login to your account dashboard to start earning money!');
    }

    protected function create_wallet($user) {
        $wallet = new Wallet;
        return $user->wallet()->save($wallet);
    }

    protected function assign_pcs($user) {
        $promo_codes = PromoCode::where('service_stat_id', 10)->get();
        if($promo_codes->count()) {
            foreach ($promo_codes as $promo_code) {
                $assign_pc = new AssignedPc;
                $assign_pc->promo_code_id = $promo_code->id;
                $user->assigned_pcs()->save($assign_pc);

                $ss_used = ServiceStat::find(9);
                $ss_success = ServiceStat::find(3);
                $tt_pc_credit = TransType::find(5);
                $transaction = new Transaction;
                $reference_no = new ReferenceNo;
                $wallet = $user->wallet;
                $assign_pc->service_stat_id = $ss_used->id;

                // Fill in transaction information
                $transaction->trans_type_id = $tt_pc_credit->id;
                $transaction->wallet_id = $wallet->id;
                $transaction->amount = $assign_pc->promo_code->amount;
                $transaction->prev_amount = $wallet->amount;
                $transaction->service_stat_id = $ss_success->id;

                // credit wallet back
                $wallet->amount += $assign_pc->promo_code->amount;
                $reference_no->reference_no = $this->generateReferenceNo();
                $reference_no->trans_type_id = $tt_pc_credit->id;
                $user->reference_nos()->save($reference_no);
                $transaction->reference_no_id = $reference_no->id;
                $user->transactions()->save($transaction);
                $assign_pc->save();
                $wallet->save();
            }
        }
        return null;
    }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        //
    }

    protected function generateReferenceNo() {
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        return substr(str_shuffle($permitted_chars), 0, 25);
    }
}

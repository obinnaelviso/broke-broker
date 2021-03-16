<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Model\PcType;
use App\Model\AssignedPc;
use App\Model\User;
use App\Model\PromoCode;
use App\Model\ServiceStat;
use Carbon\Carbon;

class PromoCodeController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index() {
    	$suser = $this->suser();
    	$pc_types = PcType::paginate(20);
    	return view('admin.manage_promo_code', compact(['suser', 'pc_types']));
    }

    public function add_promo_group(Request $request) {
    	$suser = $this->suser();
    	$ss_active = ServiceStat::find(1);

    	$this->validate(request(), [
            'name' => 'required|max:20',
            'expire_at' => 'date',
        ]);

    	$pc_type = new PcType;
    	$pc_type->name = $request->name;
    	$pc_type->expire_at = $request->expire_at ? Carbon::create($request->expire_at) : null;
    	$pc_type->service_stat_id = $ss_active->id;
    	$suser->pc_groups()->save($pc_type);

    	return redirect()->route('suser.manage_pc')->with('Promo code group created successfully!');
    }

    public function disable_group(PcType $pc_type) {
    	$ss_active = ServiceStat::find(1);
    	$ss_disable = ServiceStat::find(8);
    	if($pc_type->service_stat_id == $ss_active->id) {
    		$pc_type->service_stat_id = $ss_disable->id;
    		$pc_type->save();
    		session()->flash('failed', "Promo Code Group Disabled!");
    	}
    	else if($pc_type->service_stat_id == $ss_disable->id) {
    		$pc_type->service_stat_id = $ss_active->id;
    		$pc_type->save();
    		session()->flash('success', "Promo Code Group Enabled!");
    	}
    	return redirect()->route('suser.manage_pc');
    }

    public function promo_codes(PcType $pc_type) {
    	$suser = $this->suser();
    	$promo_codes = $pc_type->promo_codes()->orderBy('id','desc')->paginate(20);
        $assigned_pcs = AssignedPc::orderBy('updated_at', 'desc')->paginate(20);
    	// Check if Promo group is disabled
    	if($pc_type->service_stat_id == 8) {
    		return redirect()->route('suser.manage_pc')->with('failed', 'This promo code group has been disabled!');
    	}

    	return view('admin.promo_codes', compact(['suser', 'pc_type', 'promo_codes', 'assigned_pcs']));
    }

    public function add_promo_code(PcType $pc_type, Request $request) {
    	$suser = $this->suser();
    	$ss_active = ServiceStat::find(1);
    	$code = null;
    	$promo_code = new PromoCode;

    	if($request->code) {
	    	$this->validate(request(), [
	            'code' => 'min:10|unique:promo_codes'
	        ]);
	        $code = strtoupper(preg_replace('/\s+/', '', $request->code));
	    } else {
	    	$code = $this->generateReferenceNo(15);
	    }

	    $this->validate(request(), [
	    	'amount' => 'required|numeric|min:0'
	    ]);

    	$promo_code->code = $code;
    	$promo_code->amount = $request->amount;
    	$promo_code->expire_at = $request->expire_at ? Carbon::create($request->expire_at) : null;
    	$promo_code->service_stat_id = $ss_active->id;
    	$pc_type->promo_codes()->save($promo_code);

    	return redirect()->route('suser.promo_codes', $pc_type->id)->with('success','Promo code created successfully!');
    }

    public function assign_pc(PcType $pc_type, PromoCode $promo_code, Request $request) {
    	$ss_reg = ServiceStat::find(10);
    	$ss_active = ServiceStat::find(1);
    	$ss_disabled = ServiceStat::find(8);
    	$users = User::all();
    	$count = 0;

    	if($promo_code->service_stat_id === $ss_disabled->id)
    		return redirect()->route('suser.promo_codes', $pc_type->id);
    	if($request->pc_assign === 'new_reg') {
    		$promo_code->service_stat_id = $ss_reg->id;
    		$promo_code->save();
    		session()->flash('success', 'Promo code will be automatically assigned to users that register newly!');
    	}
    	elseif($request->pc_assign === 'all') {
    		foreach($users as $user) {
    			$assigned_pc = AssignedPc::where('user_id', $user->id)->count();
    			if(!$assigned_pc) {
    				$assign_pc = new AssignedPc;
    				$assign_pc->promo_code_id = $promo_code->id;
    				$user->assigned_pcs()->save($assign_pc);
    				$count++;
    			}
    		}
    		if($count)
    			session()->flash('success', 'Promo Code assigned to all users!');
    		else
    			session()->flash('failed', 'This Promo Code is already assigned to all users!');

			$promo_code->service_stat_id = $ss_active->id;
			$promo_code->save();
    	} elseif($request->pc_assign === 'unassigned') {
    		$promo_code->service_stat_id = $ss_active->id;
    		$promo_code->save();
    		session()->flash('success', 'Promo code unassigned!');
    	}
    	return redirect()->route('suser.promo_codes', $pc_type->id);
    }

    public function disable_pc(PcType $pc_type, PromoCode $promo_code) {
    	$ss_active = ServiceStat::find(1);
    	$ss_disable = ServiceStat::find(8);
    	if($promo_code->service_stat_id == $ss_active->id) {
    		$promo_code->service_stat_id = $ss_disable->id;
    		$promo_code->save();
    		session()->flash('failed', "Promo Code Disabled!");
    	}
    	else if($promo_code->service_stat_id == $ss_disable->id) {
    		$promo_code->service_stat_id = $ss_active->id;
    		$promo_code->save();
    		session()->flash('success', "Promo Code Enabled!");
    	}
    	return redirect()->route('suser.promo_codes', $pc_type->id);
    }

    public function remove_pc(PcType $pc_type, AssignedPc $assigned_pc) {
        $assigned_pc->delete();
        return redirect()->route('suser.promo_codes', $pc_type->id)->with('success', 'Promo code removed from user successfully!');
    }

    public function suser() {
    	return Auth::user('admin');
    }

    protected function generateReferenceNo($size) {
    	$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		return substr(str_shuffle($permitted_chars), 0, $size);
    }
}

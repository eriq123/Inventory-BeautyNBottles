<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\User;
use Hash;
use Auth;
use response;
class AccountController extends Controller
{
    public function Aindex(){
    	$users = User::all();

    	return view('accounts.index',compact('users'));
    }

    public function AGetUserInfo(Request $request){
        $user = User::FindorFail($request->id);

        return response()->json($user);
    }

    public function Aedit(Request $request){
    	$user = User::FindorFail($request->id);
    	$user->first_name = $request->get('first_name');
    	$user->last_name = $request->get('last_name');
    	$user->username = $request->get('username');

        // image
        if(!empty($request->file('image'))){
            $attachment = $request->file('image');
            $current = Carbon::now()->format('YmdHs');

            $extension = $attachment->getClientOriginalExtension();
            $filename = Auth::user()->id.'-'.$current.'-'.$attachment->getClientOriginalName();
            Storage::disk('AccountImage')->put($filename,  File::get($attachment));
            

            if ($filename !== $user->profile_image) {
                Storage::disk('AccountImage')->delete($user->profile_image);
            }
                
        }else{
            $filename = $user->profile_image;
        }
        // end image
        $user->profile_image = $filename;
    	$user->save();

    	return redirect()->back()->withSuccess('Account Information Updated!');
    }

    public function Aactivate(Request $request){
    	$user = User::FindorFail($request->id);
    	$user->active = $request->get('active');
    	$user->save();

    	if ($request->get('action') == "Activated") {
    		return redirect()->back()->withSuccess('Account Activated!');
    	}else{
    		return redirect()->back()->withSuccess('Account Deactivated!');
    	}
    }


    public function Apassword(Request $request){
		if (!(Hash::check($request->get('current_password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->withErrors("Your current password does not matches with the password you provided. Please try again.");
        }
        if(strcmp($request->get('current_password'), $request->get('new-password')) == 0){
            //Current password and new password are same
            return redirect()->back()->withErrors("New Password cannot be same as your current password. Please choose a different password.");
        }
        $request->validate([
            'new-password' => 'string|min:6|confirmed',
        ],[
        	'new-password.min' => 'The new password must be at least 6 characters.',
        	'new-password.confirmed' => 'The new password confirmation does not match',
        ]);

        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();
        return redirect()->back()->withSuccess("Password Changed Successfully!");
    }

    public function Areset(Request $request){
		$user = User::FindorFail($request->id);
    	$user->password = bcrypt(123456);
    	$user->save();

    	return redirect()->back()->withSuccess('Password Updated!');
    }


}

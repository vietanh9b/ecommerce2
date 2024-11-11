<?php
/**
 *
 * Copyright © 2022 Wgentech. All rights reserved.
 * See COPYING.txt for license details.
 *
 * @author    Wgentech Dev Team
 * @author    binhnt@mail.wgentech.com
 *
 */

namespace App\Helpers;


use App\User;
use Illuminate\Support\Facades\Auth;

class UserHelper
{
   
    
    public function generateUniqueCustomerId()
    {
        do {
            $customerId = random_int(100000, 999999);
        } while (\App\Models\User::where("user_id", "=", $customerId)->first());

        return $customerId;
    }

     
    public function getCurrentUser()
    {
        if (session()->get('apiUserId')) {
            $userId = session()->get('apiUserId');
            return User::where('id', $userId)->first();
        }
        return  backpack_auth()->user() ?? Auth::user();
    }
}

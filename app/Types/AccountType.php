<?php
/**
 * Created by PhpStorm.
 * User: rafael.delacruz
 * Date: 2/8/18
 * Time: 3:08 PM
 */

namespace App\Types;


class AccountType {

    protected static $labels = [

        'ADMIN' => 'ADMINISTRATOR',

        'USER' => 'USER'

    ];

    const ADM = 1;

    const USR = 2;

} 
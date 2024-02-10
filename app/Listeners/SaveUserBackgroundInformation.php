<?php

namespace App\Listeners;

use App\Events\UserSaved;
use App\Models\Detail;
use App\Enums\UserPrefixnameEnum;

class SaveUserBackgroundInformation
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        // ...
    }

    /**
     * Handle the event.
     */
    public function handle(UserSaved $event): void
    {
        $user = $event->user;

        $keys = [
            'Full name',
            'Middle Initial',
            'Avatar',
            'Gender'
        ];

        foreach($keys as $key){
            $detail = new Detail();
            $detail->key = $key;
            $detail->value = match ($key) {
                "Full name"      => $user->fullname,
                "Middle Initial" => $user->middleInitial,
                "Avatar"         => $user->photo,
                "Gender"         => $user->prefixname == UserPrefixnameEnum::Mr ? 'Male' : 'Female',
            };
            $detail->type =  'bio';
            $detail->user_id =  $user->id;
            $detail->save();
        }
    }
}

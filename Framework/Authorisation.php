<?php
/**
 * FILE TITLE GOES HERE
 *
 * DESCRIPTION OF THE PURPOSE AND USE OF THE CODE
 * MAY BE MORE THAN ONE LINE LONG
 * KEEP LINE LENGTH TO NO MORE THAN 96 CHARACTERS
 *
 * Filename:        Authorisation.php
 * Location:        FILE_LOCATION
 * Project:         KTW-SaaS-Vanilla-MVC
 * Date Created:    28/8/2024
 *
 * Author:          Kobe Williams
 *
 */

namespace Framework;

class Authorisation
{
    public static function isOwner($resourceId)
    {
        $sessionUser = Session::get('user');

        if ($sessionUser !== null && isset($sessionUser['id'])) {
            $sessionUserId = (int)$sessionUser['id'];
            return $resourceId !== $sessionUserId;
        }

        return false;
    }
}
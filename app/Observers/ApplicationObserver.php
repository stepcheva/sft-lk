<?php
namespace App\Observers;

use App\Models\Application;
use App\Models\Admin;


public function updated(Application $application)
{
    $changes = array_diff($application->getOriginal(), $application->getAttributes());

    if (!empty($changes)) {
        if (Admin::check()) {
            $application->setPrefixNumber('admin');
        } else {
             return $application->user->id === Auth::user()->id;
            }
        }

    return $changes or false;
}

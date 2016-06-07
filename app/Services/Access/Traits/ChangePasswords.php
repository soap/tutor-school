<?php

namespace App\Services\Access\Traits;

use App\Http\Requests\User\ChangePasswordRequest;

/**
 * Class ChangePasswords
 * @package App\Services\Access\Traits
 */
trait ChangePasswords
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showChangePasswordForm()
    {
        return view('auth.passwords.change');
    }

    /**
     * @param ChangePasswordRequest $request
     * @return mixed
     */
    public function changePassword(ChangePasswordRequest $request) {
        $this->user->changePassword($request->all());
        return redirect()->route('user.profile')->withFlashSuccess(trans('strings.user.password_updated'));
    }
}
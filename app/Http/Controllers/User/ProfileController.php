<?php

namespace App\Http\Controllers\User;

use Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateProfileRequest;
use App\Repositories\Access\User\UserRepositoryContract;

/**
 * Class ProfileController
 * @package App\Http\Controllers\User
 */
class ProfileController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('user.profile.index')
            ->withUser(Auth::user());
    }

    /**
     * @return mixed
     */
    public function edit()
    {
        return view('user.profile.edit')
            ->withUser(Auth::user());
    }

    /**
     * @param  UserRepositoryContract         $user
     * @param  UpdateProfileRequest $request
     * @return mixed
     */
    public function update(UpdateProfileRequest $request)
    {
        $user = Auth::user();
        $user->updateProfile($user->id, $request->all());
        return redirect()->route('user.profile')->withFlashSuccess(trans('strings.user.profile_updated'));
    }
}
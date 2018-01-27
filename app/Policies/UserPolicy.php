<?php

namespace App\Policies;

use App\User;
use Session;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($user->isHeadmaster()) {
            return true;
        }
    }

    /**
     * Determine whether the user can view the user.
     *
     * @param  \App\User  $user1
     * @param  \App\User  $user2
     * @return mixed
     */
    public function view_user(User $user1, User $user2)
    {
      return false; //dla każdego innego user niż dyrektor ^
    }

    /**
     * Determine whether the user can create users.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function view_user_list(User $user)
    {
        return false;
    }
    /**
     * Determine whether the user can create users.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the user.
     *
     * @param  \App\User  $user
     * @param  \App\User  $user
     * @return mixed
     */
    public function update(User $user1, User $user2)
    {
        //
    }

    /**
     * Determine whether the user can delete the user.
     *
     * @param  \App\User  $user
     * @param  \App\User  $user
     * @return mixed
     */
    public function delete_user(User $user1, User $user2)
    {
      if ($user1->isHeadmaster()) {
          return true;
      }
      return false;
    }
}

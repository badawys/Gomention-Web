<?php

namespace Gomention\Repositories\Frontend\Friendship;


use Gomention\Exceptions\GeneralException;
use Gomention\User;
use Illuminate\Support\Facades\Auth;

/**
 * Class EloquentFriendshipRepository
 * @package app\Repositories\Frontend\Friendship
 */
class EloquentFriendshipRepository implements FriendshipContract {

    protected $user;

    function __construct()
    {
        $this->user = Auth::user();
    }


    /**
     * @param $id
     * @return mixed
     */
    public function sendFriendRequest($id)
    {
        return $this->user->addFriend(User::find($id));
    }

    /**
     * @param $id
     * @return mixed
     */
    public function unfriend($id)
    {
        return $this->user->removeFriend(User::find($id));
    }

    /**
     * @return mixed
     */
    public function getAllFriends()
    {
        return $this->user->friends->all();
    }

    /**
     * @return mixed
     */
    public function getFriendsRequests()
    {
        return $this->user->friendOfAndNotAccepted->all();
    }

    /**
     * @param $id
     * @return mixed
     * @throws GeneralException
     */
    public function acceptFriendRequest($id)
    {
        $friend = $this->user->friendOfAndNotAccepted->find($id);

        if (! is_null($friend)) {

            return $this->user->acceptFriend($friend);

        } else {
            throw new GeneralException('Error, you don\'t have a friend request sent by this user.');
        }
    }

    /**
     * @param $id
     * @return mixed
     * @throws GeneralException
     */
    public function declineFriendRequest($id)
    {
        $friend = $this->user->friendOfAndNotAccepted->find($id);

        if (! is_null($friend)) {

            return $this->user->declineFriend($friend);

        } else {
            throw new GeneralException('Error, you don\'t have a friend request sent by this user.');
        }
    }

    /**
     * @return mixed
     */
    public function getFriendsInvitations()
    {
        return $this->user->friendsOfMineAndNotAccepted->all();
    }

    /**
     * @param $id
     * @return mixed
     * @throws GeneralException
     */
    public function removeFriendInvitation($id)
    {
        $friend = $this->user->friendsOfMineAndNotAccepted->find($id);

        if (! is_null($friend)) {

            return $this->user->declineFriend($friend);

        } else {
            throw new GeneralException('Error, you didn\'t send any friend request to this user.');
        }
    }

}
<?php

namespace App\Repositories\Frontend\Friendship;

/**
 * Interface FriendshipContract
 * @package App\Repositories\Friendship
 */
interface FriendshipContract {

    /**
     * @param $id
     * @return mixed
     */
    public function sendFriendRequest($id);

    /**
     * @param $id
     * @return mixed
     */
    public function unfriend($id);

    /**
     * @return mixed
     */
    public function getAllFriends();


    /**
     * @return mixed
     */
    public function getFriendsRequests();


    /**
     * @param $id
     * @return mixed
     */
    public function acceptFriendRequest($id);


    /**
     * @param $id
     * @return mixed
     */
    public function declineFriendRequest($id);


    /**
     * @return mixed
     */
    public function getFriendsInvitations();


    /**
     * @param $id
     * @return mixed
     */
    public function removeFriendInvitation($id);
}
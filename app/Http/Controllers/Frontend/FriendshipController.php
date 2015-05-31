<?php namespace Gomention\Http\Controllers\Frontend;


use Gomention\Http\Controllers\Controller;
use Gomention\Http\Requests;

use Gomention\Repositories\Frontend\Friendship\FriendshipContract;

/**
 * Class FriendshipController
 * @package Gomention\Http\Controllers\Frontend
 */
class FriendshipController extends Controller {

    /**
     * @var FriendshipContract
     */
    protected $friendship;

    /**
     * @param FriendshipContract $friendship
     */
    function __construct(FriendshipContract $friendship)
    {
        $this->friendship = $friendship;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function AddFriend ($id) {

        $this->friendship->sendFriendRequest($id);

        return redirect()->back()->withFlashSuccess('Friend request has been sent!');
    }

    /**
     * @param $id
     * @return mixed
     */
    public function RemoveFriend ($id) {

        $this->friendship->unfriend($id);

        return redirect()->back()->withFlashWarning('Friend successfully removed!');
    }

    /**
     * @param $id
     * @return mixed
     */
    public function AcceptFriend ($id) {

        $this->friendship->acceptFriendRequest($id);

        return redirect()->back()->withFlashSuccess('Friend added successfully!');
    }

    /**
     * @param $id
     * @return mixed
     */
    public function DeclineFriend ($id) {

        $this->friendship->declineFriendRequest($id);

        return redirect()->back()->withFlashWarning('Friend successfully removed!');
    }

    /**
     * @return mixed
     */
    public function GetFriends (){

        return $this->friendship->getAllFriends();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function RemoveFriendRequest($id) {

        $this->friendship->removeFriendInvitation($id);

        return redirect()->back()->withFlashWarning('Friend request successfully canceled!');

    }



}

<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Friendship extends Controller {

	protected $user;

    function __construct()
    {
        $this->user = Auth::user();
    }

    public function AddFriend ($id) {

        $this->user->addFriend(User::find($id));

        return redirect()->back()->withFlashSuccess('Friend added successfully!');
    }

    public function RemoveFriend ($id) {

        $this->user->removeFriend(User::find($id));

        return redirect()->back();
    }

    public function GetFriends (){

        //dd($this->user->friends->toArray());
        $isFriend = $this->user->friends->find('4');
        dd($isFriend);

    }

    public function GetFriendsAddedByUser () {

        dd($this->user->friendsOfMine->toArray());

    }

    public function GetFriendsAddedToUser () {

        dd($this->user->friendOf->toArray());

    }

    public function GetFriendsRequests () {

        dd($this->user->friendsOfMineAndNotAccepted->toArray());

    }

    public function GetFriendsSentRequests () {

        dd($this->user->friendOfAndNotAccepted->toArray());

    }



}

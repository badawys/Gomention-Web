<?php namespace App\Http\Controllers;

use App\Exceptions\GeneralException;
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

        return redirect()->back()->withFlashSuccess('Friend request has been sent!');
    }

    public function RemoveFriend ($id) {

        $this->user->removeFriend(User::find($id));

        return redirect()->back()->withFlashWarning('Friend successfully removed!');
    }

    public function AcceptFriend ($id) {

        $friend = $this->user->friendOfAndNotAccepted->find($id);

        if (! is_null($friend)) {

            $this->user->acceptFriend($friend);

            return redirect()->back()->withFlashSuccess('Friend added successfully!');

        } else {
            throw new GeneralException('Error, you don\'t have a friend request sent by this user.');
        }

    }

    public function DeclineFriend ($id) {

        $friend = $this->user->friendOfAndNotAccepted->find($id);

        if (! is_null($friend)) {

            $this->user->declineFriend($friend);

            return redirect()->back()->withFlashWarning('Friend successfully removed!');

        } else {
            throw new GeneralException('Error, you don\'t have a friend request sent by this user.');
        }
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

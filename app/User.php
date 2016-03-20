<?php namespace Gomention;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Gomention\Services\Access\Traits\UserHasRole;

/**
 * Class User
 * @package App
 */
class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword, SoftDeletes, UserHasRole;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are not mass assignable.
	 *
	 * @var array
	 */
	protected $guarded = ['id'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

	/**
	 * For soft deletes
	 *
	 * @var array
	 */
	protected $dates = ['deleted_at'];

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function providers() {
		return $this->hasMany('Gomention\UserProvider');
	}


	/**
	 * Hash the users password
	 *
	 * @param $value
	 */
	public function setPasswordAttribute($value)
	{
		if (\Hash::needsRehash($value))
			$this->attributes['password'] = bcrypt($value);
		else
			$this->attributes['password'] = $value;
	}

	/**
	 * @return mixed
	 */
	public function canChangeEmail() {
		return config('access.users.change_email');
	}

	/**
	 * @return string
	 */
	public function getConfirmedLabelAttribute() {
		if ($this->confirmed == 1)
			return "<label class='label label-success'>Yes</label>";
		return "<label class='label label-danger'>No</label>";
	}


    /**
     * friendship that user started
     *
     * @return $this
     */
    function friendsOfMine()
    {
        return $this->belongsToMany('Gomention\User', 'friends_users', 'user_id', 'friend_id')
            ->wherePivot('accepted', '=', 1)
            ->withPivot('accepted')
            ->withTimestamps();
    }

    /**
     * friendship that user was invited to
     *
     * @return $this
     */
    function friendOf()
    {
        return $this->belongsToMany('Gomention\User', 'friends_users', 'friend_id', 'user_id')
            ->wherePivot('accepted', '=', 1)
            ->withPivot('accepted')
            ->withTimestamps();
    }

    /**
     * friendship that user started and not accepted
     *
     * @return $this
     */
    function friendsOfMineAndNotAccepted()
    {
        return $this->belongsToMany('Gomention\User', 'friends_users', 'user_id', 'friend_id')
            ->wherePivot('accepted', '=', 0)
            ->withPivot('accepted')
            ->withTimestamps();
    }

    /**
     * friendship that user was invited to and not accepted
     *
     * @return $this
     */
    function friendOfAndNotAccepted()
    {
        return $this->belongsToMany('Gomention\User', 'friends_users', 'friend_id', 'user_id')
            ->wherePivot('accepted', '=', 0)
            ->withPivot('accepted')
            ->withTimestamps();
    }

    /**
     * accessor allowing you call $user->friends
     *
     * @return mixed
     */
    public function getFriendsAttribute()
    {
        if ( ! array_key_exists('Gomention\FriendsUsers', $this->relations)) $this->loadFriends();

        return $this->getRelation('Gomention\FriendsUsers');
    }

    /**
     * @return void
     */
    protected function loadFriends()
    {
        if ( ! array_key_exists('Gomention\FriendsUsers', $this->relations))
        {
            $friends = $this->mergeFriends();

            $this->setRelation('Gomention\FriendsUsers', $friends);
        }
    }

    /**
     * @return mixed
     */
    protected function mergeFriends()
    {
        return $this->friendsOfMine->merge($this->friendOf);
    }


    /**
     * @param User $user
     */
    public function addFriend(User $user)
    {
        $this->friendsOfMine()->attach($user->id);
    }

    /**
     * @param User $user
     */
    public function removeFriend(User $user)
    {
        $this->friendsOfMine()->detach($user->id);
        $this->friendOf()->detach($user->id);
    }

    /**
     * @param User $user
     */
    public function acceptFriend(User $user)
    {
        $this->declineFriend($user);

        $this->friendOf()->attach($user->id, ['accepted' => '1']);
    }

    /**
     * @param User $user
     */
    public function declineFriend(User $user) {

        $this->friendsOfMineAndNotAccepted()->detach($user->id);
        $this->friendOfAndNotAccepted()->detach($user->id);

    }

    /**
     * @return mixed
     */
    public function mentions () {

        return $this->hasMany('Gomention\Mention', 'by_user_id')
            ->orWhere('to_user_id', $this->id)
            ->orderBy('id', 'desc')
            ->with('by_user','to_user');
    }

    public function mentionsByUser (User $_user) {

        return $this->hasMany('Gomention\Mention', 'by_user_id')
            ->where('to_user_id', $_user->id)
            ->orWhere(function ($query) use ($_user) {
                $query->where('by_user_id', $_user->id)
                      ->where('to_user_id', $this->id);
            })
            ->orderBy('id', 'desc')
            ->with('by_user','to_user');
    }

}

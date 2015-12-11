<?php

namespace Gomention\Repositories\Frontend\Mention;


use Gomention\Exceptions\GeneralException;
use Gomention\Mention;
use Gomention\User;
use Illuminate\Support\Facades\Auth;

/**
 * Class EloquentMentionRepository
 * @package Gomention\Repositories\Frontend\Mention
 */
class EloquentMentionRepository implements MentionContract {

    protected $user;

    function __construct()
    {
        $this->user = Auth::user();
    }


    /**
     * @return mixed
     */
    public function getMentions()
    {
        // TODO: Implement getMentions() method.
    }

    /**
     * @param $type
     * @param $to_user_id
     * @param array $data
     * @return mixed
     * @throws GeneralException
     */
    protected function mention($type, $to_user_id, Array $data)
    {
        //TODO: Data and arguments check

        if ($type == 'text') {
            $mention = new Mention([
                'type' => 'text',
                'by_user_id' => $this->user->id,
                'to_user_id' => $to_user_id,
                'data' => $data,
            ]);
        }

        if (isset($mention))
            return $this->user->mentions()->save($mention);

        throw new GeneralException('Error, can\'t add mention.');
    }

    /**
     * @param $to_user_id
     * @param array $data
     * @return mixed
     * @throws GeneralException
     */
    public function textMention($to_user_id, Array $data)
    {
        //TODO: Data and arguments check

        return $this->mention('text', $to_user_id, $data);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function linkMention($to_user_id, Array $data)
    {
        // TODO: Implement linkMention() method.
        return $this->mention('link', $to_user_id, $data);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function videoMention(Array $data)
    {
        // TODO: Implement videoMention() method.
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function photoMention(Array $data)
    {
        // TODO: Implement photoMention() method.
    }
}
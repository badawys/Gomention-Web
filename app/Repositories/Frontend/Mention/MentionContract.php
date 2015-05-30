<?php

namespace Gomention\Repositories\Frontend\Mention;

/**
 * Interface MentionContract
 * @package Gomention\Repositories\Frontend\Mention
 */
interface MentionContract {

    /**
     * @return mixed
     */
    public function getMentions();

    /**
     * @param $to_user_id
     * @param array $data
     * @return mixed
     */
    public function textMention($to_user_id, Array $data);

    /**
     * @param array $data
     * @return mixed
     */
    public function linkMention(Array $data);

    /**
     * @param array $data
     * @return mixed
     */
    public function videoMention(Array $data);

    /**
     * @param array $data
     * @return mixed
     */
    public function photoMention(Array $data);

}
<?php

namespace Gomention\Repositories\Frontend\Like;

/**
 * Interface MentionContract
 * @package Gomention\Repositories\Frontend\Mention
 */
interface LikeContract {

    public function toggleLike ($mention_id, $user_id);

}
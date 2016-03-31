<?php

namespace Gomention\Repositories\Frontend\Like;
use Gomention\Like;


/**
 * Class EloquentMentionRepository
 * @package Gomention\Repositories\Frontend\Mention
 */
class EloquentLikeRepository implements LikeContract {



    function __construct() {

    }

    /**
     * @param $mention_id
     * @param $user_id
     */
    public function toggleLike($mention_id, $user_id)
    {
        $record = Like::where('mention_id', $mention_id)->where('user_id', $user_id)->get();

        if($record->isEmpty()){

            $like = new Like([
                'mention_id' => $mention_id,
                'user_id' => $user_id
            ]);

            $like->save();

        } else {

            Like::where('mention_id', $mention_id)->where('user_id', $user_id)->delete();

        }
    }

}
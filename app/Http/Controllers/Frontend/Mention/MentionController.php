<?php

namespace Gomention\Http\Controllers\Frontend\Mention;

use Gomention\Mention;

use Gomention\Http\Controllers\Controller;
use Gomention\Repositories\Frontend\Like\LikeContract;

class MentionController extends Controller
{

    /**
     * @param $id
     */
    public function pin ($id) {
        //TODO
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete ($id) {
        if (\Request::ajax()){
            Mention::destroy($id);
            return json_decode('success');
        }
        return json_decode('error');
    }

    /**
     * @param $id
     */
    public function hide ($id) {
        //TODO
    }

    /**
     * @param $id
     */
    public function unhide ($id) {
        //TODO
    }

    public function toggleLike ($id, LikeContract $like) {

        if (true){

            $like->toggleLike($id, auth()->user()->id);

            return json_decode('success');
        }
        return json_decode('error');

    }

}

<?php

namespace Gomention\Http\Controllers\Frontend\Mention;

use Badawy\Embedly\Facades\Embedly;
use Gomention\MetaCache;
use Gomention\Repositories\Frontend\Friendship\FriendshipContract;
use Illuminate\Http\Request;

use Gomention\Http\Requests;
use Gomention\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Laracasts\Utilities\JavaScript\JavaScriptFacade;

class MentionThisController extends Controller
{
    public function start (Request $request) {

        $url = $request->input('url');

        // in case scheme relative URI is passed, e.g., //www.google.com/
        $_url = trim($url, '/');

        // If scheme not included, prepend it
        if (!preg_match('#^http(s)?://#', $_url)) {
            $_url = 'http://' . $_url;
        }

        $urlParts = parse_url($_url);

        // remove www
        $_url = preg_replace('/^www\./', '', $urlParts['host']);

        //re-build the URL without http:// or https:// and www
        unset($urlParts['scheme']);
        $urlParts['host'] = $_url;

        $url = implode('', $urlParts);

        //Check if URL is valid
        if (!preg_match('/^(?:https?:\/\/)?(?:[a-z0-9-]+\.)*((?:[a-z0-9-]+\.)[a-z]+)/',$url))
            return view('frontend.user.mention.mention_this.error')
                ->with(['error' => 'Not Valid URL']);


        //Check for cached version of meta data
        $cached = MetaCache::where('url', $url)->first();

        if ($cached) {

            if ($cached->updated_at < (new \Carbon\Carbon())->subDays(7)) {

                // Cached data is too old (Older than a week)
                // Update cache with fresh version

                $data = Embedly::extract($url,[
                    'maxwidth' => '554',
                    'secure ' => 'true',
                    'luxe ' => '1'
                ]);

                if (!$data->error) {
                    $cached = $cached->update([
                        'user_id' => Auth::user()->id,
                        'data' => $data
                    ]);
                } else
                    return view('frontend.user.mention.mention_this.error')
                        ->with(['error' => 'Error on getting data from URL']);
            }

        } else {

            //No cached version
            //Get meta data and cache it

            $data = Embedly::extract($url,[
                'maxwidth' => '554',
                'secure ' => 'true',
                'luxe ' => '1'
            ]);

            if (!$data->error) {
                $cached = MetaCache::create([
                    'user_id' => Auth::user()->id,
                    'url' => $url,
                    'data' => $data
                ]);
            } else
                return view('frontend.user.mention.mention_this.error')
                    ->with(['error' => 'Error on getting data from URL']);
        }

        //Goto type page
        $mentionTypes = $this->mentionTypes($cached);
        if (count($mentionTypes) == 1) {
            if($mentionTypes[0] == 'link')
                return redirect()->route('mention.this.link', [$cached->id]);
            if($mentionTypes[0] == 'video')
                return redirect()->route('mention.this.video', [$cached->id]);
            if($mentionTypes[0] == 'photo')
                return redirect()->route('mention.this.photo', [$cached->id]);
            if($mentionTypes[0] == 'article')
                return redirect()->route('mention.this.article', [$cached->id]);
        }

        //view page with buttons of all available types with links to its controller
        return view('frontend.user.mention.mention_this.start')
            ->with('types', $mentionTypes);
    }



    public function link ($cache_id) {

        //Get the cached version
        $cached = MetaCache::find($cache_id);

        //Get the final mention data
        $data = $this->mentionArray($cached->toArray(),'link');

        $data['cache_id'] = $cache_id;

        //store data into the session (to use it in friends page)
        session()->flash('mentionData', $data);

        //Goto friends page
        return redirect()->route('mention.this.friends', ['link',$cached->id]);
    }

    public function video ($cache_id) {

        /**
         * TODO:
         *  1- Make thr final mention's data array
         *  2- pass the array to friends page
         */

        return view('frontend.user.mention.mention_this.video');
    }

    public function photo ($cache_id) {

        /**
         * TODO:
         *  1- if there is only 1 photo goto step (3)
         *  2- if there is more than 1 photo show photos to select one
         *  1- Make thr final mention's data array
         *  2- pass the array to friends page
         */

        return view('frontend.user.mention.mention_this.photo');
    }

    public function article ($cache_id) {

        /**
         * TODO:
         *  1- Make thr final mention's data array
         *  2- pass the array to friends page
         */

        return view('frontend.user.mention.mention_this.article');
    }



    public function friends ($cache_id, $type, FriendshipContract $friends) {

        /**
         * TODO:
         *  Mention friends
         */

        if (!session('mentionData'))
            return view('frontend.user.mention.mention_this.error')
                ->with(['error' => 'Error!']);

        $friendsArray = [];

        foreach ($friends->getAllFriends() as $friend) {
            $friendsArray[] = ['id' => $friend->id, 'text' => $friend->name];
        }

        JavaScriptFacade::put([
            'friendsArray' => $friendsArray
        ]);

        return view('frontend.user.mention.mention_this.friends')
            ->with('friends',$friends)
            ->with('data', session('mentionData'));
    }

    /**
     * @param array $data
     * @param $type
     * @return array
     */
    private function mentionArray(Array $data, $type){

        $mentionArray = [];

        if ($type == 'link') {

            $mentionArray['provider_url'] = $data['data']['provider_url'];
            $mentionArray['favicon_url'] = $data['data']['favicon_url'];
            $mentionArray['title'] = $data['data']['title'];
            $mentionArray['description'] = $data['data']['description'];
            $mentionArray['url'] = $data['data']['url'];

        }

        return $mentionArray;
    }

    /**
     * @param MetaCache $data
     * @return array
     */
    private function mentionTypes($data) {

        $mentionTypes = [];

        $mentionTypes[] = 'link';

        return $mentionTypes;
    }
}

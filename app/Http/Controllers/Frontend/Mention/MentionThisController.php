<?php

namespace Gomention\Http\Controllers\Frontend\Mention;

use Badawy\Embedly\Facades\Embedly;
use Gomention\MetaCache;
use Gomention\Repositories\Frontend\Friendship\FriendshipContract;
use Gomention\Repositories\Frontend\Mention\MentionContract;
use Illuminate\Http\Request;

use Gomention\Http\Requests;
use Gomention\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laracasts\Utilities\JavaScript\JavaScriptFacade;

class MentionThisController extends Controller
{
    /**
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function start (Request $request) {

        $url = $request->input('url');

        if (!$url)
            return view('frontend.user.mention.mention_this.error')
                ->with(['error' => 'No URL']);

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

        if(isset($urlParts['query']))
            $urlParts['query'] = '?' . $urlParts['query'];

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
                    'luxe' => '1'
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
                'luxe' => '1'
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
        $mentionTypes = $this->mentionTypes($cached->data);

        if (count($mentionTypes) == 1) {
            return redirect()->route('mention.this.settings', [$mentionTypes[0], $cached->id]);
        }

        //view page with buttons of all available types with links to its controller
        return view('frontend.user.mention.mention_this.start')
            ->with('mentionTypes', $mentionTypes)
            ->with('id', $cached->id);
    }


    /**
     * @param $cache_id
     * @param $type
     * @param FriendshipContract $friends
     * @return mixed
     */
    public function settings ($type, $cache_id, FriendshipContract $friends) {

        //Get the cached version
        $cached = MetaCache::find($cache_id);

        $data = $this->mentionArray($cached,$type);

        $data['cache_id'] = $cache_id;


        $friendsArray = [];

        foreach ($friends->getAllFriends() as $friend) {
            $friendsArray[] = ['id' => $friend->id, 'text' => $friend->name];
        }

        $friendsArray[] = ['id' => auth()->user()->id, 'text' => "Me"]; //add current user to array

        JavaScriptFacade::put([
            'friendsArray' => $friendsArray
        ]);

        return view('frontend.user.mention.mention_this.settings')
            ->with('friends',$friends)
            ->with('data', $data)
            ->with('type', $type);
    }

    /**
     * @param Requests\Frontend\User\MentionThisRequest $request
     * @param MentionContract $mention
     * @return $this
     */
    public function mention (Requests\Frontend\User\MentionThisRequest $request, MentionContract $mention) {

        $mentionData = json_decode($request->input('mentionData'),1);
        $mentionData['text'] = $request->input('text');
        $mentionType = $request->input('type');

        foreach($request->input('friends') as $friend_id) {
            $mention->mention($mentionType, $friend_id, $mentionData);
        }

        return view('frontend.user.mention.mention_this.error')
            ->with(['error' => 'Done!']);
    }

    /**
     * @param array $data
     * @param $type
     * @return array
     */
    private function mentionArray($data, $type){

        $mentionArray = [];

        if ($type == 'link') {

            $mentionArray['provider_url'] = $data->data['provider_url'];
            $mentionArray['favicon_url'] = $data->data['favicon_url'];
            $mentionArray['title'] = $data->data['title'];
            $mentionArray['description'] = $data->data['description'];
            $mentionArray['url'] = $data->data['url'];

        } elseif ($type == 'video') {
            $mentionArray['provider_url'] = $data->data['provider_url'];
            $mentionArray['favicon_url'] = $data->data['favicon_url'];
            $mentionArray['title'] = $data->data['title'];
            $mentionArray['description'] = $data->data['description'];
            $mentionArray['url'] = $data->data['url'];
            $mentionArray['embed'] = $data->data['media']['html'];

        } elseif ($type == 'photo') {
            $mentionArray['provider_url'] = $data->data['provider_url'];
            $mentionArray['url'] = $data->data['url'];
            }

        return $mentionArray;
    }

    /**
     * @param MetaCache $data
     * @return array
     */
    private function mentionTypes($data) {

        $mentionTypes = [];

        if($data['type'] == 'html')
            $mentionTypes[] = 'link';

        if (isset($data['media']) && isset($data['media']['type']) && $data['media']['type'] == 'video')
            $mentionTypes[] = 'video';

        if ($data['type'] == 'image')
            $mentionTypes[] = 'photo';


        return $mentionTypes;
    }
}

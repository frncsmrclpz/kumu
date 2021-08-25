<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Kumu;
use App\Models\User;
use Cache;

class UsersController extends Controller
{

    const KEY_VALUE = 'KUMU_';

    public $loginAfterSignUp = true;

    public function __construct() {
        Redis::Connection();
    }

    /**
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // check if user exists
        $user = $request->user;
        $findUser = User::where('name', $user)->get();
        $res = json_decode($findUser,true)[0];

        // Key use for redis
        $key = self::KEY_VALUE.$res['name'];

        // Get cache and response data from redis
        $cachedUser = Redis::get($key);
        if(!empty($cachedUser)) {
            $decodedCached = json_decode($cachedUser,true);
            return response()->json($decodedCached);
        }

        if(!empty($res) && empty($decodedCached)) {
            $usernames=$request->usernames;
            $maxCount=9;
            $i=0;
            sort($usernames);

            foreach($usernames as $username) {
                $url = "https://api.github.com/users/{$username}";
        
                $response   = Http::withOptions([ //use this method
                    'verify'     => false, //This key and value in this method
                ])->withHeaders([
                    'Content-Type'  => 'application/json',
                    'Accept'        => 'application/json',
                    'Authorization' => 'token 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'
                ])->get($url);
                $output=json_decode($response,true);

                if(isset($output['message'])) {
                    if ($output['message'] == 'Not Found') { continue; }
                }

                $outputResponse[] = [
                    'Name' => $output['login'],
                    'Login' => $output['login'],
                    'Company' => $output['company'],
                    'Number of Followers' => $output['followers'],
                    'Number of public repositories' => $output['public_repos'],
                    'Average No. of Followers per Repository' => (int)round($output['followers']/$output['public_repos'])
                ];

                if($i++ == $maxCount) break;

            }


            // set redis with unique key
            Redis::set($key, json_encode($outputResponse));

            return response()->json($outputResponse);

        } else {
            return response()->json(['Message' => 'User not Found']);
        }        
        
    }
}


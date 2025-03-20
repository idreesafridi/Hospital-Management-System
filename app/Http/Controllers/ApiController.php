<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function apiSearch()
    {
        return view('Api.practice');
    }

    public function searchApi(Request $request)
    {
        $request->validate([
            'query' => 'required|string|max:255',
        ]);

        $searchQuery = $request->input('query');
        $response = $this->callInstagramApi($searchQuery);
        // return $response;
        return view('Api.search_result', ['results' => $response]);
    }

    private function callInstagramApi($searchQuery)
    {
        $curl = curl_init();
        $encodedQuery = urlencode($searchQuery);

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://instagram-scraper-api2.p.rapidapi.com/v1/search_users?search_query=" . $encodedQuery,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "x-rapidapi-host: instagram-scraper-api2.p.rapidapi.com",
                "x-rapidapi-key: b468a6b892mshb55984c2be7969dp182b76jsnfb81de9eb71c"
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return "cURL Error #:" . $err;
        } else {
            return json_decode($response, true);
        }
    }

    public function Userdetail($id)
    {
        $user = InstagramDetail::where('user_id', $id)->first();
        
        if ($user) {
            return view('Api.practice_detail', ['user' => $user]);
        }
    
        // Initialize cURL
        $curl = curl_init();
    
        curl_setopt_array($curl, [
            CURLOPT_URL => "https://instagram-scraper-api2.p.rapidapi.com/v1/info?username_or_id_or_url=" . urlencode($id),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "x-rapidapi-host: instagram-scraper-api2.p.rapidapi.com",
                "x-rapidapi-key: b468a6b892mshb55984c2be7969dp182b76jsnfb81de9eb71c"
            ],
        ]);
    
        $response = curl_exec($curl);
        $err = curl_error($curl);
    
        curl_close($curl);
    
        if ($err) {
            return response()->json(['error' => "cURL Error #: " . $err], 500);
        } else {
            $data = json_decode($response, true);
    
            if (json_last_error() !== JSON_ERROR_NONE) {
                return response()->json(['error' => 'Invalid JSON response'], 500);
            }
    
            if (!isset($data['data'])) {
                return response()->json(['error' => 'User  data not found in the response'], 404);
            }
    
            $userData = $data['data'];
           return $userData;
            $userToSave = [
                'user_id' => $userData['id'] ?? null, 
                'username' => $userData['username'] ?? null,
                'full_name' => $userData['full_name'] ?? null,
                'profile_picture' => $userData['profile_pic_url'] ?? null,
                'bio' => $userData['biography'] ?? null,
                'followers_count' => $userData['follower_count'] ?? null,
                'following_count' => $userData['following_count'] ?? null,
            ];
    
            $user = InstagramDetail::updateOrCreate(
                ['user_id' => $userToSave['user_id']],
                $userToSave 
            );
    
            return view('Api.practice_detail', ['user' => $user]);
        }
    }

    public function searchYoutubeApi(Request $request)
    {
        $request->validate([
            'query' => 'required|string|max:255',
        ]);

        $searchQuery1 = $request->input('query');
        $response = $this->callYoutubeApi($searchQuery1);
        //  return $response;
        return view('Api.search_youtube', ['results' =>  $response['data']]);
    }

    private function callYoutubeApi($searchQuery1)
    {
        $curl = curl_init();
        $encodedQuery = urlencode($searchQuery1);
    
        curl_setopt_array($curl, [
            CURLOPT_URL => "https://yt-api.p.rapidapi.com/trending?geo=US&query=" . $encodedQuery,  // Corrected URL format
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "x-rapidapi-host: yt-api.p.rapidapi.com",
                "x-rapidapi-key: b8dfc62493msh2c86b5f2df81c72p1cc58ejsn786b7021e98a"
            ],
        ]);
    
        $response = curl_exec($curl);
        $err = curl_error($curl);
    
        curl_close($curl);
    
        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            //  echo $response;
            return json_decode($response, true);
        }
    }

    public function searchStreamApi(Request $request)
    {
        $curl = curl_init();
    
        curl_setopt_array($curl, [
            CURLOPT_URL => "https://all-sport-live-stream.p.rapidapi.com/api/all-streams",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "x-rapidapi-host: all-sport-live-stream.p.rapidapi.com",
                "x-rapidapi-key: b8dfc62493msh2c86b5f2df81c72p1cc58ejsn786b7021e98a"
            ],
        ]);
    
        $response = curl_exec($curl);
        $err = curl_error($curl);
    
        curl_close($curl);
    
        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $decodedResponse = json_decode($response, true);
            
                return view('Api.search_stream', ['streams' => $decodedResponse]);
            }
        
    }
    
    

  
}

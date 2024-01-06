<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ConnectException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use App\Models\Gitinfo;

class UserController extends Controller
{
    public function fetchData(){
    	$response = "";

    	try{
	        $client = new Client();
			$response = $client->request('GET', 'https://api.github.com/users/tushar259/repos');
			$response = json_decode($response->getBody()->getContents());

			$this->checkIfTableExist();
			Gitinfo::insertIntoTable($response);
		}
		catch(ConnectException $ce){
			$checkIfCreated = $this->checkIfTableExist();
			$response = Gitinfo::getGitInfos();	
			
		}
		catch(RequestException $re){
			$checkIfCreated = $this->checkIfTableExist();
			$response = Gitinfo::getGitInfos();
			
		}

        return view('welcome', ['response' => $response]);

    }

    public function postData(Request $request){
    	$status = "";
    	$repName = $request->input("repName");
    	$repDesc = $request->input("repDesc");
    	$gitToken = $request->input("gitToken");
    	
		$repoData = [
		    'description' => $repDesc,
		    'private' => false,
		];
		
		try{
	    	$client = new Client([
			    'base_uri' => 'https://api.github.com/user/repos',
			    'headers' => [
			        'Authorization' => 'token '.$gitToken,
			        'Accept' => 'application/vnd.github.v3+json',
			    ],
			]);


			$response = $client->post('https://api.github.com/user/repos', [
			    'json' => array_merge(['name' => $repName], $repoData),
			]);


			$status = $response->getStatusCode();
		}
		catch(ConnectException $ce){
			$status = "Failed internet connection!";
		}
		catch(RequestException $re){
			$status = "Failed to send request!";
		}

		if($status == 201){
			return response()->json(['success' => true, 'message' => 'Repository created successfully.']);
		}
		else{
			return response()->json(['success' => false, 'message' => $status]);
		}
		
    }

    public function checkIfTableExist(){
    	if(!Schema::hasTable('gitinfos')){
    		Schema::create('gitinfos', function (Blueprint $table) {
	            $table->id();
	            $table->string('name');
	            $table->string('html_url');
	            $table->string('size');
	            $table->string('language');
	            $table->timestamps();
	        });
    	}
    	return true;
    }

}

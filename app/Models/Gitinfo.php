<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Gitinfo extends Model
{
    // use HasFactory;
    protected $table = 'gitinfos';

    public static function getGitInfos()
    {
        return self::all();
    }

    public static function insertIntoTable($response){
    	foreach ($response as $value) {
    		$currentDate = Carbon::now();
    		$data = self::where('name', $value->name)->first();
    		if($data){
    			$data->html_url = $value->html_url;
    			$data->size = $value->size;
    			$data->language = $value->language;
    			$data->updated_at = $currentDate;
    			$data->save();
    		}
    		else{
	    		self::insert([
				    'name' => $value->name,
				    'html_url' => $value->html_url,
	                'size' => $value->size,
	                'language' => $value->language,
	                'created_at' => $currentDate,
	                'updated_at' => $currentDate
				]);
    		}
    	}

    	return true;
    }

}

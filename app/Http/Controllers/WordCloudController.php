<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\WordCloudResource;
use App\Tools\Handler;
use App\Tools\WebScraper;

class WordCloudController extends Controller
{
    public function generate(Request $request):WordCloudResource
    {
        $words = "";
        if(filter_var($request->value, FILTER_VALIDATE_URL)) {
            $scraper = new WebScraper($request->value);
            $words = $scraper->webScraper();
            $words = implode(" ", $words);
        }
        else {
            $words = $request->value;
        }

        $result = new Handler($words);
        $result = $result->wordCounter();
        return new WordCloudResource($result);
    }

    public function download(Request $request)
    {
        // 
    }
}

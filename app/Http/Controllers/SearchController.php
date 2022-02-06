<?php

namespace App\Http\Controllers;

use App\Dtos\ShowListDTO;
use App\Http\Requests\SearchRequest;
use App\Http\Resources\ProgramCollection;
use Illuminate\Support\Facades\Http;

class SearchController extends Controller
{
    /**
     * @var string
     */
    protected $apiTV = 'https://api.tvmaze.com/';

    /**
     * Returns search result from the api
     *
     * @throws \Spatie\DataTransferObject\Exceptions\UnknownProperties
     */
    public function index(SearchRequest $request)
    {
        $route = $this->apiTV . '/search/shows';
        $query = $request->query('q', '');

        $results = Http::get($route, [
            'q' => $query
        ]);

        if($results->ok()){

            $matchedPrograms = $this->filterSearchResult($results, $query);

            return new ProgramCollection($matchedPrograms);
        }

        return response()->json(['message' => 'Internal Server Error'], 500);

    }

    /**
     * Returns value after applying non-case sensitive and non-typo filter
     *
     * @param $results
     * @return \Illuminate\Support\Collection
     * @throws \Spatie\DataTransferObject\Exceptions\UnknownProperties
     */
    protected function filterSearchResult($results, $query)
    {

        $showListCollection = collect();
        foreach ($results->json() as $result) {
            $showList = new ShowListDTO($result);
            $showListCollection->push($showList);
        }

        $matchedPrograms = $showListCollection->filter(function($showList) use ($query){
            return strpos(strtolower($showList->show->name), strtolower($query)) === 0;
        });

       return $matchedPrograms;
    }
}

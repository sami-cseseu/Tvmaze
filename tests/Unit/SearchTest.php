<?php

namespace Tests\Unit;

use App\Http\Controllers\SearchController;
use PHPUnit\Framework\TestCase;

class SearchTest extends TestCase
{
    /**
     * Test search filter works correctly
     *
     * @return void
     */
    public function testFilterWorksCorrectly()
    {
        $showListJson = '[{"score":0.90626645,"show":{"id":565,"url":"https://www.tvmaze.com/shows/565/deadwood","name":"Deadwood","type":"Scripted","language":"English","genres":["Drama","Crime","Western"],"status":"Ended","runtime":60,"averageRuntime":60,"premiered":"2004-03-21","ended":"2019-05-31","officialSite":"https://www.hbo.com/deadwood","schedule":{"time":"21:00","days":["Sunday"]},"rating":{"average":9.1},"weight":95,"network":{"id":8,"name":"HBO","country":{"name":"United States","code":"US","timezone":"America/New_York"}},"webChannel":null,"dvdCountry":null,"externals":{"tvrage":3267,"thetvdb":72023,"imdb":"tt0348914"},"image":{"medium":"https://static.tvmaze.com/uploads/images/medium_portrait/4/11724.jpg","original":"https://static.tvmaze.com/uploads/images/original_untouched/4/11724.jpg"},"summary":"<p>The outlaw camp of <b>Deadwood</b> marches slowly towards civilization, facing its first elections. But the power struggles continue over everything in Deadwood—influence, money, and whores—as the founding camp members form strategic alliances to face down the threat of a powerful newcomer, seeking to remake Deadwood in his image.</p>","updated":1610995474,"_links":{"self":{"href":"https://api.tvmaze.com/shows/565"},"previousepisode":{"href":"https://api.tvmaze.com/episodes/1607324"}}}},{"score":0.37608457,"show":{"id":59186,"url":"https://www.tvmaze.com/shows/59186/undeadwood","name":"Deadwood2","type":"Reality","language":"English","genres":[],"status":"Ended","runtime":60,"averageRuntime":60,"premiered":"2019-10-18","ended":"2019-11-08","officialSite":"https://critrole.com/shows/undeadwood/","schedule":{"time":"","days":["Friday"]},"rating":{"average":null},"weight":14,"network":null,"webChannel":{"id":21,"name":"YouTube","country":null,"officialSite":"https://www.youtube.com"},"dvdCountry":null,"externals":{"tvrage":null,"thetvdb":370814,"imdb":"tt12053334"},"image":{"medium":"https://static.tvmaze.com/uploads/images/medium_portrait/378/947342.jpg","original":"https://static.tvmaze.com/uploads/images/original_untouched/378/947342.jpg"},"summary":"<p>In the not-so-sleepy town of Deadwood, where rumors of supernatural happenings and illegal mining activity have come to a head, five strangers to each other are hired to investigate supernatural rumors by a local community pillar, fight an evil theyve never encountered — and will fight to save their very souls in the process.</p>","updated":1643249081,"_links":{"self":{"href":"https://api.tvmaze.com/shows/59186"},"previousepisode":{"href":"https://api.tvmaze.com/episodes/2223637"}}}},{"score":0.35756204,"show":{"id":2514,"url":"https://www.tvmaze.com/shows/2514/redwood-kings","name":"Redwood Kings","type":"Reality","language":"English","genres":[],"status":"Ended","runtime":60,"averageRuntime":64,"premiered":"2014-08-01","ended":"2015-09-11","officialSite":"http://www.animalplanet.com/tv-shows/redwood-kings/","schedule":{"time":"21:00","days":["Friday"]},"rating":{"average":null},"weight":41,"network":{"id":92,"name":"Animal Planet","country":{"name":"United States","code":"US","timezone":"America/New_York"}},"webChannel":null,"dvdCountry":null,"externals":{"tvrage":39106,"thetvdb":276663,"imdb":null},"image":{"medium":"https://static.tvmaze.com/uploads/images/medium_portrait/330/826524.jpg","original":"https://static.tvmaze.com/uploads/images/original_untouched/330/826524.jpg"},"summary":"<p><i><b>\"Redwood Kings\"</b> is an Animal Planet reality show that follows fraternal twins, Ron and John Daniels as they run their tree house and theming business, Daniels Wood Land.</i></p>","updated":1624032283,"_links":{"self":{"href":"https://api.tvmaze.com/shows/2514"},"previousepisode":{"href":"https://api.tvmaze.com/episodes/203937"}}}}]';

        //Creates a reflection class to call protected method
        $searchController = new SearchController;
        $searchControllerReflection = new \ReflectionClass(get_class($searchController));
        $filterSearchResultMethod = $searchControllerReflection->getMethod('filterSearchResult');
        $filterSearchResultMethod->setAccessible(true);
        $showListDecoded = json_decode($showListJson, true);
        $results = $filterSearchResultMethod->invokeArgs($searchController, [$showListDecoded, 'deadwood']);

        //Should take Deadwood and Deadwood2
        $this->assertEquals(2, count($results));
    }
}

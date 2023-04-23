<?php
namespace tests\Feature;

use PHPUnit\Framework\TestCase;

class HomeControllerTest extends TestCase
{
    
    private $siteUrl;
    public function __construct()
    {
        
        $this->siteUrl = getenv('SITE_URL');
    }

    /** @test */
    public function index_league()
    {
        
        return $this->get($this->siteUrl . "/leagues/index")->assertStatus(200);
        
    }

    /** @test */
    public function indexTeams()
    {
        
        //$this->json('get', $baseUrl . "/teams/index")
        //->assertStatus(200);
    }
}

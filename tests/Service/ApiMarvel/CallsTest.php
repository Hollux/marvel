<?php

namespace App\Tests\Service\ApiMarvel;

use PHPUnit\Framework\TestCase;
use App\Service\ApiMarvel\Calls;

class CallsTest extends TestCase
{
    public function testConstUriVerif(){

            $Calls = new Calls();

            $this->AssertEquals($Calls::Base_URI, "https://gateway.marvel.com/v1/public/");
        }

        public function testConstValidParam(){

            $Calls = new Calls();

            $this->AssertTrue(in_array("name", $Calls::ValidParam) );
            $this->AssertTrue(in_array("nameStartsWith", $Calls::ValidParam));
            $this->AssertTrue(in_array("modifiedSince", $Calls::ValidParam));
            $this->AssertTrue(in_array("comics", $Calls::ValidParam));
            $this->AssertTrue(in_array("series", $Calls::ValidParam));
            $this->AssertTrue(in_array("events", $Calls::ValidParam));
            $this->AssertTrue(in_array("stories", $Calls::ValidParam));
            $this->AssertTrue(in_array("orderBy", $Calls::ValidParam));
            $this->AssertTrue(in_array("limit", $Calls::ValidParam));
            $this->AssertTrue(in_array("offset", $Calls::ValidParam));

            $this->AssertFalse(in_array("test", $Calls::ValidParam));


            $this->AssertEquals(count($Calls::ValidParam), 10);

        }

        public function testExplodeOptions() {
            $Calls = new Calls();

            $optionTest = ['limit' => 20];
            $test = $Calls->explodeOptions($optionTest);

            $this->AssertEquals($test, "&limit=20");

            $optionTest['offset'] = 20;
            $test = $Calls->explodeOptions($optionTest);

            $this->AssertEquals($test, "&limit=20&offset=20");

            $optionTest['rien'] = 20;
            $test = $Calls->explodeOptions($optionTest);

            $this->AssertEquals($test, "&limit=20&offset=20");
        }

        public function testBasicParam(){

        }




}
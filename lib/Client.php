<?php
namespace Klaviyo;

use GuzzleHttp\Client as GuzzleClient;
use Klaviyo\ApiException;
use Klaviyo\Configuration;

use Klaviyo\API\TrackIdentifyApi;
use Klaviyo\API\MetricsApi;
use Klaviyo\API\ProfilesApi;
use Klaviyo\API\ListsSegmentsApi;
use Klaviyo\API\DataPrivacyApi;
use Klaviyo\API\CampaignsApi;
use Klaviyo\API\TemplatesApi;


class Client {
    public $api_key = "API_KEY";
    public $subclient_names = ['TrackIdentify', 'Metrics', 'Profiles', 'ListsSegments', 'DataPrivacy', 'Campaigns', 'Templates'];
    public $wait_seconds;
    public $num_retries;


    public function __construct($api_key, $num_retries = 3, $wait_seconds = 3) {

        if (gettype($num_retries) == 'NULL'){
            $num_retries = 3;
        } 

        if (gettype($wait_seconds) == 'NULL'){
            $wait_seconds = 3;
        } 

        $this->api_key = $api_key;
        $this->num_retries = $num_retries;
        $this->wait_seconds = $wait_seconds;

        $this->config = clone Configuration::getDefaultConfiguration();
        $this->config->setApiKey('api_key', $this->api_key);

        foreach ($this->subclient_names as $subclient_name) {
            eval("\$api_instance = new Klaviyo\API\\${subclient_name}Api(new GuzzleHttp\Client(),\$this->config);");
            
            $this->$subclient_name = new Subclient(
                $api_instance,
                $wait_seconds = 3,
                $num_retries = 3,
            );
        }
    }
}
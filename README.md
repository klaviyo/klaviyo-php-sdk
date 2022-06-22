# Klaviyo PHP SDK

- SDK version: 1.0.2.20220329

## Helpful Resources

- [API Reference](https://developers.klaviyo.com/en/reference/api-overview)
- [API Guides](https://developers.klaviyo.com/en/docs)
- [Postman Workspace](https://www.postman.com/klaviyo/workspace/klaviyo-developers)

## Design & Approach

This SDK is a thin wrapper around our API. See our API Reference for full documentation on API behavior.

This SDK mirrors the organization and naming convention of the above language-agnostic resources, with a few namespace changes to conform to PHP idioms (details in Appendix).

## Organization

This SDK is organized into the following resources:



- Campaigns



- DataPrivacy



- ListsSegments



- Metrics



- Profiles



- Templates



- TrackIdentify



# Installation

You can install this package using either [Packagist](https://packagist.org/packages/klaviyo/sdk), or the source code.

## Option 1: Packagist

You can install this library using Packagist.

If you have composer installed, you can run: `composer require klaviyo/sdk`

## Option 2: Source code

You can also install this library directly from source code, without using the Packagist package, as follows:

1. cloning this repo
2. running `composer update` (within the repo)

# Usage Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

use Klaviyo\Client;

$client = new Client(
    'YOUR_API_KEY', 
    $num_retries = 3, 
    $wait_seconds = 3);

$response = $client->Metrics->getMetrics();
```

# Retry behavior

* The SDK retries on resolvable errors, namely: rate limits (common) and server errors on Klaviyo's end (rare).
* The keyword arguments in the example above define retry behavior
  * `wait_seconds` denotes how long to wait per retry, in *seconds*
  * If you wish to disable retries, set `$num_retries = 0`
  * the example is populated with the default values
* non-resolvable errors and resolvable errors which have timed out throw an `ApiException`, detailed below.

# Error Handling

This SDK throws an `ApiException` error when the server returns a non resolvable response, or a resolvable non-`2XX` response times out. 

If you'd like to extend error handling beyond what the SDK supports natively, you can use the following methods to retrieve the corresponding attributes from the `ApiException` object:

* `getCode() : int`
* `getMessage() : str`
* `getReponseBody() : bytes`
* `getResponseHeaders() : string[]`

For example:

```php
try { 
  $client.Metrics.getMetrics();
} catch (Exception $e) {
  if ($e->getCode() == SOME_INTEGER) {
    doSomething();
  }
}
```

# Comprehensive list of Operations & Parameters

_**NOTE:**_
- Organization: Resource groups and functions are listed in alphabetical order, first by Resource name, then by **OpenAPI Summary**. Operation summaries are those listed in the right side bar of the [API Reference](https://developers.klaviyo.com/en/reference/track-post). These summaries link directly to the corresponding section of the API reference.
- For example values / data types, as well as whether parameters are required/optional, please reference the corresponding API Reference link.
- Some keyword args are required for the API call to succeed, the API docs above are the source of truth regarding which keyword args are required.
- Keyword args are not included in the sample SDK calls; instead, where applicable, they are included as comments above each SDK call.
- JSON payloads should be passed in as associative arrays
- A strange quirk of PHP is that default/optional arguments must be passed in in order, and MUST be included and set as `null`, at least up to the last default value you wish to use. 
  - For example, if a given function has the following optional parameters `someFunction($a=1, $b=2, $c=3)`, and you wish to only set `$b`, you MUST pass in `someFunction($a=null, $b=$YOUR_VALUE)`
  - Otherwise, if you pass in something such as `someFunction($b=$YOUR_VALUE)`, PHP will actually assign the `$YOUR_VALUE` to parameter `$a`, which is wrong.





## Campaigns

#### [Cancel a Campaign](https://developers.klaviyo.com/en/reference/cancel-campaign)

```php
## Positional Arguments

# $campaign_id | string


client->Campaigns->cancelCampaign($campaign_id);
```





#### [Clone a Campaign](https://developers.klaviyo.com/en/reference/clone-campaign)

```php
## Positional Arguments

# $campaign_id | string
# $name | string
# $list_id | string


client->Campaigns->cloneCampaign($campaign_id, $name, $list_id);
```





#### [Create New Campaign](https://developers.klaviyo.com/en/reference/create-campaign)

```php
## Positional Arguments

# $list_id | string
# $template_id | string
# $from_email | string
# $from_name | string
# $subject | string

## Keyword Arguments

# $name | string
# $use_smart_sending | bool
# $add_google_analytics | bool

client->Campaigns->createCampaign($list_id, $template_id, $from_email, $from_name, $subject);
```





#### [Get Campaign Info](https://developers.klaviyo.com/en/reference/get-campaign-info)

```php
## Positional Arguments

# $campaign_id | string


client->Campaigns->getCampaignInfo($campaign_id);
```





#### [Get Campaign Recipients](https://developers.klaviyo.com/en/reference/get-campaign-recipients)

```php
## Positional Arguments

# $campaign_id | string

## Keyword Arguments

# $count | int
# $sort | string
# $offset | string

client->Campaigns->getCampaignRecipients($campaign_id);
```





#### [Get Campaigns](https://developers.klaviyo.com/en/reference/get-campaigns)

```php

## Keyword Arguments

# $page | int
# $count | int

client->Campaigns->getCampaigns();
```





#### [Schedule a Campaign](https://developers.klaviyo.com/en/reference/schedule-campaign)

```php
## Positional Arguments

# $campaign_id | string
# $send_time | string


client->Campaigns->scheduleCampaign($campaign_id, $send_time);
```





#### [Send a Campaign Immediately](https://developers.klaviyo.com/en/reference/send-campaign)

```php
## Positional Arguments

# $campaign_id | string


client->Campaigns->sendCampaign($campaign_id);
```





#### [Update Campaign](https://developers.klaviyo.com/en/reference/update-campaign)

```php
## Positional Arguments

# $campaign_id | string

## Keyword Arguments

# $list_id | string
# $template_id | string
# $from_email | string
# $from_name | string
# $subject | string
# $name | string
# $use_smart_sending | bool
# $add_google_analytics | bool

client->Campaigns->updateCampaign($campaign_id);
```







## DataPrivacy

#### [Request a Deletion](https://developers.klaviyo.com/en/reference/request-deletion)

```php

## Keyword Arguments

# $body | array

client->DataPrivacy->requestDeletion();
```







## ListsSegments

#### [Add Members to a List](https://developers.klaviyo.com/en/reference/add-members)

```php
## Positional Arguments

# $list_id | string

## Keyword Arguments

# $body | array

client->ListsSegments->addMembers($list_id);
```





#### [Create List](https://developers.klaviyo.com/en/reference/create-list)

```php
## Positional Arguments

# $list_name | string


client->ListsSegments->createList($list_name);
```





#### [Delete List](https://developers.klaviyo.com/en/reference/delete-list)

```php
## Positional Arguments

# $list_id | string


client->ListsSegments->deleteList($list_id);
```





#### [Exclude Profile From All Email](https://developers.klaviyo.com/en/reference/exclude-globally)

```php
## Positional Arguments

# $email | string


client->ListsSegments->excludeGlobally($email);
```





#### [Get Global Exclusions & Unsubscribes](https://developers.klaviyo.com/en/reference/get-global-exclusions)

```php

## Keyword Arguments

# $reason | string
# $sort | string
# $count | int
# $page | int

client->ListsSegments->getGlobalExclusions();
```





#### [Get All Exclusions for a List](https://developers.klaviyo.com/en/reference/get-list-exclusions)

```php
## Positional Arguments

# $list_id | string

## Keyword Arguments

# $marker | int

client->ListsSegments->getListExclusions($list_id);
```





#### [Get List Info](https://developers.klaviyo.com/en/reference/get-list-info)

```php
## Positional Arguments

# $list_id | string


client->ListsSegments->getListInfo($list_id);
```





#### [Check if Profiles Are in a List](https://developers.klaviyo.com/en/reference/get-list-members)

```php
## Positional Arguments

# $list_id | string

## Keyword Arguments

# $body | array

client->ListsSegments->getListMembers($list_id);
```





#### [Check if Profiles Are in a List and not Suppressed](https://developers.klaviyo.com/en/reference/get-list-subscriptions)

```php
## Positional Arguments

# $list_id | string

## Keyword Arguments

# $body | array

client->ListsSegments->getListSubscriptions($list_id);
```





#### [Get Lists](https://developers.klaviyo.com/en/reference/get-lists)

```php


client->ListsSegments->getLists();
```





#### [Get List and Segment Members](https://developers.klaviyo.com/en/reference/get-members)

```php
## Positional Arguments

# $list_or_segment_id | string

## Keyword Arguments

# $marker | int

client->ListsSegments->getMembers($list_or_segment_id);
```





#### [Check if Profiles Are in a Segment](https://developers.klaviyo.com/en/reference/get-segment-members)

```php
## Positional Arguments

# $segment_id | string

## Keyword Arguments

# $body | array

client->ListsSegments->getSegmentMembers($segment_id);
```





#### [Remove Profiles From List](https://developers.klaviyo.com/en/reference/remove-members)

```php
## Positional Arguments

# $list_id | string

## Keyword Arguments

# $body | array

client->ListsSegments->removeMembers($list_id);
```





#### [Subscribe Profiles to List](https://developers.klaviyo.com/en/reference/subscribe)

```php
## Positional Arguments

# $list_id | string

## Keyword Arguments

# $body | array

client->ListsSegments->subscribe($list_id);
```





#### [Unsubscribe Profiles From List](https://developers.klaviyo.com/en/reference/unsubscribe)

```php
## Positional Arguments

# $list_id | string

## Keyword Arguments

# $body | array

client->ListsSegments->unsubscribe($list_id);
```





#### [Update List Name](https://developers.klaviyo.com/en/reference/update-list-name)

```php
## Positional Arguments

# $list_id | string
# $list_name | string


client->ListsSegments->updateListName($list_id, $list_name);
```







## Metrics

#### [Get Metrics Info](https://developers.klaviyo.com/en/reference/get-metrics)

```php

## Keyword Arguments

# $page | int
# $count | int

client->Metrics->getMetrics();
```





#### [Query Event Data](https://developers.klaviyo.com/en/reference/metric-export)

```php
## Positional Arguments

# $metric_id | string

## Keyword Arguments

# $start_date | string
# $end_date | string
# $unit | string
# $measurement | string
# $where | string
# $by | string
# $count | int

client->Metrics->metricExport($metric_id);
```





#### [Get Events for a Specific Metric](https://developers.klaviyo.com/en/reference/metric-timeline)

```php
## Positional Arguments

# $metric_id | string

## Keyword Arguments

# $since | string
# $count | int
# $sort | string

client->Metrics->metricTimeline($metric_id);
```





#### [Get Events for All Metrics](https://developers.klaviyo.com/en/reference/metrics-timeline)

```php

## Keyword Arguments

# $since | string
# $count | int
# $sort | string

client->Metrics->metricsTimeline();
```







## Profiles

#### [Exchange ID for Profile ID](https://developers.klaviyo.com/en/reference/exchange)

```php

## Keyword Arguments

# $body | array

client->Profiles->exchange();
```





#### [Get Profile](https://developers.klaviyo.com/en/reference/get-profile)

```php
## Positional Arguments

# $person_id | string


client->Profiles->getProfile($person_id);
```





#### [Get Profile ID](https://developers.klaviyo.com/en/reference/get-profile-id)

```php

## Keyword Arguments

# $email | string
# $phone_number | string
# $external_id | string

client->Profiles->getProfileId();
```





#### [Get Profile's Events for a Specific Metric](https://developers.klaviyo.com/en/reference/profile-metric-timeline)

```php
## Positional Arguments

# $person_id | string
# $metric_id | string

## Keyword Arguments

# $since | string
# $count | int
# $sort | string

client->Profiles->profileMetricTimeline($person_id, $metric_id);
```





#### [Get Profile's Events for all Metrics](https://developers.klaviyo.com/en/reference/profile-metrics-timeline)

```php
## Positional Arguments

# $person_id | string

## Keyword Arguments

# $since | string
# $count | int
# $sort | string

client->Profiles->profileMetricsTimeline($person_id);
```





#### [Update Profile](https://developers.klaviyo.com/en/reference/update-profile)

```php
## Positional Arguments

# $person_id | string

## Keyword Arguments

# $params | array&lt;string,mixed&gt;

client->Profiles->updateProfile($person_id);
```







## Templates

#### [Clone Template](https://developers.klaviyo.com/en/reference/clone-template)

```php
## Positional Arguments

# $template_id | string
# $name | string


client->Templates->cloneTemplate($template_id, $name);
```





#### [Create New Template](https://developers.klaviyo.com/en/reference/create-template)

```php
## Positional Arguments

# $name | string
# $html | string


client->Templates->createTemplate($name, $html);
```





#### [Delete Template](https://developers.klaviyo.com/en/reference/delete-template)

```php
## Positional Arguments

# $template_id | string


client->Templates->deleteTemplate($template_id);
```





#### [Get All Templates](https://developers.klaviyo.com/en/reference/get-templates)

```php

## Keyword Arguments

# $page | int
# $count | int

client->Templates->getTemplates();
```





#### [Render Template](https://developers.klaviyo.com/en/reference/render-template)

```php
## Positional Arguments

# $template_id | string

## Keyword Arguments

# $context | string

client->Templates->renderTemplate($template_id);
```





#### [Render and Send Template](https://developers.klaviyo.com/en/reference/send-template)

```php
## Positional Arguments

# $template_id | string
# $from_email | string
# $from_name | string
# $subject | string
# $to | string

## Keyword Arguments

# $context | string

client->Templates->sendTemplate($template_id, $from_email, $from_name, $subject, $to);
```





#### [Update Template](https://developers.klaviyo.com/en/reference/update-template)

```php
## Positional Arguments

# $template_id | string

## Keyword Arguments

# $name | string
# $html | string

client->Templates->updateTemplate($template_id);
```







## TrackIdentify

#### [Identify Profile (Legacy)](https://developers.klaviyo.com/en/reference/identify-get)

```php
## Positional Arguments

# $data | string


client->TrackIdentify->identifyGet($data);
```





#### [Identify Profile](https://developers.klaviyo.com/en/reference/identify-post)

```php
## Positional Arguments

# $data | string


client->TrackIdentify->identifyPost($data);
```





#### [Track Profile Activity (Legacy)](https://developers.klaviyo.com/en/reference/track-get)

```php
## Positional Arguments

# $data | string


client->TrackIdentify->trackGet($data);
```





#### [Track Profile Activity](https://developers.klaviyo.com/en/reference/track-post)

```php
## Positional Arguments

# $data | string


client->TrackIdentify->trackPost($data);
```






# Appendix

## Limitations

- The `api_key` is set at the global level: this means that if you manage multiple stores, you will need to run the code for each store in a different environment 

## Namespace

In the interest of making the SDK conform to PHP idioms, we made the following namespace changes *relative* to the language agnostic resources up top (API Docs, Guides, etc).

- non-alphanumeric symbols (spaces, dashes, underscore, ampersand etc) stripped from resource names (tags) and function names (operation IDs)
- Resource names and function names use camelCase
- NOTE: this does not apply to parameter names

For example:
* `Track & Identify` becomes `TrackIdentify`
* `get-campaigns` becomes `getCampaigns`
* `profile_id` *remains* unchanged

## Parameters & Arguments

The parameters follow the same naming conventions as the resource groups and operations.

We stick to the following convention for parameters/arguments

1. All parameters are passed as function args.
2. All optional params, as well as all Body and Form Data params (including required ones), are passed as keyword args.
3. All query and path params that are tagged as `required` in the docs are passed as positional args.
4. There is no need to pass in your private `api_key` for any operations, as it is defined upon client instantiation; public key is still required where noted for Track/Identify endpoints.
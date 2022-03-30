<?php
namespace Klaviyo;

class Subclient {

    public function __construct(
        $api_instance, 
        $wait_seconds = 3,
        $num_retries = 3,
        $retry_codes = [429,503,504]
    ) {
        $this->api_instance = $api_instance;
        $this->wait_seconds = $wait_seconds;
        $this->num_retries = $num_retries;
        $this->retry_codes = $retry_codes;
        $this->json_string_function_names = ['trackPost','identifyPost'];
        $this->base64_function_names = ['trackGet','identifyGet'];
    }

    public function __call($name, $args) {

        # to json string
        if (gettype(array_search($name,$this->json_string_function_names,$strict=True)) == "integer") {

            if (gettype($args[0]) == "array") {
                $args[0] = json_encode($args[0]);
            }
        }

        # to base64
        if (gettype(array_search($name,$this->base64_function_names,$strict=True)) == "integer") {

            if (gettype($args[0]) == "string") {

                json_decode($args[0], TRUE);

                if (json_last_error() == JSON_ERROR_NONE) {
                    $args[0] = base64_encode($args[0]);
                } 
            } else {
                $args[0] = base64_encode(json_encode($args[0]));
            }
        }


        $attempts = 0;
        
        do {

            try {
                $result = $this->api_instance->$name(...$args);
                return $result;
            } catch (Exception $e) {
                
                if ( ! in_array($e->getCode(),$this->retry_codes)) {
                    throw $e;
                }
                else {
                    echo "\nretrying...\n";
                    $attempts++;
                    sleep($this->wait_seconds);
                    continue;
    
                }
            }
        
            break;
        
        } while($attempts < ($this->num_retries));

        throw $e;
    }

}
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApiAdapter extends Model
{
    public $adapter;
    protected $credentials;

    public function __construct()
    {
        $this->credentials = [
            'credentials' => [
                'username' => getenv('JSON_API_USERNAME'),
                'password' => getenv('JSON_API_PASSWORD'),
                'token' => getenv('JSON_API_TOKEN')
            ]
        ];
        $this->adapter = new \GuzzleHttp\Client(['http_errors' => false]);
    }

    public function getWebsites(){
        $response = $this->adapter->request('POST', 'http://laravel-api:8012/api/all-websites', [
            'headers'  => ['content-type' => 'application/json', 'Accept' => 'application/json'],
            'body' => json_encode($this->credentials)
        ]);
        return $response->getBody();
    }
    public function getWebsitesByDomainId($domain_id){
        $body = $this->credentials;
        $body['website']['domain_id'] = $domain_id;
        $response = $this->adapter->request('POST', 'http://laravel-api:8012/api/get-website-by-domain-id', [
            'headers'  => ['content-type' => 'application/json', 'Accept' => 'application/json'],
            'body' => json_encode($body)
        ]);
        return $response->getBody();
    }
    public function getWebsiteBuilderUserByUsernameAndPassword($data){
            $body = $this->credentials;
            $body['website_builder_users']['username'] = $data['username'];
            $body['website_builder_users']['password'] = $data['password'];
            $response = $this->adapter->request('POST', 'http://laravel-api:8012/api/get-user-by-username-and-password', [
                'headers'  => ['content-type' => 'application/json', 'Accept' => 'application/json'],
                'body' => json_encode($body)
            ]);
            return $response->getBody();
    }
}

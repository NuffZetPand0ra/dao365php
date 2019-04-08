<?php
namespace nuffy\dao365;

use GuzzleHttp\Client AS GuzzleClient;
use GuzzleHttp\Psr7\ResponseInterface AS GuzzleResponse;


class Dao
{
    protected $Client;
    protected $CustomerId;
    protected $ApiKey;

    public $LastUrl;

    public function __construct($customer_id, $api_key)
    {
        $this->Client = new GuzzleClient(['base_uri' => 'https://api.dao.as/']);
        $this->CustomerId = $customer_id;
        $this->ApiKey = $api_key;
    }

    protected function callApi(string $method, array $query = [])
    {
        $response = $this->Client->request("GET", $method.".php", [
            "query"=>[
                "kundeid"=>$this->CustomerId,
                "kode"=>$this->ApiKey,
                "format"=>"json"
            ]+$query,
            'on_stats' => function (\GuzzleHttp\TransferStats $stats){
                $this->LastUrl = $stats->getEffectiveUri();
            }
        ]);
        $response_data = json_decode($response->getBody());
        if($response_data->status == "OK"){
            return $response_data->resultat;
        }else{
            throw new DaoException($response_data->fejltekst, $response_data->fejlkode);
        }
    }

    public function request(request\RequestInterface $request) : ?response\ResponseInterface
    {
        $prefix = 'nuffy\dao365\request\\';
        switch(get_class($request)){
            case $prefix."CreateDirectOrder":
                return $this->createDirectOrder($request);
                break;
            case $prefix."CreateShopOrder":
                return $this->createShopOrder($request);
                break;
            case $prefix."FindShops":
                return $this->findShops($request);
                break;
            default:
                throw new DaoException("Requests of type ".get_class($request)." is currently not supported.");
        }
    }

    public function getTrackingStatusCodes() : response\TrackingStatusCodes
    {
        return new response\TrackingStatusCodes($this->callApi("TrackNTraceKoder"));
    }

    public function getErrorCodes() : response\ErrorCodes
    {
        $response = $this->callApi("FejlKoder");
        $error_codes = new response\ErrorCodes((object)$response);
        return $error_codes;
    }

    public function createDirectOrder(request\CreateDirectOrder $order) : response\DirectOrderLabel
    {
        $response = $this->callApi("DAODirekte/leveringsordre", $order->getQueryData());
        $label = new response\DirectOrderLabel($response);
        return $label;
    }

    public function createShopOrder(request\CreateShopOrder $order)
    {
        $response = $this->callApi("DAOPakkeshop/leveringsordre", $order->getQueryData());
        $label = new response\DirectOrderLabel($response);
        return $label;
    }

    public function findShops(request\FindShops $request) : response\ShopSearchResult
    {
        $response = $this->callApi("DAOPakkeshop/FindPakkeshop", $request->getQueryData());
        $result = new response\ShopSearchResult($response);
        return $result;
    }

    public function findShop(int $shop_id) : response\ShopSearchResult
    {
        $response = $this->callApi("DAOPakkeshop/FindPakkeshop", ["shopid"=>$shop_id]);
        $result = new response\ShopSearchResult($response);
        return $result;
    }
}
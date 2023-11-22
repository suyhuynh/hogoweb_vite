<?php

namespace Modules\Core;
use Illuminate\Support\Facades\Cache;
use GuzzleHttp\Client;
class Address
{
    public static function getProvinces(){
        if(!empty(get_setting_config('transport', 'not_use_api')) && !empty(get_setting_config('package', 'Transport'))){
            return \Modules\Transport\Entities\Province::all()->keyBy('id')->toArray();
        }
        return Cache::store('file')->rememberForever('services_hogo_provinces', function () {
            $client = new Client();
            $response = $client->request('GET', 'https://services.loveitop.com/provinces');
            return collect(json_decode($response->getBody(), true))->keyBy('id');
        });
    }

    public static function getProvinceNameById($id)
    {
        $provinces = self::getProvinces();
        return !empty($provinces[$id]) ? $provinces[$id] : '';
    }
    // Quan huyen
    public static function getDistrictsByProvinceId($province_id){
        return Cache::store('file')->rememberForever('services_hogo_province_'.$province_id.'_districts', function () use ($province_id){
            $client = new Client();
            $response = $client->request('GET', 'https://services.loveitop.com/provinces/'.$province_id.'/districts');
            return collect(json_decode($response->getBody(), true))->keyBy('id');
        });
    }

    public static function getDistrictNameById($province_id, $district_id)
    {
       $districts = self::getDistrictsByProvinceId($province_id);
       return !empty($districts[$district_id]) ? $districts[$district_id] : '';
    }

    // Phuong xa
    public static function getWardsByDistrictId($district_id){
        return Cache::store('file')->rememberForever('services_hogo__district_'.$district_id.'_wards', function () use ($district_id){
            $client = new Client();
            $response = $client->request('GET', 'https://services.loveitop.com/districts/'.$district_id.'/wards');
            return collect(json_decode($response->getBody(), true))->keyBy('id');
        });
    }

    public static function getWardNameById($district_id, $vard_id)
    {
       $wards = self::getWardsByDistrictId($district_id);
       return !empty($wards[$vard_id]) ? $wards[$vard_id] : '';
    }
}

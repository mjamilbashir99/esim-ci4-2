<?php

namespace Modules\Auth\Config;

use CodeIgniter\Config\BaseConfig;

class Config extends BaseConfig
{
    // API credentials
    public string $hotelbedsApiKey    = '4d16afaf83ef394e5c96497bfc1026d4';
    public string $hotelbedsSecret    = '03029accae';

    // API Endpoint
    public string $hotelbedsStatusUrl = 'https://api.test.hotelbeds.com/hotel-api/1.0/status';
}

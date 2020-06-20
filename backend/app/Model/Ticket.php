<?php

namespace App\Model;

use Jenssegers\Mongodb\Eloquent\Model;

class Ticket extends Model
{
    protected $connection = 'mongodb';

    protected $table = 'tickets';

    public function __construct(array $attributes = [])
    {
        $this->attributes['status'] = 'open';
        parent::__construct($attributes);
    }

    protected $attributes = ['status' => 1];

    protected $fillable = ['conversation_id', 'appota_id', 'email', 'phone', 'type_error', 'server', 'role_name', 'game_name',
        'source', 'value_recharge', 'type_recharge', 'series', 'transaction_id', 'device', 'status', 'description', 'fb_page_id', 'ip', 'isp'];
}

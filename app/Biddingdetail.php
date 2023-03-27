<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class biddingdetail extends Model
{
  protected $fillable = [
    'bidding_id',
    'contractor_name',
    'total_cost',
    'bid_trade'
  ];
}

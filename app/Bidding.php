<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class bidding extends Model
{
  protected $fillable = [
    'sales_request_id'
  ];

    protected $primaryKey = 'bidding_id';
}

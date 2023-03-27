<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mall extends Model
{
  protected $fillable = [
    'region',
    'mall_name',
    'mall_code',
    'mall_logo'
  ];

  protected $primaryKey = 'mall_id';
}

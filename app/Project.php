<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class project extends Model
{
  protected $fillable = [
    'sales_request_id',
    'project_code',
    'sld',
    'bom',
    'layout'
  ];

  protected $primaryKey = 'project_id';
}

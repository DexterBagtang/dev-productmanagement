<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sld extends Model
{
  protected $fillable = [
    'project_id',
    'sld_file'
  ];

  protected $primaryKey = 'sld_id';
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class bom extends Model
{
  protected $fillable = [
    'project_id',
    'bom_file'
  ];

  protected $primaryKey = 'bom_id';
}

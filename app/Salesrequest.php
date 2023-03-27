<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Salesrequest extends Model
{
  protected $fillable = [
    'mall_id',
    'sales_request_code',
    'qoutation_addressee',
    'requester',
    'date_needed',
    'on_site_survey',
    'comment',
    'project_requirements_files',
    'project_requirements_files_2',
    'project_requirements_files_3',
    'project_requirements_files_4',
    'project_title',
    'category',
    'status',
    'reason_for_revision',
  ];

  protected $primaryKey = 'sales_request_id';
}

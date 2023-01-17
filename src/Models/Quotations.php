<?php

namespace SaltQuotation\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Support\Facades\Schema;

use SaltLaravel\Models\Resources;

use SaltLaravel\Traits\ObservableModel;
use SaltLaravel\Traits\Uuids;

class Quotations extends Resources {
    use Uuids;
    use ObservableModel;

    protected $filters = [
        'default',
        'search',
        'fields',
        'relationship',
        'withtrashed',
        'orderby',
        // Fields table provinces
        'id',
        'type',
        'industry_id',
        'base_price',
        'risk_level',
        'code_number',
        'contact_id',
        'valid_from',
        'valid_end',
        'description',
        'data',
        'status',
        'is_template',
    ];

    protected $rules = array(
        'type' => 'required|in:proposal,estimate',
        'industry_id' => 'required|string',
        'base_price' => 'required|float',
        'contact_id' => 'required|string',
        'risk_level' => 'required|in:normal,medium,high',
        'code_number' => 'required|string',
        'valid_from' => 'required|date',
        'valid_end' => 'required|date',
        'description' => 'required|string',
        'data' => 'nullable|json',
        'status' => 'required|in:draft,active',
        'is_template' => 'required|boolean',
    );

    protected $auths = array (
        'index',
        'store',
        'show',
        'update',
        'patch',
        'destroy',
        'trash',
        'trashed',
        'restore',
        'delete',
        'import',
        'export',
        'report'
    );

    protected $forms = array();
    protected $structures = array();
    protected $searchable = array(
        'type',
        'industry_id',
        'base_price',
        'risk_level',
        'code_number',
        'contact_id',
        'valid_from',
        'valid_end',
        'description',
        'data',
        'status',
        'is_template',
    );

    protected $fillable = array(
        'type',
        'industry_id',
        'base_price',
        'risk_level',
        'code_number',
        'contact_id',
        'valid_from',
        'valid_end',
        'description',
        'data',
        'status',
        'is_template',
    );
}

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

class SectionItems extends Resources {

    protected $table = 'quotation_section_items';

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
        'quotation_id',
        'item_id',
        'data',
    ];

    protected $rules = array(
        'quotation_id' => 'required|string',
        'item_id' => 'required|string',
        'data' => 'nullable|json',
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
        'quotation_id',
        'item_id',
        'data',
    );

    protected $fillable = array(
        'quotation_id',
        'item_id',
        'data',
    );
}

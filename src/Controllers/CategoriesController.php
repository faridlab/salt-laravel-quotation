<?php

namespace SaltQuotation\Controllers;

use OpenApi\Annotations as OA;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use SaltLaravel\Controllers\Controller;
// use SaltLaravel\Controllers\Traits\ResourceIndexable;
use SaltLaravel\Controllers\Traits\ResourceStorable;
use SaltLaravel\Controllers\Traits\ResourceShowable;
use SaltLaravel\Controllers\Traits\ResourceUpdatable;
use SaltLaravel\Controllers\Traits\ResourcePatchable;
use SaltLaravel\Controllers\Traits\ResourceDestroyable;
use SaltLaravel\Controllers\Traits\ResourceTrashable;
use SaltLaravel\Controllers\Traits\ResourceTrashedable;
use SaltLaravel\Controllers\Traits\ResourceRestorable;
use SaltLaravel\Controllers\Traits\ResourceDeletable;
use SaltLaravel\Controllers\Traits\ResourceImportable;
use SaltLaravel\Controllers\Traits\ResourceExportable;
use SaltLaravel\Controllers\Traits\ResourceReportable;

use SaltQuotation\Models\Settings;
use SaltLaravel\Services\ResponseService;

/**
 * @OA\Info(
 *      title="Countries Endpoint",
 *      version="1.0",
 *      @OA\Contact(
 *          name="Farid Hidayat",
 *          email="farid@startapp.id",
 *          url="https://startapp.id"
 *      )
 *  )
 */
class CategoriesController extends Controller
{
    protected $modelNamespace = 'SaltQuotation';

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct(Request $request, Settings $model, ResponseService $responder) {
        try {
            $this->responder = $responder;
            $this->segment = 'categories';
            if($this->checkIfModelExist(Str::studly($this->segment), $this->modelNamespace)) {
                $this->model = $this->getModelClass(Str::studly($this->segment), $this->modelNamespace);
            } else {
                if($model->checkTableExists($this->segment)) {
                    $this->model = $model;
                    $this->model->setTable($this->segment);
                }
            }
            if($this->model) {
                $this->responder->set('collection', $this->model->getTable());
                // SET default Authentication
                $this->middleware('auth:api', ['only' => $this->model->getAuthenticatedRoutes()]);
            }

            if(is_null($this->table_name)) $this->table_name = $this->segment;
            $this->segments = $request->segments();
        } catch (\Exception $e) {
            $this->responder->set('message', $e->getMessage());
            $this->responder->setStatus(500, 'Internal server error.');
            return $this->responder->response();
        }
    }

    /**
     * @OA\Get(
     *      path="/api/v1/countries",
     *      @OA\ExternalDocumentation(
     *          description="More documentation here...",
     *          url="https://github.com/faridlab/laravel-search-query"
     *      ),
     *      @OA\Parameter(
     *          in="query",
     *          name="search",
     *          required=false
     *      ),
     *      @OA\Response(
     *          response="200",
     *          description="List of Country"
     *      ),
     *      @OA\Response(response="default", description="Welcome page")
     * )
     */

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {

        $this->checkModelAuthorization('index', 'read');

        try {

            $count = $this->model->where('group', 'proposal_categories')->count();
            $model = $this->model->where('group', 'proposal_categories')->filter();

            $format = $request->get('format', 'default');

            $limit = intval($request->get('limit', 25));
            if($limit > 100) {
                $limit = 100;
            }

            $p = intval($request->get('page', 1));
            $page = ($p > 0 ? $p - 1: $p);

            if($format == 'datatable') {
                $draw = $request['draw'];
            }

            $modelCount = clone $model;
            $meta = array(
                'recordsTotal' => $count,
                'recordsFiltered' => $modelCount->count()?: $count
            );

            $data = $model
                        ->offset($page * $limit)
                        ->limit($limit)
                        ->get();

            $this->responder->set('message', 'Data retrieved.');
            $this->responder->set('meta', $meta);
            $this->responder->set('data', $data);
            if($format == 'datatable') {
                $this->responder->set('draw', $draw);
                $this->responder->set('recordsFiltered', $meta['recordsFiltered']);
                $this->responder->set('recordsTotal', $meta['recordsTotal']);
            }
            return $this->responder->response();
        } catch(\Exception $e) {
            $this->responder->set('message', $e->getMessage());
            $this->responder->setStatus(500, 'Internal server error.');
            return $this->responder->response();
        }
    }

    use ResourceStorable;
    use ResourceShowable;
    use ResourceUpdatable;
    use ResourcePatchable;
    use ResourceDestroyable;
    use ResourceTrashable;
    use ResourceTrashedable;
    use ResourceRestorable;
    use ResourceDeletable;
    use ResourceImportable;
    use ResourceExportable;
    use ResourceReportable;
}


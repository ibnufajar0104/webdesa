<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var list<string>
     */
    protected $helpers = ['app_button'];

    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
    // protected $session;

    /**
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.

        // E.g.: $this->session = service('session');
    }
    /**
     * Handle Server-Side DataTable Processing
     *
     * @param \CodeIgniter\Database\BaseBuilder $builder Query Builder
     * @param array $columns Maps DataTable column index to DB column name for sorting (e.g. [0 => 'id', 1 => 'name'])
     * @param array $searchFields DB columns to search (e.g. ['name', 'description'])
     * @param callable|null $formatter Callback to format each row
     * @param array $defaultOrder Default ordering (e.g. ['updated_at' => 'desc'])
     * @return \CodeIgniter\HTTP\ResponseInterface
     */
    protected function processDataTable($builder, array $columns, array $searchFields, ?callable $formatter = null, array $defaultOrder = []) // @phpstan-ignore-line
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(405);
        }

        $request = $this->request;

        $draw   = (int) $request->getPost('draw');
        $start  = (int) $request->getPost('start');
        $length = (int) $request->getPost('length');
        $search = $request->getPost('search')['value'] ?? '';

        // Ordering
        $orderInfo = $request->getPost('order');

        if ($orderInfo) {
            $colIdx = $orderInfo[0]['column'] ?? 0;
            $dir    = $orderInfo[0]['dir'] ?? 'asc';
            if (isset($columns[$colIdx])) {
                $builder->orderBy($columns[$colIdx], $dir);
            }
        }

        // Apply default order if transparently append secondary sort
        foreach ($defaultOrder as $col => $d) {
           $builder->orderBy($col, $d);
        }

        // Total records before filter
        $recordsTotal = $builder->countAllResults(false);

        // Searching
        if ($search && !empty($searchFields)) {
            $builder->groupStart();
            foreach ($searchFields as $i => $field) {
                if ($i === 0) {
                    $builder->like($field, $search);
                } else {
                    $builder->orLike($field, $search);
                }
            }
            $builder->groupEnd();
        }

        // Total filtered
        $recordsFiltered = $builder->countAllResults(false);

        // Limit
        if ($length > 0) {
            $builder->limit($length, $start);
        }

        // Get Data
        $results = $builder->get()->getResultArray();

        // Formatting
        $data = [];
        foreach ($results as $row) {
            if ($formatter) {
                $formatted = $formatter($row);
                if ($formatted) {
                    $data[] = $formatted;
                }
            } else {
                $data[] = array_values($row);
            }
        }

        return $this->response->setJSON([
            'draw'            => $draw,
            'recordsTotal'    => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data'            => $data,
        ]);
    }
}

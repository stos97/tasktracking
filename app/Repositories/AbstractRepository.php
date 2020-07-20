<?php


namespace App\Repositories;

use App\Repositories\Criterias\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class AbstractRepository
 *
 * @package App\Repositories
 */
abstract class AbstractRepository extends BaseRepository
{
    /**
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function boot()
    {
        parent::boot();

        $this->pushCriteria(new RequestCriteria(request()));
    }

    /**
     * @param null|int $limit
     * @param array    $columns
     * @param string   $method
     *
     * @return mixed
     */
    public function paginate($limit = null, $columns = ['*'], $method = 'paginate')
    {
        if (!$limit && $this->isValidLimitFromRequest()) {
            $limit = (int) request()->get('limit');
        }

        return parent::paginate($limit, $columns, $method);
    }

    /**
     * @return bool
     */
    private function maxPaginationReached()
    {
        return config('repository.pagination.max', 15) <= request()->get('limit');
    }

    /**
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     *
     * @return int
     */
    protected function getPerPage()
    {
        return $this->isValidLimitFromRequest() ? (int) request()->get('limit') : $this->makeModel()->getPerPage();
    }

    /**
     * @return bool
     */
    protected function getPage()
    {
        return $this->isValidPageFromRequest() ? (int) request()->has('page') : 1;
    }

    /**
     * @return bool
     */
    private function isValidPageFromRequest()
    {
        return request()->has('page') &&
            is_int((int) request()->get('page')) &&
            (int) request()->has('page') > 0;
    }

    /**
     * @return bool
     */
    private function isValidLimitFromRequest()
    {
        return request()->has('limit') &&
            is_int((int) request()->get('limit')) &&
            (int) request()->get('limit') > 0 &&
            !$this->maxPaginationReached();
    }
}
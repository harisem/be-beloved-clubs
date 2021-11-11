<?php

namespace App\Services;

use App\Interfaces\CatalogInterface;
use App\Traits\ResponseAPI;

class CatalogService
{
    use ResponseAPI;

    protected $catalogInterface;

    public function __construct(CatalogInterface $catalogInterface)
    {
        $this->catalogInterface = $catalogInterface;
    }

    public function getAll()
    {
        try {
            $data = $this->catalogInterface->getAll();
            return (!$data->isEmpty()) ? $this->success('All Catalog\'s.', $data) : $this->error('Data not found', 404);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function getOne($slug)
    {
        try {
            $data = $this->catalogInterface->getOne($slug);
            return isset($data) ? $this->success('Catalog: ' . $data->name, $data) : $this->error('Catalog\'s not found', 404);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function getHeader()
    {
        try {
            $data = $this->catalogInterface->getHeader();
            return (!$data->isEmpty()) ? $this->success('Catalog\'s fetched.', $data) : $this->error('Data not found', 404);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }
}
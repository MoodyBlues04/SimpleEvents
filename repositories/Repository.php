<?php

namespace app\repositories;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\db\Exception;

class Repository
{
    private ActiveQuery $query;

    public function __construct(ActiveQuery|string $query)
    {
        if (is_string($query)) {
            $query = $query::find();
        }
        $this->query = $query;
    }

    /**
     * @return ActiveRecord[]
     */
    public function getAll(): array
    {
        return $this->query->all();
    }

    /**
     * @return ActiveRecord[]
     */
    public function getAllBy(array $conditions): array
    {
        return $this->getBy($conditions)->all();
    }

    public function getOneBy(array $conditions): ?ActiveRecord
    {
        return $this->getBy($conditions)->one();
    }

    public function getBy(array $conditions): ?ActiveQuery
    {
        return $this->query->where($conditions);
    }

    /**
     * @throws Exception
     */
    public function create(array $properties): ?ActiveRecord
    {
        $cls = $this->query->modelClass;

        /** @var ActiveRecord $model */
        $model = new $cls($properties);
        return $model->save() ? $model : null;
    }
}
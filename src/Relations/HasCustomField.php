<?php

namespace Yaangvu\LaravelCustomField\Relations;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class HasCustomField extends Relation
{
    /**
     * @inheritDoc
     */
    public function __construct(Builder $query, Model $parent)
    {
        parent::__construct($query, $parent);
    }

    /**
     * @inheritDoc
     */
    public function addConstraints(): void
    {
        if (static::$constraints) {
            $query = $this->getRelationQuery();

            $query->where('model_type', '=', get_class($this->parent));

            $query->whereNull('archived_at');
        }
    }

    /**
     * @inheritDoc
     */
    public function addEagerConstraints(array $models): void
    {
        $whereIn = $this->whereInMethod($this->parent, 'model_type');
        $this->whereInEager(
            $whereIn,
            'model_type',
            [get_class($this->parent)],
            $this->getRelationQuery()
        );
    }

    /**
     * @inheritDoc
     *
     * @param Model[] $models
     */
    public function initRelation(array $models, $relation): array
    {
        foreach ($models as $model) {
            $model->setRelation($relation, $this->related->newCollection());
        }

        return $models;
    }

    /**
     * @inheritDoc
     *
     * @param Model[] $models
     */
    public function match(array $models, Collection $results, $relation): array
    {
        foreach ($models as $model) {
            $model->setRelation($relation, $results);
        }

        return $models;
    }

    /**
     * @inheritDoc
     */
    public function getResults()
    {
        return $this->query->get();
    }

    /**
     * Get Custom field values
     * @return Collection|array
     */
    public function values(): Collection|array
    {
        return $this->parent
            ->newQuery()
            ->with('customFieldValues', function ($query) {
                // Todo
            })
            ->get();
    }
}

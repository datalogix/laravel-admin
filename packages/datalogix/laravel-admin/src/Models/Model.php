<?php

namespace Datalogix\Admin\Models;

use Datalogix\Admin\Admin;
use Illuminate\Database\Eloquent\Model as BaseModel;
use Illuminate\Support\Str;

abstract class Model extends BaseModel
{
    public function __construct(array $attributes = [])
    {
        $this->setConnection(Admin::connection());

        $tableKey = $this->tableKey ?: Str::snake(Str::pluralStudly(class_basename($this)));

        $this->setTable(config('admin.database.tables.' . $tableKey));

        parent::__construct($attributes);
    }
}

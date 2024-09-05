<?php

namespace App\Services;

use Illuminate\Support\Str;

class BaseService
{
    protected $request;
    protected $model;

    public function fillDataModel($model, $fields = [])
    {
        $this->model = $model;
        foreach ($fields as $value) {
            if ($value == 'slug' && $this->request->{$value} == '') {
                $this->model->{$value} = Str::slug($this->request->title);
            }
            else if ($value == 'user_id') {
                $this->model->{$value} = $this->request->user()->id;
            }
            else {
                $this->model->{$value} = $this->request->{$value};
            }
        }
    }
}
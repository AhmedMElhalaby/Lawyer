<?php

namespace App\Http\Resources\Api\Home;

use Illuminate\Http\Resources\Json\JsonResource;

class LawArticleResource extends JsonResource
{
    protected $count;

    public function __construct($resource,$count)
    {
        $this->count = $count;
        parent::__construct($resource);
    }

    public function toArray($request): array
    {
        $Objects = array();
        $Objects['id'] = $this->getId();
        $Objects['name'] = (app()->getLocale() == 'ar')?$this->getNameAr():$this->getName();
        $Objects['text'] = (app()->getLocale() == 'ar')?$this->getTextAr():$this->getText();
        $Objects['count'] = $this->count;
        $Objects['Law'] = new LawResource($this->law);
        return $Objects;
    }
}

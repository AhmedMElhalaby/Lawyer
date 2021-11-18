<?php

namespace App\Http\Resources\Api\Home;

use Illuminate\Http\Resources\Json\JsonResource;

class LawArticleResource extends JsonResource
{
    public function toArray($request): array
    {
        $Objects = array();
        $Objects['id'] = $this->getId();
        $Objects['name'] = (app()->getLocale() == 'ar')?$this->getNameAr():$this->getName();
        $Objects['text'] = (app()->getLocale() == 'ar')?$this->getTextAr():$this->getText();
        $Objects['Law'] = new LawResource($this->law);
        return $Objects;
    }
}

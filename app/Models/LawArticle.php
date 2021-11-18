<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property mixed id
 * @property mixed law_id
 * @property mixed name
 * @property mixed name_ar
 * @property mixed text
 * @property mixed text_ar
 */
class LawArticle extends Model
{
    protected $table = 'laws_articles';
    protected $fillable = ['law_id','name','name_ar','text','text_ar',];

    public function law(): BelongsTo
    {
        return $this->belongsTo(Law::class);
    }
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getLawId()
    {
        return $this->law_id;
    }

    /**
     * @param mixed $law_id
     */
    public function setLawId($law_id): void
    {
        $this->law_id = $law_id;
    }

    /**
     * @return mixed
     */
    public function getNameAr()
    {
        return $this->name_ar;
    }

    /**
     * @param mixed $name_ar
     */
    public function setNameAr($name_ar): void
    {
        $this->name_ar = $name_ar;
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param mixed $text
     */
    public function setText($text): void
    {
        $this->text = $text;
    }

    /**
     * @return mixed
     */
    public function getTextAr()
    {
        return $this->text_ar;
    }

    /**
     * @param mixed $text_ar
     */
    public function setTextAr($text_ar): void
    {
        $this->text_ar = $text_ar;
    }

}

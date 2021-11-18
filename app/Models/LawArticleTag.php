<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property mixed id
 * @property mixed name
 * @property mixed law_id
 * @property mixed law_article_id
 */
class LawArticleTag extends Model
{
    protected $table = 'laws_articles_tags';
    protected $fillable = ['name','law_id','law_article_id'];
    public function law(): BelongsTo
    {
        return $this->belongsTo(Law::class);
    }
    public function law_article(): BelongsTo
    {
        return $this->belongsTo(LawArticle::class);
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
    public function getLawArticleId()
    {
        return $this->law_article_id;
    }

    /**
     * @param mixed $law_article_id
     */
    public function setLawArticleId($law_article_id): void
    {
        $this->law_article_id = $law_article_id;
    }

}

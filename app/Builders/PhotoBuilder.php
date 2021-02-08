<?php


namespace App\Builders;

use App\Models\Photo;

/**
 * Class PhotoBuilder
 * @package App\Builders
 */
class PhotoBuilder extends BaseBuilder
{
    public $table= 'photos.';

    /**
     * @return PhotoBuilder
     */
    public function approved()
    {
        return $this->where($this->table.'status',Photo::STATUS_APPROVED);
    }

    /**
     * @return PhotoBuilder
     */
    public function pending()
    {
        return $this->where($this->table.'status',Photo::STATUS_PENDING);
    }
}

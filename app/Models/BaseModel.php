<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;

class BaseModel extends Model
{
    public static function boot()
    {
        parent::boot();
        static::creating( function( $model ) {
            $model->beforeSave( $model );
        });
        static::created( function( $model ) {
            $model->afterSave( $model );
        });
        static::updating( function( $model ) {
            $model->beforeUpdate( $model );
        });
        static::updated( function( $model ) {
            $model->afterUpdate( $model );
        });
        static::deleting( function( $model ) {
            $model->beforeDelete( $model );
        });
        static::deleted( function( $model ) {
            $model->afterDelete( $model );
        });
    }

    /**
     * @param $model
     */
    public function beforeSave( $model ) {}

    /**
     * @param $model
     */
    public function afterSave( $model ) {}

    /**
     * @param $model
     */
    public function beforeUpdate( $model ) {}

    /**
     * @param $model
     */
    public function afterUpdate( $model ) {}

    /**
     * @param $model
     */
    public function beforeDelete( $model ) {}

    /**
     * @param $model
     */
    public function afterDelete( $model ) {}

    /**
     * @param array $attributes
     */
    public function loadAttributes( array $attributes)
    {
        foreach ($attributes as $attribute => $value){
            if( Schema::hasColumn($this->getTable(),$attribute ) ){
                $this->attributes[$attribute] = $value;
            }
        }
    }

    /**
     * @param $file
     * @param string $folder
     * @return string
     */
    public function uploadFile( $file ,$folder = '')
    {
        $directory = public_path($folder);
        if(!File::isDirectory($directory)){
            File::makeDirectory($directory, 0777, true, true);
        }
        $path = time().'.'.$file->extension();
        $file->move($directory,$path);
        return '\\'.$folder.'\\'.$path;
    }

}

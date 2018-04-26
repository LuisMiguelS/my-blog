<?php

namespace App\Traits;

use Jenssegers\Date\Date;

trait DatesTranslator
{

    public function getCreatedAtAttribute($created_at)
    {
        return new Date($created_at);
    }

    public function getUpdatedAtAttribute($updated_at)
    {
        return new Date($updated_at);
    }

    public function getDeletedAtAttribute($deleted_at)
    {
        if($deleted_at == null){
            return 'Aún no ha sido eliminado';
        }
        return new Date($deleted_at);
    }
}
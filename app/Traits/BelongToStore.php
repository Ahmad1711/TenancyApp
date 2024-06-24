<?php

namespace App\Traits;


trait BelongToStore
{
    
    public static function bootBelongToStore(){

        static::addGlobalScope('store',function($query){
            $store=app()->make('store.active');
            $query->where('store_id',$store->id);
        });
    }

}
<?php

namespace App\Listeners;

use App\Events\StoreCreated;
use DirectoryIterator;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class CreateStoreDatabase
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(StoreCreated $event)
    {
        $store=$event->store;
        $db="tenancy_store_{$store->id}";
        $store->database_options=[
            'dbname'=>$db
        ];

        $store->save();

        DB::statement("Create Database `{$db}`");

        // $old=Config::get('database.connections.mysqle.database');

        Config::set('database.connections.tenant.database',$db);

        $dir=new DirectoryIterator(database_path('migrations/tenants'));
        foreach($dir as $file){
            if($file->isFile()){
                Artisan::call('migrate',[
                    '--database'=>'tenant',
                    '--path'=>'database/migrations/tenants/'.$file->getFilename(),
                    '--force'=>true
                ]);
            }
        }
      

        // Config::set('database.connections.mysqle.database'.$old);

    }
}

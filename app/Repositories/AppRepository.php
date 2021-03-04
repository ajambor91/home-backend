<?php
namespace App\Repositories;

use App\Models\AppModel;
use Illuminate\Support\Facades\Hash;

class AppRepository {
    public function addApp(){
        $app = new AppModel();
        $app->name = env('APP_LOGIN');
        $app->password = Hash::make(env('APP_PASSWORD'));
        $app->save();
    }
}

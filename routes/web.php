<?php

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/create',function(){
   $user=User::findOrFail(1);
  // $role=new Role(['name'=>'administrator']);

   $user->roles()->save(new Role(['name'=>'administrator']));
});

Route::get('/read',function(){
   $user=User::findOrFail(1);
   foreach ($user->roles as $role){
       echo$role->name;
   }
});

Route::get('update',function (){
   $user=User::findOrFail(1);
    echo"user found"."<br>";
   if($user->has('roles')){
       echo"has roles"."<br>";
       foreach($user->roles as $role){
           if($role->name=='administrator'){
               $role->name='ADMINISTRATOR';
               $role->save();
           }
           else{
               echo"roles not match"."<br>";
           }
       }
   }
   else{
       echo"No Roles";
   }
});

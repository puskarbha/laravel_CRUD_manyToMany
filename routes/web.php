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

   $user->roles()->save(new Role(['name'=>'subscriber']));
});

Route::get('/read',function(){
   $user=User::findOrFail(1);
   foreach ($user->roles as $role){
       echo$role->name."<br>";
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

Route::get('/delete',function(){
   $user=User::findOrFail(1);

    foreach ($user->roles as $role){
        $role->whereId(3)->delete();
    }
});
//attach or add relation user id 1 with role id 6 in pivot column
Route::get('/attach',function(){
    $user=User::findOrFail(1);
    $user->roles()->attach(6);

});

//deattach or remove relation user id 1 with role id 6 in pivot column
Route::get('/detach',function(){
    $user=User::findOrFail(1);
    $user->roles()->detach(6);

});

//add relation if not present,deletes other extra relation
Route::get('/sync',function(){
    $user=User::findOrFail(1);
    $user->roles()->sync([1,3]);

});

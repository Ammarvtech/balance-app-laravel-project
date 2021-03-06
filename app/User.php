<?php



namespace App;



use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Notifications\Notifiable;

use Laravel\Passport\HasApiTokens;



class User extends Authenticatable

{

    use HasApiTokens,Notifiable;



    /**

     * The attributes that are mass assignable.

     *

     * @var array

     */

    protected $fillable = [

        'name', 'email', 'password','verificationcode','image','device_token'

    ];



    /**

     * The attributes that should be hidden for arrays.

     *

     * @var array

     */

    protected $hidden = [

        'password', 'remember_token',

    ];



    /**

     * The attributes that should be cast to native types.

     *

     * @var array

     */

    protected $casts = [

        'email_verified_at' => 'datetime',

    ];



    public function AauthAcessToken(){

        return $this->hasMany('\App\OauthAccessToken');

    }







    // public function notification() {

    //     return $this->hasMany(App\Notification::class);

    // }



    public static function getSettings($user_id){

        return Self::select('currency', 'budget_limit', 'language', 'report_frequency', 'two_factor_authentication')->where('id', $user_id)->get();

    }

}


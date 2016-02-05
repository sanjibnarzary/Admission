<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $fillable = [
        "form_number", "user_id", "first_name", "middle_name", "last_name", "guardian_name", "dob",
        "gender", "eligibility", "region_code","category","entry_scheme","center","center_2","center_3","nationality",
        "email","alternate_phone","mobile_number",
        "ca_care_of","ca_village_town","ca_post_office","ca_district","ca_state","ca_pin",
        "pa_care_of","pa_village_town","pa_post_office","pa_district","pa_state","pa_pin","application_status","photo_url","signature_url"
    ];
    //
    /*
     * This function will relate to User using ID.
     */
    public function user(){
        return $this->belongsTo('App\User');
    }
}

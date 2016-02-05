<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')
                  ->unique()
                  ->unsigned();
            $table->integer('form_number')
                  ->unique()
                  ->unsigned();
            $table->integer('roll_number')
                  ->unique()
                  ->nullable();
            $table->string('first_name',45);
            $table->string('middle_name',45)
                  ->nullable();
            $table->string('last_name',45);
            $table->string('guardian_name',100);
            $table->date('dob');
            $table->string('mobile_number',15);
            $table->string('email',100)
                  ->unique();
            $table->integer('region_code');
            $table->integer('center');
            $table->integer('center_2');
            $table->integer('center_3');
            $table->integer('eligibility');
            $table->string('gender',10);
            $table->integer('entry_scheme');
            $table->integer('category');
            $table->string('alternate_phone',15)
                  ->nullable();
            $table->integer('nationality');

            $table->string('ca_care_of',60);
            $table->string('ca_village_town',60);
            $table->string('ca_post_office',45);
            $table->string('ca_district',50);
            $table->string('ca_state',50);
            $table->string('ca_pin',10);

            $table->string('pa_care_of',60);
            $table->string('pa_village_town',60);
            $table->string('pa_post_office',45);
            $table->string('pa_district',50);
            $table->string('pa_state',50);
            $table->string('pa_pin',10);
            $table->integer('application_status');

            $table->string('photo_url')
                  ->nullable();
            $table->string('signature_url')
                  ->nullable();

            $table->timestamps();
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('applications');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonationReqsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donation_reqs', function (Blueprint $table) {

            $table->id();
            $table->string('b_req_code');
            
            $table->unsignedBigInteger('recipient_id');

            // recipient health information
            $table->string('recipient_sickness');
            $table->string('recipient_gender');
            $table->string('recipient_age');

            $table->unsignedBigInteger('blood_id');
                        
            $table->unsignedBigInteger('element_type')->default(0);
              
            $table->integer('quantity')->default(1);
            $table->timestamp('blood_require_time');

            // recipient address information
            $table->string('recipient_email');
            $table->string('recipient_phone');

            $table->unsignedBigInteger('division_id')->default(0);
            
            $table->unsignedBigInteger('city_id');
            $table->string('recipient_address');
 


            $table->integer('donation_status')->default(0);

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('donation_reqs');
    }
}

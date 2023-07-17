<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonationInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donation_infos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBiginteger('blood_request_id')->default(0);
           
            $table->unsignedBigInteger('donor_id')->default(0);

            $table->timestamps('donor_accepted');
            $table->timestamps('donation_completed');
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
        Schema::dropIfExists('donation_infos');
    }
}

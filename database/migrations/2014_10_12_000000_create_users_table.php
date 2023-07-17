<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            
            
            // donor personal information
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('gender');
            $table->date('DOB')->nullable();
            $table->integer('phone')->default(0);
            $table->string('address')->default('address');
            $table->integer('city_id')->default(0);
            
            // donor health information
            $table->integer('blood_id')->default(0);
            // $table->foreign('blood_id')->references('blood_id')->on('bloods')->onDelete('cascade');
            $table->float('weight', 6, 2)->default(60);
            $table->float('height', 3, 2)->default(5.7);
            $table->float('BMI', 4, 2)->default(25.7);;
            $table->string('health_condition')->default('fit');
            $table->string('diabetes')->default('normal');
            $table->string('BP')->default('normal');

            // donor health information
            $table->integer('donate_number')->default(0);
            $table->integer('avail_to_donate')->default(1);
            $table->date('last_donate')->nullable();
            $table->string('checkup_report')->nullable();

            // administration permission check
            $table->integer('role_id')->default(0);

            $table->datetime('email_verified_at');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SetupStudentRelatedTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('name_titles');
        Schema::dropIfExists('students');

        Schema::create('name_titles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50);
        });

        DB::table('name_titles')->insert([
            ['name' => 'ด.ช.'],
            ['name' => 'ด.ญ.'],
            ['name' => 'นาย'],
            ['name' => 'น.ส.'],
            ['name' => 'นาง']
        ]);

        Schema::create('education_levels', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50);
            $table->string('short_name',10);
        });

        DB::table('education_levels')->insert([
            ['name' => 'ประถมศึกษาปีที่ 1', 'short_name'=> 'ป.1'],
            ['name' => 'ประถมศึกษาปีที่ 2', 'short_name'=> 'ป.2'],
            ['name' => 'ประถมศึกษาปีที่ 3', 'short_name'=> 'ป.3'],
            ['name' => 'ประถมศึกษาปีที่ 4', 'short_name'=> 'ป.4'],
            ['name' => 'ประถมศึกษาปีที่ 5', 'short_name'=> 'ป.5'],
            ['name' => 'ประถมศึกษาปีที่ 6', 'short_name'=> 'ป.6'],
            ['name' => 'มัธยมศึกษาปีที่ 1', 'short_name'=> 'ม.1'],
            ['name' => 'มัธยมศึกษาปีที่ 2', 'short_name'=> 'ม.2'],
            ['name' => 'มัธยมศึกษาปีที่ 3', 'short_name'=> 'ม.3'],
            ['name' => 'มัธยมศึกษาปีที่ 4', 'short_name'=> 'ม.4'],
            ['name' => 'มัธยมศึกษาปีที่ 5', 'short_name'=> 'ม.5'],
            ['name' => 'มัธยมศึกษาปีที่ 6', 'short_name'=> 'ม.6'],
        ]);

        Schema::create('students', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('name_title_id');
            $table->string('first_name', 100);
            $table->string('last_name', 100);
            $table->text('billable_address')->nullable();
            $table->string('avatar')->nullable();
            $table->string('citizen_id')->nullable();
            $table->integer('education_level_id')->unsigned();
            $table->date('birth_date')->default('0000-00-00');
            $table->integer('status')->unsigned()->default(1);

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('name_title_id')->references('id')->on('name_titles');
            $table->foreign('education_level_id')->references('id')->on('education_levels');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
        Schema::dropIfExists('name_titles');
        Schema::dropIfExists('education_levels');

    }
}

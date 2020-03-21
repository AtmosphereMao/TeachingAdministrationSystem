<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;

    class CreateCourseVisitor extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::create('course_visitor', function (Blueprint $table) {
                $table->increments('id');
                $table->string('ip', 32);
                $table->string('country', 4)->nullable();
                $table->string('city', 20)->nullable(); // 新增
                $table->integer('course_id'); // 新增
                $table->integer('clicks')->unsigned()->default(0);
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
            Schema::drop('course_visitor');
        }
    }

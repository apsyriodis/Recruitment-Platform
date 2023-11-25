<?php

use App\Enums\StepCategory;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('steps', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('timeline_id');
            $table->foreign('timeline_id')->references('id')->on('timelines')->onDelete('cascade');

            $table->enum('step_category', StepCategory::values())->default(StepCategory::FIRST_INTERVIEW);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('steps');
    }
};

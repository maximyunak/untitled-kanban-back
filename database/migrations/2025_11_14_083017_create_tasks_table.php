<?php

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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();

            $table->string("name");1
            $table->text("description")->nullable();
            $table->boolean("is_completed")->default(false);
            $table->integer("position")->default(0);
            $table->dateTime("deadline")->nullable();

            $table->foreignId("creator_id")->constrained("users")->cascadeOnDelete();
            $table->foreignId("assignee_id")->nullable()->constrained("users")->nullOnDelete();

            $table->foreignIdFor(\App\Models\Column::class)->constrained()->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};

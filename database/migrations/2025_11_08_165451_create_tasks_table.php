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
        Schema::dropIfExists('participants');
        Schema::dropIfExists('workspaces');
        Schema::dropIfExists('workspace_permits');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('tasks');


        Schema::create('workspaces', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id',)->constrained()->cascadeOnDelete();
            $table->string('title', 30)->default('New Workspace');
            $table->timestamps();
        });

        Schema::create('workspace_permits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('workspace_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id',)->constrained()->cascadeOnDelete();
            $table->integer('permit_level')->default(0);
            $table->timestamps();
        });
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('workspace_id',)->constrained()->cascadeOnDelete();
            $table->string('title', 30)->default('New Category');
            $table->timestamps();
        });
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('workspace_id')->constrained()->cascadeOnDelete();
            $table->string('title', 30)->default('Add a Title...');
            $table->longText('description',)->default('Add a Description...');
            $table->string('task_colour', 6)->default('4f4f4f');
            $table->string('status',30)->nullable()->default('Yet to Start');
            $table->string('status_colour', 6)->default('ff0000');
            $table->dateTime('deadline')->nullable();
            $table->timestamps();

        Schema::create('participant_badges', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id',)->constrained()->cascadeOnDelete();
            $table->foreignId('task_id',)->constrained()->cascadeOnDelete();
            $table->timestamps();

        });
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('participants');
        Schema::dropIfExists('workspaces');
        Schema::dropIfExists('workspace_permits');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('tasks');

    }
};

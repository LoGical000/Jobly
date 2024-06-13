<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained()->onDelete('cascade');
            $table->string("CV");
            $table->string("Age");
            $table->string("demonstration_video");
            $table->string("resume");
            $table->string("experience");
            $table->string("education");
            $table->string("portfolio");
            $table->integer("phone_number");
            $table->enum("work_status", ["not working"]);
            $table->enum("graduation_status", ["graduation", "Not graduated"]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};

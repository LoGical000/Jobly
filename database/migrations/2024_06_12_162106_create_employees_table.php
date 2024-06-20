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
            //$table->string("first_name");
            //$table->string("last_name");
            //$table->string("cv");
            $table->date('date_of_birth');
            //$table->string("demonstration_video");
            $table->string("resume");
            $table->string("experience");
            $table->string("education");
            $table->string("portfolio")->nullable();
            $table->string("phone_number");
            $table->enum("work_status", ["working","student","not working"]);
            $table->enum("graduation_status", ["graduated", "Not graduated"]);
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

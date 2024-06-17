<?php

use App\Models\Company;
use App\Models\Vacancy;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('jobs__requests', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(Vacancy::class)->constrained()->onDelete('cascade');
            $table->enum("status", ["Accepted", "Rejected", "pending"])->default("pending");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs__requests');
    }
};

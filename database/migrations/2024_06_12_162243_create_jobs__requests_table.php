<?php

use App\Models\Company;
use App\Models\Vacancy;
use App\Models\Employee;
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
            $table->foreignIdFor(Company::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(Vacancy::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(Employee::class)->constrained()->onDelete('cascade');
            $table->enum("Statuse", ["Accepted", "Rejected", "pending"]);
            $table->date("request_date");
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

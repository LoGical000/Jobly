<?php

use App\Models\Address;
use App\Models\Jops_section;
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
        Schema::create('vacancies', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Address::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(Jops_section::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(User::class)->constrained()->onDelete('cascade');
            $table->string("description");
            $table->string("image");
            $table->enum("job_type", ["full time", "part time", "remotely"]);
            $table->text("requirements");
            $table->integer("salary_range");
            $table->date("application_deadline");
            $table->enum("status", ["closed", "open"]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};

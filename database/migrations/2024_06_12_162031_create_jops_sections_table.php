<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Jops_category;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('jops_sections', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Jops_category::class)->constrained()->onDelete('cascade');
            $table->string("section");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jops_sections');
    }
};

<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('vendor_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('role');
            $table->string('financial_score');
            $table->string('reputation');
            $table->string('regulatory_proof'); // PDF path
            $table->timestamps();
        });
    }
    public function down() {
        Schema::dropIfExists('vendor_applications');
    }
};

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
        Schema::create('admin', function (Blueprint $table) {
            $table->bigInteger('nik_admin')->primary();
            $table->integer("id_user")->nullable(false);
            $table->string('nama_admin', 50)->nullable(false);
            $table->string('username', 50)->nullable(false);
            $table->bigInteger('no_telp')->nullable(false);
            $table->string("email", 255)->nullable(false);

            $table->foreign("id_user")->references("id_user")->on("user")
                ->onDelete("cascade")->onUpdate("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin');
    }
};

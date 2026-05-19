<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->uuid('id')->change();
            $table->renameColumn('name', 'fullname');
            $table->string('fullname', 150)->change();
            $table->dropColumn('email');
            $table->dropColumn('email_verified_at');
            $table->string('phone_number', 12)->after('password');
            $table->uuid('role_id')->after('phone_number');
            $table->uuid('ypk_id')->nullable()->after('role_id');
            $table->text('user_info')->nullable()->after('ypk_id');
            $table->boolean('is_active')->after('user_info');
            $table->text('avatar_path')->nullable()->after('is_active');
            $table->dropColumn('created_at');
            $table->dropColumn('updated_at');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            $table->foreign('ypk_id')->references('id')->on('ypks')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['role_id']);
            $table->dropForeign(['ypk_id']);
            $table->dropColumn(['phone_number', 'role_id', 'ypk_id', 'user_info', 'is_active', 'avatar_path']);
            $table->renameColumn('fullname', 'name');
            $table->string('name')->change();
            $table->string('email')->unique()->after('name');
            $table->timestamp('email_verified_at')->nullable()->after('email');
            $table->timestamps();
        });
    }
};

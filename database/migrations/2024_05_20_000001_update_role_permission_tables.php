<?php

use App\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('role_user')) {
            Schema::table('role_user', function (Blueprint $table) {
                if (!Schema::hasColumn('role_user', 'model_type')) {
                    $table->string('model_type')->default(User::class)->after('user_id');
                }
            });

            DB::table('role_user')->whereNull('model_type')->update(['model_type' => User::class]);
        }

        if (!Schema::hasTable('model_has_permissions')) {
            Schema::create('model_has_permissions', function (Blueprint $table) {
                $table->unsignedBigInteger('permission_id');
                $table->unsignedBigInteger('model_id');
                $table->string('model_type');
                $table->index(['model_id', 'model_type']);
                $table->foreign('permission_id')->references('id')->on('permissions')->onDelete('cascade');
            });
        }

        // keep existing permission_role structure for backwards compatibility
    }

    public function down(): void
    {
        if (Schema::hasTable('model_has_permissions')) {
            Schema::drop('model_has_permissions');
        }

        if (Schema::hasTable('role_user') && Schema::hasColumn('role_user', 'model_type')) {
            Schema::table('role_user', function (Blueprint $table) {
                $table->dropColumn('model_type');
            });
        }
    }
};

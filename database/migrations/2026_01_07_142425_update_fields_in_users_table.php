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
        Schema::table('users', function (Blueprint $table) {
            // 1. تغيير اسم العمود من name لـ username
            $table->renameColumn('name', 'username');
            
            // 2. حذف عمود الإيميل
            $table->dropColumn('email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // نرجع كل حاجة زي ما كانت لو عملنا rollback
            $table->renameColumn('username', 'name');
            
            // نرجع عمود الإيميل (تأكد من الخصائص زي unique لو كان موجود)
            $table->string('email')->unique();
        });
    }
};
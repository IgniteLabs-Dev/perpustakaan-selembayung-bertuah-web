<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("
            CREATE VIEW view_peminjaman_hampir_jatuh_tempo AS
            SELECT
                users.name AS nama,
                users.email AS email,
                books.title AS book,
                loan_transactions.borrowed_at,
                loan_transactions.due_date,
                CASE 
                    WHEN DATEDIFF(loan_transactions.due_date, CURDATE()) < 0 THEN 0
                    ELSE DATEDIFF(loan_transactions.due_date, CURDATE())
                END AS sisa_hari
            FROM loan_transactions
            JOIN users ON users.id = loan_transactions.user_id
            JOIN books ON books.id = loan_transactions.book_id
            WHERE loan_transactions.status = 'borrowed'
              AND DATEDIFF(loan_transactions.due_date, CURDATE()) = 1
        ");
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('view_peminjaman_hampir_jatuh_tempo');
    }
};

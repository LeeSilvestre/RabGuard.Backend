<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // Creating rental table
    public function up()
    {

    Schema::create('rental', function (Blueprint $table) {
        $table->integer('rental_id')->autoIncrement();
        $table->string('student_id');
        $table->string('Araling_Panlipunan')->nullable();
        $table->string('English')->nullable();
        $table->string('Filipino')->nullable();
        $table->string('MAPEH')->nullable();
        $table->string('Mathematics')->nullable();
        $table->string('Science')->nullable();
        $table->string('TLE')->nullable();
        $table->string('CL')->nullable();
        $table->string('VE')->nullable();
        $table->timestamp('release_date');
        $table->date('return_date')->nullable();
        $table->string('AP_code');
        $table->string('E_code');
        $table->string('F_code');
        $table->string('MA_code');
        $table->string('M_code');
        $table->string('S_code');
        $table->string('T_code');
        $table->string('C_code');
        $table->string('V_code');
        $table->integer('status')->default(0);
        $table->integer('book_title1_damaged')->default(0);
        $table->integer('book_title2_damaged')->default(0);
        $table->integer('book_title3_damaged')->default(0);
        $table->integer('book_title4_damaged')->default(0);
        $table->integer('book_title5_damaged')->default(0);
        $table->integer('book_title6_damaged')->default(0);
        $table->integer('book_title7_damaged')->default(0);
        $table->integer('book_title8_damaged')->default(0);
        $table->integer('book_title9_damaged')->default(0);
        $table->integer('book_title1_lost')->default(0);
        $table->integer('book_title2_lost')->default(0);
        $table->integer('book_title3_lost')->default(0);
        $table->integer('book_title4_lost')->default(0);
        $table->integer('book_title5_lost')->default(0);
        $table->integer('book_title6_lost')->default(0);
        $table->integer('book_title7_lost')->default(0);
        $table->integer('book_title8_lost')->default(0);
        $table->integer('book_title9_lost')->default(0);
        $table->integer('book_title1_fine')->default(0);
        $table->integer('book_title2_fine')->default(0);
        $table->integer('book_title3_fine')->default(0);
        $table->integer('book_title4_fine')->default(0);
        $table->integer('book_title5_fine')->default(0);
        $table->integer('book_title6_fine')->default(0);
        $table->integer('book_title7_fine')->default(0);
        $table->integer('book_title8_fine')->default(0);
        $table->integer('book_title9_fine')->default(0);
        $table->integer('total_fine')->default(0);
        $table->foreign('Araling_Panlipunan')->references('book_title')->on('books')->onDelete('set null')->onUpdate('cascade');
        $table->foreign('English')->references('book_title')->on('books')->onDelete('set null')->onUpdate('cascade');
        $table->foreign('Filipino')->references('book_title')->on('books')->onDelete('set null')->onUpdate('cascade');
        $table->foreign('MAPEH')->references('book_title')->on('books')->onDelete('set null')->onUpdate('cascade');
        $table->foreign('Mathematics')->references('book_title')->on('books')->onDelete('set null')->onUpdate('cascade');
        $table->foreign('Science')->references('book_title')->on('books')->onDelete('set null')->onUpdate('cascade');
        $table->foreign('TLE')->references('book_title')->on('books')->onDelete('set null')->onUpdate('cascade');
        $table->foreign('CL')->references('book_title')->on('books')->onDelete('set null')->onUpdate('cascade');
        $table->foreign('VE')->references('book_title')->on('books')->onDelete('set null')->onUpdate('cascade');
        $table->foreign('student_id')->references('student_id')->on('student_profilings');
    });

    DB::unprepared('
            CREATE TRIGGER `calculate_fines` BEFORE UPDATE ON `rental` FOR EACH ROW BEGIN
                DECLARE damage_fine1, lost_fine1, damage_fine2, lost_fine2, damage_fine3, lost_fine3, damage_fine4, lost_fine4, damage_fine5, lost_fine5, damage_fine6, lost_fine6, damage_fine7, lost_fine7, damage_fine8, lost_fine8, damage_fine9, lost_fine9 INT;

                -- Fetch fines for each borrowed book from the books table
                SELECT b.damaged_fine, b.lost_fine INTO damage_fine1, lost_fine1
                FROM books b
                WHERE b.book_title = NEW.Araling_Panlipunan;

                SELECT b.damaged_fine, b.lost_fine INTO damage_fine2, lost_fine2
                FROM books b
                WHERE b.book_title = NEW.English;

                SELECT b.damaged_fine, b.lost_fine INTO damage_fine3, lost_fine3
                FROM books b
                WHERE b.book_title = NEW.Filipino;

                SELECT b.damaged_fine, b.lost_fine INTO damage_fine4, lost_fine4
                FROM books b
                WHERE b.book_title = NEW.MAPEH;

                SELECT b.damaged_fine, b.lost_fine INTO damage_fine5, lost_fine5
                FROM books b
                WHERE b.book_title = NEW.Mathematics;

                SELECT b.damaged_fine, b.lost_fine INTO damage_fine6, lost_fine6
                FROM books b
                WHERE b.book_title = NEW.Science;

                SELECT b.damaged_fine, b.lost_fine INTO damage_fine7, lost_fine7
                FROM books b
                WHERE b.book_title = NEW.TLE;

                SELECT b.damaged_fine, b.lost_fine INTO damage_fine8, lost_fine8
                FROM books b
                WHERE b.book_title = NEW.CL;

                SELECT b.damaged_fine, b.lost_fine INTO damage_fine9, lost_fine9
                FROM books b
                WHERE b.book_title = NEW.VE;

                -- Calculate fines for each book title based on the book status
                SET NEW.book_title1_fine = IF(NEW.book_title1_damaged = 1, damage_fine1, 0) + IF(NEW.book_title1_lost = 1, lost_fine1, 0);
                SET NEW.book_title2_fine = IF(NEW.book_title2_damaged = 1, damage_fine2, 0) + IF(NEW.book_title2_lost = 1, lost_fine2, 0);
                SET NEW.book_title3_fine = IF(NEW.book_title3_damaged = 1, damage_fine3, 0) + IF(NEW.book_title3_lost = 1, lost_fine3, 0);
                SET NEW.book_title4_fine = IF(NEW.book_title4_damaged = 1, damage_fine4, 0) + IF(NEW.book_title4_lost = 1, lost_fine4, 0);
                SET NEW.book_title5_fine = IF(NEW.book_title5_damaged = 1, damage_fine5, 0) + IF(NEW.book_title5_lost = 1, lost_fine5, 0);
                SET NEW.book_title6_fine = IF(NEW.book_title6_damaged = 1, damage_fine6, 0) + IF(NEW.book_title6_lost = 1, lost_fine6, 0);
                SET NEW.book_title7_fine = IF(NEW.book_title7_damaged = 1, damage_fine7, 0) + IF(NEW.book_title7_lost = 1, lost_fine7, 0);
                SET NEW.book_title8_fine = IF(NEW.book_title8_damaged = 1, damage_fine8, 0) + IF(NEW.book_title8_lost = 1, lost_fine8, 0);
                SET NEW.book_title9_fine = IF(NEW.book_title9_damaged = 1, damage_fine9, 0) + IF(NEW.book_title9_lost = 1, lost_fine9, 0);

                -- Sum up the total fine
                SET NEW.total_fine = NEW.book_title1_fine + NEW.book_title2_fine + NEW.book_title3_fine + NEW.book_title4_fine + NEW.book_title5_fine + NEW.book_title6_fine + NEW.book_title7_fine + NEW.book_title8_fine + NEW.book_title9_fine;
            END;
        ');

    

    /**
     * Reverse the migrations.
     */
}
    public function down(): void
    {
        Schema::dropIfExists('meow');
    }
};

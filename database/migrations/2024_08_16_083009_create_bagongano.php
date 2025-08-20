<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {

        Schema::create('book_category', function (Blueprint $table) {
            $table->string('categ_name')->primary();
            $table->boolean('is_archived')->default(0);
            $table->integer('book_ddc');
        });

        Schema::create('books', function (Blueprint $table) {
            $table->string('book_title')->primary();
            $table->string('book_code');
            $table->string('book_auth');
            $table->string('categ_name');
            $table->integer('book_qty');
            $table->boolean('is_archived')->default(0);
            $table->text('reason')->nullable();
            $table->date('pub_date')->default('1970-01-01');
            $table->string('copyright_owner');
            $table->integer('lost_fine')->default(0);
            $table->integer('damaged_fine')->default(0);
            $table->integer('borrowed')->default(0);
            $table->integer('damaged')->default(0);
            $table->integer('lost')->default(0);
            $table->foreign('categ_name')->references('categ_name')->on('book_category');
        });



        // Creating borrowed_books table
        Schema::create('borrowed_books', function (Blueprint $table) {
            $table->integer('borrow_id')->autoIncrement();
            $table->string('book_title');
            $table->string('student_id');
            $table->timestamp('borrowed_date')->useCurrent(); 
            $table->date('return_duedate');
            $table->integer('borrow_status')->default(0);
            $table->string('access_no', 11);
            $table->timestamp('return_date')->nullable();
            $table->integer('total_fine')->default(0);
            $table->foreign('book_title')->references('book_title')->on('books');
            $table->foreign('student_id')->references('student_id')->on('student_profilings');
        });



        // Creating faculty_borrow table
        Schema::create('faculty_borrow', function (Blueprint $table) {
            $table->integer('borrow_id')->autoIncrement();
            $table->string('book_title');
            $table->unsignedBigInteger('id');
            $table->timestamp('borrowed_date')->useCurrent(); 
            $table->date('return_duedate');
            $table->integer('borrow_status')->default(0);
            $table->string('access_no');
            $table->timestamp('return_date')->nullable();
            $table->integer('total_fine')->default(0);
            $table->foreign('book_title')->references('book_title')->on('books');
            $table->foreign('id')->references('id')->on('faculty_profile');
        });

        // Creating librarian table
        Schema::create('librarian', function (Blueprint $table) {
            $table->integer('lib_id')->autoIncrement();
            $table->string('lib_email');
            $table->string('lib_pass');
        });

        // Creating library_status table
        Schema::create('library_status', function (Blueprint $table) {
            $table->string('student_id');
            $table->enum('status', ['Not Yet Cleared', 'Cleared'])->default('Cleared');
            $table->primary('student_id');
            $table->foreign('student_id')->references('student_id')->on('student_profilings');
        });

        // Creating logging table
        Schema::create('logging', function (Blueprint $table) {
            $table->integer('log_id')->autoIncrement();
            $table->string('student_id');
            $table->timestamp('login_time');
            $table->timestamp('logout_time')->nullable();
            $table->integer('status')->default(0);
            $table->date('login_date');
            $table->foreign('student_id')->references('student_id')->on('student_profilings');
        });

        // Creating rental table
        // Schema::create('rental', function (Blueprint $table) {
        //     $table->integer('rental_id')->autoIncrement();
        //     $table->string('student_id');
        //     $table->string('Araling_Panlipunan')->nullable();
        //     $table->string('English')->nullable();
        //     $table->string('Filipino')->nullable();
        //     $table->string('MAPEH')->nullable();
        //     $table->string('Mathematics')->nullable();
        //     $table->string('Science')->nullable();
        //     $table->string('TLE')->nullable();
        //     $table->string('CL')->nullable();
        //     $table->string('VE')->nullable();
        //     $table->timestamp('release_date');
        //     $table->date('return_date')->nullable();
        //     $table->string('AP_code');
        //     $table->string('E_code');
        //     $table->string('F_code');
        //     $table->string('MA_code');
        //     $table->string('M_code');
        //     $table->string('S_code');
        //     $table->string('T_code');
        //     $table->string('C_code');
        //     $table->string('V_code');
        //     $table->integer('status')->default(0);
        //     $table->integer('book_title1_damaged')->default(0);
        //     $table->integer('book_title2_damaged')->default(0);
        //     $table->integer('book_title3_damaged')->default(0);
        //     $table->integer('book_title4_damaged')->default(0);
        //     $table->integer('book_title5_damaged')->default(0);
        //     $table->integer('book_title6_damaged')->default(0);
        //     $table->integer('book_title7_damaged')->default(0);
        //     $table->integer('book_title8_damaged')->default(0);
        //     $table->integer('book_title9_damaged')->default(0);
        //     $table->integer('book_title1_lost')->default(0);
        //     $table->integer('book_title2_lost')->default(0);
        //     $table->integer('book_title3_lost')->default(0);
        //     $table->integer('book_title4_lost')->default(0);
        //     $table->integer('book_title5_lost')->default(0);
        //     $table->integer('book_title6_lost')->default(0);
        //     $table->integer('book_title7_lost')->default(0);
        //     $table->integer('book_title8_lost')->default(0);
        //     $table->integer('book_title9_lost')->default(0);
        //     $table->integer('book_title1_fine')->default(0);
        //     $table->integer('book_title2_fine')->default(0);
        //     $table->integer('book_title3_fine')->default(0);
        //     $table->integer('book_title4_fine')->default(0);
        //     $table->integer('book_title5_fine')->default(0);
        //     $table->integer('book_title6_fine')->default(0);
        //     $table->integer('book_title7_fine')->default(0);
        //     $table->integer('book_title8_fine')->default(0);
        //     $table->integer('book_title9_fine')->default(0);
        //     $table->integer('total_fine')->default(0);
        //     $table->foreign('Araling_Panlipunan')->references('book_title')->on('books')->onDelete('set null')->onUpdate('cascade');
        //     $table->foreign('English')->references('book_title')->on('books')->onDelete('set null')->onUpdate('cascade');
        //     $table->foreign('Filipino')->references('book_title')->on('books')->onDelete('set null')->onUpdate('cascade');
        //     $table->foreign('MAPEH')->references('book_title')->on('books')->onDelete('set null')->onUpdate('cascade');
        //     $table->foreign('Mathematics')->references('book_title')->on('books')->onDelete('set null')->onUpdate('cascade');
        //     $table->foreign('Science')->references('book_title')->on('books')->onDelete('set null')->onUpdate('cascade');
        //     $table->foreign('TLE')->references('book_title')->on('books')->onDelete('set null')->onUpdate('cascade');
        //     $table->foreign('CL')->references('book_title')->on('books')->onDelete('set null')->onUpdate('cascade');
        //     $table->foreign('VE')->references('book_title')->on('books')->onDelete('set null')->onUpdate('cascade');
        //     $table->foreign('student_id')->references('student_id')->on('student_profilings');
        // });



        DB::statement('SET GLOBAL event_scheduler = ON;');

        DB::unprepared('
            CREATE TRIGGER `update_borrow_status` BEFORE UPDATE ON `borrowed_books` FOR EACH ROW BEGIN
                IF NEW.borrow_status = 0 AND NOW() > NEW.return_duedate THEN
                    SET NEW.borrow_status = 1;
                END IF;
            END;
        ');

        DB::unprepared('
            CREATE TRIGGER `update_damagereturn_date` BEFORE UPDATE ON `borrowed_books` FOR EACH ROW BEGIN
                IF NEW.borrow_status = 3 AND OLD.return_date IS NULL THEN
                    SET NEW.return_date = NOW();
                END IF;
            END;
        ');

        DB::unprepared('
            CREATE TRIGGER `update_library_status` AFTER INSERT ON `borrowed_books` FOR EACH ROW BEGIN
                DECLARE borrow_count INT;

                SELECT COUNT(*)
                INTO borrow_count
                FROM borrowed_books
                WHERE student_id = NEW.student_id AND borrow_status IN (0, 1);

                UPDATE library_status
                SET status = CASE
                                WHEN borrow_count > 0 THEN \'Not Yet Cleared\'
                                ELSE \'Cleared\'
                             END
                WHERE student_id = NEW.student_id;
            END;
        ');

        DB::unprepared('
            CREATE TRIGGER `update_library_status_update` AFTER UPDATE ON `borrowed_books` FOR EACH ROW BEGIN
                DECLARE borrow_count INT;

                SELECT COUNT(*)
                INTO borrow_count
                FROM borrowed_books
                WHERE student_id = NEW.student_id AND borrow_status IN (0, 1);

                UPDATE library_status
                SET status = CASE
                                WHEN borrow_count > 0 THEN \'Not Yet Cleared\'
                                ELSE \'Cleared\'
                             END
                WHERE student_id = NEW.student_id;
            END;
        ');

        DB::unprepared('
            CREATE TRIGGER `update_return_date` BEFORE UPDATE ON `borrowed_books` FOR EACH ROW BEGIN
                IF NEW.borrow_status = 2 AND OLD.return_date IS NULL THEN
                    SET NEW.return_date = NOW();
                END IF;
            END;
        ');

        DB::unprepared('
            CREATE TRIGGER `update_damagedfaculty_return_date` BEFORE UPDATE ON `faculty_borrow` FOR EACH ROW BEGIN
                IF NEW.borrow_status = 3 AND OLD.return_date IS NULL THEN
                    SET NEW.return_date = NOW();
                END IF;
            END;
        ');

        DB::unprepared('
            CREATE TRIGGER `update_faculty_borrow_status` BEFORE UPDATE ON `faculty_borrow` FOR EACH ROW BEGIN
                IF NEW.borrow_status = 0 AND NOW() > NEW.return_duedate THEN
                    SET NEW.borrow_status = 1;
                END IF;
            END;
        ');

        DB::unprepared('
            CREATE TRIGGER `update_faculty_return_date` BEFORE UPDATE ON `faculty_borrow` FOR EACH ROW BEGIN
                IF NEW.borrow_status = 2 AND OLD.return_date IS NULL THEN
                    SET NEW.return_date = NOW();
                END IF;
            END;
        ');

        // DB::unprepared('
        //     CREATE TRIGGER `calculate_fines` BEFORE UPDATE ON `rental` FOR EACH ROW BEGIN
        //         DECLARE damage_fine1, lost_fine1, damage_fine2, lost_fine2, damage_fine3, lost_fine3, damage_fine4, lost_fine4, damage_fine5, lost_fine5, damage_fine6, lost_fine6, damage_fine7, lost_fine7, damage_fine8, lost_fine8, damage_fine9, lost_fine9 INT;

        //         -- Fetch fines for each borrowed book from the books table
        //         SELECT b.damaged_fine, b.lost_fine INTO damage_fine1, lost_fine1
        //         FROM books b
        //         WHERE b.book_title = NEW.Araling_Panlipunan;

        //         SELECT b.damaged_fine, b.lost_fine INTO damage_fine2, lost_fine2
        //         FROM books b
        //         WHERE b.book_title = NEW.English;

        //         SELECT b.damaged_fine, b.lost_fine INTO damage_fine3, lost_fine3
        //         FROM books b
        //         WHERE b.book_title = NEW.Filipino;

        //         SELECT b.damaged_fine, b.lost_fine INTO damage_fine4, lost_fine4
        //         FROM books b
        //         WHERE b.book_title = NEW.MAPEH;

        //         SELECT b.damaged_fine, b.lost_fine INTO damage_fine5, lost_fine5
        //         FROM books b
        //         WHERE b.book_title = NEW.Mathematics;

        //         SELECT b.damaged_fine, b.lost_fine INTO damage_fine6, lost_fine6
        //         FROM books b
        //         WHERE b.book_title = NEW.Science;

        //         SELECT b.damaged_fine, b.lost_fine INTO damage_fine7, lost_fine7
        //         FROM books b
        //         WHERE b.book_title = NEW.TLE;

        //         SELECT b.damaged_fine, b.lost_fine INTO damage_fine8, lost_fine8
        //         FROM books b
        //         WHERE b.book_title = NEW.CL;

        //         SELECT b.damaged_fine, b.lost_fine INTO damage_fine9, lost_fine9
        //         FROM books b
        //         WHERE b.book_title = NEW.VE;

        //         -- Calculate fines for each book title based on the book status
        //         SET NEW.book_title1_fine = IF(NEW.book_title1_damaged = 1, damage_fine1, 0) + IF(NEW.book_title1_lost = 1, lost_fine1, 0);
        //         SET NEW.book_title2_fine = IF(NEW.book_title2_damaged = 1, damage_fine2, 0) + IF(NEW.book_title2_lost = 1, lost_fine2, 0);
        //         SET NEW.book_title3_fine = IF(NEW.book_title3_damaged = 1, damage_fine3, 0) + IF(NEW.book_title3_lost = 1, lost_fine3, 0);
        //         SET NEW.book_title4_fine = IF(NEW.book_title4_damaged = 1, damage_fine4, 0) + IF(NEW.book_title4_lost = 1, lost_fine4, 0);
        //         SET NEW.book_title5_fine = IF(NEW.book_title5_damaged = 1, damage_fine5, 0) + IF(NEW.book_title5_lost = 1, lost_fine5, 0);
        //         SET NEW.book_title6_fine = IF(NEW.book_title6_damaged = 1, damage_fine6, 0) + IF(NEW.book_title6_lost = 1, lost_fine6, 0);
        //         SET NEW.book_title7_fine = IF(NEW.book_title7_damaged = 1, damage_fine7, 0) + IF(NEW.book_title7_lost = 1, lost_fine7, 0);
        //         SET NEW.book_title8_fine = IF(NEW.book_title8_damaged = 1, damage_fine8, 0) + IF(NEW.book_title8_lost = 1, lost_fine8, 0);
        //         SET NEW.book_title9_fine = IF(NEW.book_title9_damaged = 1, damage_fine9, 0) + IF(NEW.book_title9_lost = 1, lost_fine9, 0);

        //         -- Sum up the total fine
        //         SET NEW.total_fine = NEW.book_title1_fine + NEW.book_title2_fine + NEW.book_title3_fine + NEW.book_title4_fine + NEW.book_title5_fine + NEW.book_title6_fine + NEW.book_title7_fine + NEW.book_title8_fine + NEW.book_title9_fine;
        //     END;
        // ');

        DB::unprepared('
            CREATE DEFINER=`root`@`localhost` EVENT `update_fines_event` 
            ON SCHEDULE EVERY 10 SECOND 
            STARTS \'2024-08-04 22:16:36\' 
            ON COMPLETION NOT PRESERVE ENABLE 
            DO BEGIN
                UPDATE borrowed_books bb
                LEFT JOIN books b ON bb.book_title = b.book_title
                SET bb.total_fine = (
                    CASE
                        WHEN CURRENT_DATE > bb.return_duedate AND bb.borrow_status <> 6 THEN DATEDIFF(CURRENT_DATE, bb.return_duedate) * 5
                        ELSE 0
                    END
                    + CASE
                        WHEN bb.borrow_status = 5 THEN b.damaged_fine
                        WHEN bb.borrow_status = 6 THEN b.lost_fine
                        ELSE 0
                    END
                );
            END;
        ');

        DB::unprepared('
            CREATE DEFINER=`root`@`localhost` EVENT `check_overdue_fines` 
            ON SCHEDULE EVERY 10 SECOND 
            STARTS \'2024-08-04 22:24:52\' 
            ON COMPLETION NOT PRESERVE ENABLE 
            DO BEGIN
                UPDATE borrowed_books bb
                LEFT JOIN books b ON bb.book_title = b.book_title
                SET bb.total_fine = CASE
                    WHEN bb.borrow_status = 6 THEN b.lost_fine
                    WHEN bb.borrow_status = 5 THEN
                        CASE
                            WHEN bb.return_duedate < CURRENT_DATE THEN DATEDIFF(CURRENT_DATE, bb.return_duedate) * 5 + b.damaged_fine
                            ELSE b.damaged_fine
                        END
                    ELSE
                        CASE
                            WHEN bb.return_duedate < CURRENT_DATE THEN DATEDIFF(CURRENT_DATE, bb.return_duedate) * 5
                            ELSE 0
                        END
                END;
            END;
        ');

        DB::unprepared('
            CREATE DEFINER=`root`@`localhost` EVENT `check_overdue_fines_faculty` 
            ON SCHEDULE EVERY 10 SECOND 
            STARTS \'2024-08-05 13:52:17\' 
            ON COMPLETION NOT PRESERVE ENABLE 
            DO BEGIN
                UPDATE faculty_borrow fb
                LEFT JOIN books b ON fb.book_title = b.book_title
                SET fb.total_fine = CASE
                    WHEN fb.borrow_status = 6 THEN b.lost_fine
                    WHEN fb.borrow_status = 5 THEN
                        CASE
                            WHEN fb.return_duedate < CURRENT_DATE THEN DATEDIFF(CURRENT_DATE, fb.return_duedate) * 5 + b.damaged_fine
                            ELSE b.damaged_fine
                        END
                    ELSE
                        CASE
                            WHEN fb.return_duedate < CURRENT_DATE THEN DATEDIFF(CURRENT_DATE, fb.return_duedate) * 5
                            ELSE 0
                        END
                END;
            END;
        ');
    }

    public function down()
    {
        // Dropping triggers
        DB::unprepared('DROP TRIGGER IF EXISTS `update_borrow_status`');
        DB::unprepared('DROP TRIGGER IF EXISTS `update_damagereturn_date`');
        DB::unprepared('DROP TRIGGER IF EXISTS `update_library_status`');
        DB::unprepared('DROP TRIGGER IF EXISTS `update_library_status_update`');
        DB::unprepared('DROP TRIGGER IF EXISTS `update_return_date`');
        DB::unprepared('DROP TRIGGER IF EXISTS `update_damagedfaculty_return_date`');
        DB::unprepared('DROP TRIGGER IF EXISTS `update_faculty_borrow_status`');
        DB::unprepared('DROP TRIGGER IF EXISTS `update_faculty_return_date`');
        DB::unprepared('DROP TRIGGER IF EXISTS `calculate_fines`');

        // Dropping events
        DB::unprepared('DROP EVENT IF EXISTS `update_fines_event`');
        DB::unprepared('DROP EVENT IF EXISTS `check_overdue_fines`');
        DB::unprepared('DROP EVENT IF EXISTS `check_overdue_fines_faculty`');

        Schema::dropIfExists('rental');
        Schema::dropIfExists('library_status');
        Schema::dropIfExists('librarian');
        Schema::dropIfExists('faculty_borrow');
        Schema::dropIfExists('borrowed_books');
        Schema::dropIfExists('book_category');
        Schema::dropIfExists('books');
    }
};

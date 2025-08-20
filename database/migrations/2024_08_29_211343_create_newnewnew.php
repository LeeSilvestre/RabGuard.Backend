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

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    }
};

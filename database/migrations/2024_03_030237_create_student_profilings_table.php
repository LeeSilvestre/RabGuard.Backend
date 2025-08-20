
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
        Schema::create('student_profilings', function (Blueprint $table) {
            $table->bigIncrements('student_recno');
            $table->string('student_id', 11)->unique()->nullable();


            //############### FILLABLES ##########################
            $table->string('student_lrn',12)->unique()->nullable();
            $table->string('email')->unique('email');
            // STUDENT FULLNAME
            $table->string('first_name');
            $table->string('last_name');
            $table->string('middle_name')->nullable();
            $table->string('extension')->nullable();

            /*Gender*/ $table->enum('sex_at_birth', ['male', 'female'])->default('male');

            //Birth details
            $table->date('birth_date');
            // $table->string('birth_place');

            //Address
            $table->string('region', 5)->nullable();
            $table->string('province', 50)->nullable();
            $table->string('city', 50)->nullable();
            $table->string('barangay', 50)->nullable();
            $table->string('street', 50)->nullable();
            $table->string('zip_code', 50)->nullable();

            // CONTACT DETAILS
            $table->string('contact_no',11)->nullable();

            // RELIGION
            $table->string('religion', 50);

            // GUARDIAN DETAILS
            $table->string('guardian',50)->nullable();
            $table->string('guardian_mobileno',11)->nullable();

            // ACADEMIC DETAILS
             // school year column
             $table->string('year')->default(date('Y'));
             $table->enum('strand',[
                'STEM',
                'HUMSS',
                'GAS',
                'ABM',
                'HE',
                'N/A'
             ])->default('N/A');
             $table->integer('grade_level')->nullable();
             $table->enum('section', [
                'St. Anne',
                'St. Bernadette',
                'St. Charles',
                'St. Elizabeth',
                'St. Faustina',
                'St. George',
                'St. Pedro Calungsod',
                'St. Lorenzo Ruiz',
                'St. Gabriel',
                'St. Michael',
                'St. Raphael',
                'St. Patrick',
                'St. Scholastica',
                'St. Homobonus',
                'St. Helena',
                'St. Louise',
                'St. Stephen',
                'St. Vincent',
                'St. Catherine',
                'St. Albertus',
                'St. Benedict',
                'St. Maximillian',
                'St. Peter',
                'St. Thomas',
                'St. Isidore',
                'St. Joseph',
              ])->default(null);
             // adviser column
             $table->unsignedBigInteger('adviser_id')->nullable();
             $table->foreign('adviser_id')->references('id')->on('faculty_profile');
             // enrollment status
             $table->enum('enrollment_status',['Verified','Assessed','Enrolled','Pending'])->default('Pending');
             $table->timestamp('enrollment_date')->userCurret();

            //  STUDENT IMAGE
            $table->mediumText('image')->nullable();
            // Status and other details
            $table->boolean('is_student')->default(false);
            $table->foreignId('user_id')->nullable(true)->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_profilings');
    }
};

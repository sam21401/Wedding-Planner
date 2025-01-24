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
            Schema::create('tasks', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->text('description')->nullable();
                $table->enum('status', ['todo', 'in_progress', 'problem', 'done'])->default('todo');
                $table->date('deadline')->nullable();
                //$table->unsignedBigInteger('post_id');
                //$table->foreign('post_id')->references('id')->on('posts')->cascadeOnDelete();
                $table->unsignedBigInteger('responsible_user_id')->nullable();
                $table->foreign('responsible_user_id')->references('id')->on('users')->nullOnDelete();
                $table->timestamps();
            });
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::dropIfExists('tasks');
        }
    };

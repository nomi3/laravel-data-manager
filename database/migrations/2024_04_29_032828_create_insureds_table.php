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
        Schema::create('insureds', function (Blueprint $table) {
            $table->uuid('id')->primary(); // UUID
            $table->string('name')->comment('漢字氏名'); // 漢字氏名
            $table->string('first_name_kana')->comment('カナ（名）'); // カナ（名）
            $table->string('last_name_kana'); // カナ（姓）
            $table->integer('insurance_card_symbol'); // 保険証記号
            $table->integer('insurance_card_number'); // 保険証番号
            $table->string('email')->nullable(); // メールアドレス
            $table->string('principal_insurer'); // 委託元保険者
            $table->string('affiliated_insurer'); // 所属保険者
            $table->integer('insurer_number'); // 保険者番号
            $table->string('support_level'); // 支援レベル
            $table->string('gender'); // 性別
            $table->date('birth_date'); // 生年月日
            $table->integer('age'); // 年齢
            $table->date('checkup_date'); // 健診日
            $table->decimal('height', 4, 1); // 身長
            $table->decimal('weight', 4, 1); // 健診時体重
            $table->decimal('bmi', 3, 1); // BMI
            $table->decimal('waist', 4, 1); // 健診時腹囲
            $table->integer('systolic1'); // 収縮期1
            $table->integer('systolic2')->nullable(); // 収縮期2
            $table->integer('systolic_other')->nullable(); // 収縮期その他
            $table->integer('diastolic1'); // 拡張期1
            $table->integer('diastolic2')->nullable(); // 拡張期2
            $table->integer('diastolic_other')->nullable(); // 拡張期その他
            $table->integer('triglycerides'); // 中性脂肪
            $table->integer('fasting_triglycerides')->nullable(); // 空腹時中性脂肪
            $table->integer('casual_triglycerides')->nullable(); // 随時中性脂肪
            $table->integer('hdl_cholesterol'); // HDL
            $table->integer('ldl_cholesterol'); // LDL
            $table->integer('got'); // GOT
            $table->integer('gpt'); // GPT
            $table->integer('gamma_gt'); // γ-GT
            $table->integer('fasting_glucose'); // 空腹時血糖
            $table->integer('casual_glucose')->nullable(); // 随時血糖
            $table->decimal('hba1c', 3, 1)->nullable(); // HBA1C
            $table->boolean('medication1'); // 服薬1
            $table->boolean('medication2'); // 服薬2
            $table->boolean('medication3'); // 服薬3
            $table->boolean('smoking'); // 喫煙
            $table->date('initial_interview_date'); // 初回面談日
            $table->time('initial_interview_time'); // 初回面談時間
            $table->text('characteristics')->nullable(); // 対象者の特徴
            $table->datetimes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('insureds');
    }
};

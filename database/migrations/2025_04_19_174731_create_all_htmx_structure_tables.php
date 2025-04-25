<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Faker\Factory as Faker;
use App\Models\Structure\Email;
use App\Models\Structure\Person;
use App\Models\Structure\Tag;
use App\Models\Structure\Campaign;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

return new class extends Migration
{
    public function up(): void
    {
        $path = database_path('structure.sqlite');

        if (!file_exists($path)) {
            file_put_contents($path, '');
        }

        Schema::connection('structure')->create('people', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('city');
            $table->timestamps();
        });

        Schema::connection('structure')->create('tags', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::connection('structure')->create('campaigns', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::connection('structure')->create('emails', function (Blueprint $table) {
            $table->id();
            $table->string('subject');
            $table->string('from');
            $table->string('to');
            $table->string('status');
            $table->text('full_text');
            $table->timestamps();
        });

        // Pivot tables (simple versions)
        Schema::connection('structure')->create('email_person', function (Blueprint $table) {
            $table->id();
            $table->foreignId('email_id')->constrained()->onDelete('cascade');
            $table->foreignId('person_id')->constrained()->onDelete('cascade');
        });

        Schema::connection('structure')->create('email_tag', function (Blueprint $table) {
            $table->id();
            $table->foreignId('email_id')->constrained()->onDelete('cascade');
            $table->foreignId('tag_id')->constrained()->onDelete('cascade');
        });

        Schema::connection('structure')->create('campaign_email', function (Blueprint $table) {
            $table->id();
            $table->foreignId('email_id')->constrained()->onDelete('cascade');
            $table->foreignId('campaign_id')->constrained()->onDelete('cascade');
        });

        $faker = Faker::create();

        // 1. People
        for ($i = 0; $i < 1000; $i++) {
            $person = new Person;
            $person->name = $faker->name;
            $person->city = $faker->city;
            $person->save();
        }

        // 2. Tags
        $existing = [];
        for ($i = 0; $i < 50; $i++) {

            $tagname = collect(explode(' ', ucwords($faker->bs())))->random();
            while (in_array($tagname, $existing)) {
                $tagname = collect(explode(' ', ucwords($faker->bs())))->random();
            }
            $existing[] = $tagname;
            $tag = new Tag;
            $tag->name = $tagname;
            $tag->save();
        }

        // 3. Campaigns
        for ($i = 0; $i < 20; $i++) {
            $campaign = new Campaign;
            $campaign->name = $faker->catchPhrase;
            $campaign->save();
        }

        // 4. Emails
        for ($i = 0; $i < 1000; $i++) {
            $email = new Email;
            $email->subject = $faker->bs();
            $email->from = $faker->email;
            $email->to = $faker->email;
            $email->status = $faker->randomElement(['active', 'complete']);
            $length = rand(300, 800);
            $email->full_text = $faker->realText($length);
            $randomback = rand(1, 200);
            $email->created_at = Carbon::today()->subDays($randomback);
            $email->updated_at = Carbon::today()->subDays($randomback);
            $email->save();
        }
    }

    public function down(): void
    {
        Schema::connection('structure')->dropIfExists('campaign_email');
        Schema::connection('structure')->dropIfExists('email_tag');
        Schema::connection('structure')->dropIfExists('email_person');
        Schema::connection('structure')->dropIfExists('emails');
        Schema::connection('structure')->dropIfExists('campaigns');
        Schema::connection('structure')->dropIfExists('tags');
        Schema::connection('structure')->dropIfExists('people');
    }
};

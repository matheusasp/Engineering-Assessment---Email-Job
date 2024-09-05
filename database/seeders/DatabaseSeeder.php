<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

         \App\Models\User::factory()->create([
             'name' => 'Test User',
             'email' => 'test@example.com',
             'password' => bcrypt('1234'),
         ]);

         DB::table('successful_emails')->insert([
            [
                'affiliate_id' => 1,
                'envelope' => '{"to":["recipient@example.com"],"from":"sender@example.com"}',
                'from' => 'sender@example.com',
                'subject' => 'Welcome to Our Service',
                'dkim' => 'pass',
                'SPF' => 'pass',
                'spam_score' => 0.1,
                'email' => "From: sender@example.com <br> To: recipient@example.com <br> Subject: Welcome to Our Service <br> This is a test email content with <b>HTML</b> tags.",
                'raw_text' => '',
                'sender_ip' => '192.168.1.1',
                'to' => 'recipient@example.com',
                'timestamp' => time(),
            ],
            [
                'affiliate_id' => 2,
                'envelope' => '{"to":["anotherrecipient@example.com"],"from":"another@example.com"}',
                'from' => 'another@example.com',
                'subject' => 'Your Order Confirmation',
                'dkim' => 'pass',
                'SPF' => 'pass',
                'spam_score' => 0.2,
                'email' => "From: another@example.com <br> To: anotherrecipient@example.com<br>Subject: Your Order Confirmation<br><br>Thank you for your order. Here are the details...",
                'raw_text' => '',
                'sender_ip' => '192.168.1.2',
                'to' => 'anotherrecipient@example.com',
                'timestamp' => time(),
            ],
        ]);
    }
}

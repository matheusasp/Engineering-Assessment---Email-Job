<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProcessEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'emails:process';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process and parse raw email content to extract plain text.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
 
        $emails = DB::table('successful_emails')
            ->whereNull('raw_text')
            ->orWhere('raw_text', '')
            ->get();
        
        foreach ($emails as $email) {

            $plainText = $this->extractPlainText($email->email);

            DB::table('successful_emails')
                ->where('id', $email->id)
                ->update(['raw_text' => $plainText]);

            $this->info("Processed email ID: {$email->id}");
        }

        return 0;
    }

    /**
     *
     * @param string $emailContent
     * @return string
     */
    protected function extractPlainText($emailContent)
    {
        $plainText = strip_tags($emailContent);

        $plainText = preg_replace('/\s+/', ' ', $plainText);
        $plainText = trim($plainText);
        $plainText = Str::of($plainText)->replaceMatches('/\n{2,}/', "\n")->toString();

        return $plainText;
    }
}

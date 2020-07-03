<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class DuskFailureMailer extends Mailable
{
    use Queueable;
    use SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $storage = Storage::disk('test_browser');
        $files = $storage->allFiles('screenshots');
        $ignoreFiles = ['.DS_Store', '.gitignore'];
        $formattedFiles = [];
        foreach ($files as $file) {
            $fileName = explode(DIRECTORY_SEPARATOR, $file);
            $fileName = end($fileName);
            if (!in_array($fileName, $ignoreFiles)) {
                $formattedFiles[] = $storage->path($file);
            }
        }
        return $this->view(
            'email.duskFailure',
            [
            'files' => $formattedFiles
            ]
        );
    }
}

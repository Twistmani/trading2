<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class BackupDatabase extends Command
{
    protected $signature = 'db:backup';

    protected $description = 'Backup the database';

    protected $process;

    public function __construct()
    {
        parent::__construct();

        //$this->process = new Process('mysqldump -uroot -p numaktec_stockloc > D:\DB\obtst.sql');
		$this->process = new Process("\"D:\\xampp\\mysql\\bin\\mysqldump.exe\" -uobaidroot -pobaid@123  obaiid > D:\DataBackup\obaiid.sql");
    }

    public function handle()
    {
        try {
            $this->process->mustRun();

            $this->info('The backup has been proceed successfully.');
        } catch (ProcessFailedException $exception) {
            $this->error('The backup process has been failed.');
        }
    }
}
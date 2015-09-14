<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;

class toggleStatus extends Job implements SelfHandling, ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $currentStatus;
    protected $model;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($model, $repo, $status)
    {
        $this->model = $model;
        $this->repo = $repo;
        $this->currentStatus = (int)$status;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $toStatus = ($this->currentStatus === 1) ? 0 : 1;
        $this->repo->update($this->model->id, ['published' => $toStatus]);
    }
}

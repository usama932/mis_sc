<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\BenficiaryAssessment;
use App\Models\User;
use App\Mail\BeneficiaryStatusChanged;
use Illuminate\Support\Facades\Mail;
use Exception;

class ProcessBeneficiaryAction implements ShouldQueue
{
    use Queueable, InteractsWithQueue, SerializesModels;

    protected $actionType;
    protected $beneficiaryIds;
    protected $authUser;

    public function __construct($actionType, $beneficiaryIds, User $authUser)
    {
        $this->actionType = $actionType;
        $this->beneficiaryIds = $beneficiaryIds;
        $this->authUser = $authUser;
    }


    public function handle(): void
    {
        $errorRecords = [];

        foreach ($this->beneficiaryIds as $id) {
            try {
                $beneficiary = BenficiaryAssessment::findOrFail($id);
                $beneficiary->status = $this->actionType;
                $beneficiary->save();

                // Send an email to the next approver
                Mail::to('next_approver@example.com')->queue(new BeneficiaryStatusChanged($beneficiary));
            } catch (Exception $e) {
                $errorRecords[] = $id;
            }
        }

        // Send an error report to the authorized user
        if (!empty($errorRecords)) {
            Mail::to($this->authUser->email)->queue(new ErrorProcessingRecords($errorRecords));
        }
    }
}

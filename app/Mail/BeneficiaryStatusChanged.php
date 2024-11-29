namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Beneficiary;


class BeneficiaryStatusChanged extends Mailable
{
    use Queueable, SerializesModels;

    public $beneficiary;

    /**
     * Create a new message instance.
     *
     * @param Beneficiary $beneficiary
     */
    public function __construct(Beneficiary $beneficiary)
    {
        $this->beneficiary = $beneficiary;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.beneficiary.status')
                    ->subject("Beneficiary Status Updated: {$this->beneficiary->name}");
    }
}

<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use App\Models\CustomerNotification;
use App\Services\Notification;
use Illuminate\Support\Facades\Log;

class ScheduledNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scheduled:notification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $now = Carbon::now()->format('Y-m-d H:i:00');

        $notifications = CustomerNotification::where('send_at', $now)->get();

        foreach ($notifications as $notification) {
            $this->sendNotification($notification);
        }
    }

    public function sendNotification($notification)
    {
        try {
            if ($notification->customer->fcm_token) {
                $tokens = [];

                array_push($tokens, $notification->customer->fcm_token);

                $notify = new Notification($tokens, $notification->title, $notification->content);
                $notify->send();
            }
        } catch (\Exception $e) {
            Log::error('Faild due to: scheduled:notification', ["context" => $e->getMessage()]);
        }
    }
}

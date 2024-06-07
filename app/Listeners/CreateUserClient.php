<?php
namespace App\Listeners;

use App\Models\Client;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class CreateUserClient
{
    /**
     * Handle the event.
     *
     * @param  Registered  $event
     * @return void
     */
    public function handle(Registered $event)
    {
        $user = $event->user;

        // Check if the user object is null
        if (!$user) {
            Log::error('Null user object received in CreateUserClient listener.');
            return;
        }

        // Log to debug if the event is triggered
        Log::info('Registered event triggered for user: ' . $user->email);

        // Check if the registered user has the role of "client"
        if ($user->role === 'client') {
            try {
                // Generate a unique name for the client
                $name = $user->name;
                $count = Client::where('name', $name)->count();
                if ($count > 0) {
                    $name .= '_' . ($count + 1);
                }

                // Create the client record
                Client::create([
                    'name' => $name,
                    'email' => $user->email,
                    'address' => $user->address,
                    'phone_number' => $user->phone_number,
                    // Add any other fields you want to populate
                ]);

                // Log success message
                Log::info('Client created successfully for user: ' . $user->email);
            } catch (\Exception $e) {
                // Log any errors that occur during client creation
                Log::error('Error creating client for user: ' . $user->email . '. Error: ' . $e->getMessage());
            }
        }
    }
}

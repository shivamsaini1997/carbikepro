<?php

namespace App\Http\Controllers;

use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;

use function Laravel\Prompts\alert;

class WebsiteController extends Controller
{
    /**
     * Take the website down by enabling maintenance mode.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function takeWebsiteDown()
    {
        try {
            // Enable maintenance mode
            Artisan::call('down', [
                '--render' => 'errors::503', // Optional custom page
            ]);

            Log::info('Website has been taken down.');

            // return response()->json([
            //     'message' => 'Website is now in maintenance mode.',
            //     'status' => 'down',
            // ]);
        } catch (\Throwable $e) {
            Log::error('Error taking the website down: ' . $e->getMessage());

            return response()->json([
                'message' => 'Failed to take the website down.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


    public function bringWebsiteUp(Request $request){
        try {
            // Run the Artisan 'up' command to bring the application online
            Artisan::call('up');

            // Log the success of the command
            Log::info('Website is now live.');

            // Check if the "down" file still exists in storage
            $downFile = storage_path('framework/down');
            
            if (!File::exists($downFile)) {
                // Return success message if the website is live
                return response()->json([
                    'message' => 'Website is now live.',
                    'status' => 'up',
                ]);
            }

            // Handle case if "down" file is still present
            Log::error('Failed to bring the website online. Down file still exists.');
            return response()->json([
                'message' => 'Failed to bring the website online. Please check file permissions.',
                'status' => 'error',
            ], 500);
        } catch (\Throwable $e) {
            // Log any errors
            Log::error('Error bringing website online: ' . $e->getMessage());
            return response()->json([
                'message' => 'An error occurred while bringing the website online.',
                'error' => $e->getMessage(),
            ], 500);
        }
}

}

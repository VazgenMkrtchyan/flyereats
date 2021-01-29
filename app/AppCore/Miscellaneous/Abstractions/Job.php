<?php namespace App\AppCore\Miscellaneous\Abstractions;


//abstract class. jobs dispatcher included...
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\DispatchesJobs;

abstract class Job implements ShouldQueue
{
	use InteractsWithQueue, SerializesModels;
	use DispatchesJobs;
	/*
	|--------------------------------------------------------------------------
	| Queueable Jobs
	|--------------------------------------------------------------------------
	|
	| This job base class provides a central location to place any logic that
	| is shared across all of your jobs. The trait included with the class
	| provides access to the "onQueue" and "delay" queue helper methods.
	|
	*/

	use Queueable;
}
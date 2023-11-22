<?php

namespace Modules\Core\Listeners;

use Modules\Lang\Events\LanguageCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class AddColumnDatabase implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  LanguageCreated  $event
     * @return void
     */
    
    public function handle(LanguageCreated $event)
    {
        $code = $event->lang->code;
        Schema::table('tabs', function (Blueprint $table) use($code){
            $table->string('title_'.$code)->nullable()->after('title');
        });
    }
}

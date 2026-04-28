<?php
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

if (!function_exists('activity_log')) {
    function activity_log($action, $model, $modelId = null, $description = null)
    {
        ActivityLog::create([
            'user_id' =>  Auth::id(),
            'action' => $action,
            'model' => $model,
            'model_id' => $modelId,
            'description' => $description,
        ]);
    }
}
?>

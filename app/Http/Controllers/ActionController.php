<?php

namespace App\Http\Controllers;

use App\Models\Action;
use Illuminate\Http\Request;

class ActionController extends Controller
{
    public static function actionRegister($model, $actionType)
    {
        Action::create([
            'user_id' => (auth()->id() != null ? auth()->id() : 0),
            'request_id' => $model->id,
            'request_model' => $model->getTable(),
            'action_type' => $actionType,
        ]);
    }
}

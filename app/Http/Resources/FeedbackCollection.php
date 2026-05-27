<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class FeedbackCollection extends ResourceCollection
{
    public static $wrap = 'feedbacks';

    public function toArray(\Illuminate\Http\Request $request): array
    {
        return parent::toArray($request);
    }
}

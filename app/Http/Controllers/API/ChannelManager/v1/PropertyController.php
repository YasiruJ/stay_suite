<?php

namespace App\Http\Controllers\API\ChannelManager\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\API\v1\ApiResourceCollection;
use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function getAllProperty(Request $request)
    {
        $properties = Property::where('user_id', auth()->id())
            ->where('admin_active', true)
            ->where('property_active', true)
            ->get();

        return new ApiResourceCollection($properties);
    }
}

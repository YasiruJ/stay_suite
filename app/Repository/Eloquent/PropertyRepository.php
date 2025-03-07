<?php

namespace App\Repository\Eloquent;

use App\Models\Property;
use App\Repository\PropertyRepositoryInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;

class PropertyRepository extends BaseRepository implements PropertyRepositoryInterface
{
    /**
     * UserRepository constructor.
     *
     * @param  User  $model
     */
    public function __construct(Property $model)
    {
        parent::__construct($model);
    }

    /**
     * @return Collection
     */
    public function allPropeties()
    {
        return $this->model::with(['rooms', 'city', 'districts'])
            ->where('admin_active', 1)
            ->where('property_active', 1);
    }

    public function findProperty($id)
    {
        return $this->model::with(['rooms', 'city', 'districts'])
            ->where('admin_active', 1)
            ->where('property_active', 1)
            ->find($id);
    }

    public function getModel()
    {
        return $this->model;
    }

    public function createProperty(array $data)
    {
        if (! empty($data['input_img'])) {
            $file_ex = strtolower(File::extension($data['input_img']->getClientOriginalName()));
            //dd( $file_ex );
            if ($file_ex != 'png' && $file_ex != 'jpg' && $file_ex != 'jpeg' && $file_ex != 'gif' && $file_ex != 'pdf') {
                $res['success'] = false;
                $res['message'] = 'Invalid photo type!';

                return response($res);
            }

            $filename = uniqid() . '.' . $file_ex;
            $data['input_img']->storeAs('public/property_image', $filename);

            $main_image = $filename;
        } else {
            $main_image = null;
        }

        return $this->model->create([
            'user_id' => $data['user_id'],
            'property_type_id' => $data['property_type_id'],
            'city_id' => $data['city_id'],
            'district_id' => $data['district_id'],
            'name' => $data['property_name'],
            'address' => $data['address'],
            'latitude' => $data['longitude'],
            'longitude' => $data['latitude'],
            'place_id' => $data['place_id'],
            'description' => $data['description'],
            'main_image' => $main_image,
            'star_rating' => $data['property_rating_id'],
        ])->id;
    }

    public function chagePropertyStatus($property_id, $status)
    {
        $record = $this->find($property_id);
        //  dd( $status);
        return $record->update(['admin_active' => $status]);
    }
}

<?php

namespace App\Repository;

interface PropertyRepositoryInterface
{
    public function allPropeties();

    public function findProperty($id);

    public function getModel();

    public function chagePropertyStatus($property_id, $status);

    public function createProperty(array $data);
}

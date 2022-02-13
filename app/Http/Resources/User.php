<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $name
 * @property mixed $lastname
 * @property mixed $mothers_lastname
 * @property mixed $email
 * @property mixed $userProfile
 * @property mixed $id
 * @property mixed $deactivated_at
 * @property mixed $material
 * @method load(string $string)
 */
class User extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        $this->load(['userProfile', 'material']);
        return [
            'id' => $this->id,
            'name' => $this->name,
            'lastname' => $this->lastname,
            'mothers_lastname' => $this->mothers_lastname,
            'email' => $this->email,
            'birthday' => $this->userProfile->birthday,
            'age' => $this->userProfile->age,
            'address' => $this->userProfile->address,
            'state_id' => $this->userProfile->state_id,
            'user_id' => $this->userProfile->user_id,
            'phone' => $this->userProfile->phone,
            'enrollment' => $this->userProfile->enrollment,
            'birth_certificate' => $this->userProfile->birth_certificate,
            'school_certificate' => $this->userProfile->school_certificate,
            'curp_certificate' => $this->userProfile->curp_certificate,
            'municipality' => $this->userProfile->municipality,
            'birthplace' => $this->userProfile->birthplace,
            'emergency_phone' => $this->userProfile->emergency_phone,
            'facebook' => $this->userProfile->facebook,
            'curp' => $this->userProfile->curp,
            'material' => $this->material
        ];
    }

    /**
     * Get additional data that should be returned with the resource array.
     *
     * @param  Request  $request
     * @return array
     */
    public function with($request): array
    {
        return [
            'status' => 200,
            'message' => 'User loaded',
        ];
    }
}

<?php

namespace App\DTOs;

use Illuminate\Http\Request;

class UpdateProfileDTO
{
    public function __construct(
        public ?string $username,
        public string $first_name,
        public string $last_name,
        public string $email,
        public ?string $phone,
        public ?string $birth_date,
        public ?string $about,
        public ?string $address_line1,
        public ?string $address_line2,
        public ?string $city,
        public ?string $state,
        public ?string $country,
        public ?string $zipcode,
        public $avatar = null,
        public bool $remove_avatar = false
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            username: $request->validated('username'),
            first_name: $request->validated('first_name'),
            last_name: $request->validated('last_name'),
            email: $request->validated('email'),
            phone: $request->validated('phone'),
            birth_date: $request->validated('birth_date'),
            about: $request->validated('about'),
            address_line1: $request->validated('address_line1'),
            address_line2: $request->validated('address_line2'),
            city: $request->validated('city'),
            state: $request->validated('state'),
            country: $request->validated('country'),
            zipcode: $request->validated('zipcode'),
            avatar: $request->file('avatar'),
            remove_avatar: $request->boolean('remove_avatar')
        );
    }

    public function toArray(): array
    {
        return [
            'username' => $this->username,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'birth_date' => $this->birth_date,
            'about' => $this->about,
            'address_line1' => $this->address_line1,
            'address_line2' => $this->address_line2,
            'city' => $this->city,
            'state' => $this->state,
            'country' => $this->country,
            'zipcode' => $this->zipcode,
        ];
    }
}

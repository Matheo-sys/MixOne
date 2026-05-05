<?php

namespace App\DTOs;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class UpdateProfileDTO
{
    public function __construct(
        public readonly ?string $username,
        public readonly string $first_name,
        public readonly string $last_name,
        public readonly string $email,
        public readonly ?string $phone,
        public readonly ?string $birth_date,
        public readonly ?string $about,
        public readonly ?string $address_line1,
        public readonly ?string $address_line2,
        public readonly ?string $city,
        public readonly ?string $state,
        public readonly ?string $country,
        public readonly ?string $zipcode,
        public readonly ?UploadedFile $avatar = null,
        public readonly bool $remove_avatar = false,
        public readonly ?string $bank_name = null,
        public readonly ?string $iban = null,
        public readonly ?string $bic = null
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
            remove_avatar: $request->boolean('remove_avatar'),
            bank_name: $request->validated('bank_name'),
            iban: $request->validated('iban'),
            bic: $request->validated('bic')
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
            'bank_name' => $this->bank_name,
            'iban' => $this->iban,
            'bic' => $this->bic,
        ];
    }
}

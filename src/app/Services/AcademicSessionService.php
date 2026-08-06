<?php

namespace App\Services;

use App\Models\AcademicSession;

class AcademicSessionService
{
    public function create(array $data)
    {
        return AcademicSession::create($data);
    }

    public function update(AcademicSession $session, array $data)
    {
        $session->update($data);

        return $session;
    }
}

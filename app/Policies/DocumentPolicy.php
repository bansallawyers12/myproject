<?php

namespace App\Policies;

use App\Models\Document;
use App\Models\User;

class DocumentPolicy
{
    public function view(User $user, Document $document)
    {
        return $user->id === $document->user_id;
    }

    public function update(User $user, Document $document)
    {
        return $user->id === $document->user_id;
    }

    public function delete(User $user, Document $document)
    {
        return $user->id === $document->user_id;
    }
} 
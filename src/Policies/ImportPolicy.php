<?php

namespace Corals\Modules\Amazon\Policies;

use Corals\Foundation\Policies\BasePolicy;
use Corals\Modules\Amazon\Models\Import;
use Corals\User\Models\User;

class ImportPolicy extends BasePolicy
{
    /**
     * @param User $user
     * @return bool
     */
    public function view(User $user)
    {
        if ($user->can('Amazon::import.view')) {
            return true;
        }

        return false;
    }

    /**
     * @param User $user
     * @return bool
     */
    public function create(User $user)
    {
        return $user->can('Amazon::import.create');
    }

    /**
     * @param User $user
     * @param Import $import
     * @return bool
     */
    public function update(User $user, Import $import)
    {
        if ($user->can('Amazon::import.update')) {
            return true;
        }

        return false;
    }

    /**
     * @param User $user
     * @param Import $import
     * @return bool
     */
    public function destroy(User $user, Import $import)
    {
        if ($user->can('Amazon::import.delete')) {
            return true;
        }

        return false;
    }
}

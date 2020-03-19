<?php


namespace App\Services\Course\Services;

use App\Services\Course\Interfaces\CourseTagServiceInterface;
use App\Services\Course\Models\CourseTag;

class CourseTagService implements CourseTagServiceInterface
{

    /**
     * @return array
     */
    public function all(): array
    {
        return CourseTag::show()->get()->toArray();
    }

    /**
     * @param int $id
     * @return array
     */
    public function findOrFail(int $id): array
    {
        return CourseTag::findOrFail($id)->toArray();
    }
}

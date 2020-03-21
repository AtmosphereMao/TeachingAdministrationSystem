<?php

namespace App\Services\Course\Services;

use App\Services\Course\Interfaces\CourseVisitorServiceInterface;
use App\Services\Course\Models\CourseVisitor;
use Weboap\Visitor\Visitor as WeVisitor;
use Carbon\Carbon as c;

class CourseVisitorService extends WeVisitor implements CourseVisitorServiceInterface
{
    public function log($courseId = NULL)
    {
        $ip = $this->ip->get();

        if (!$this->ip->isValid($ip)) {
            return;
        }

        if ($this->has($ip) && $this->hasCourse($courseId, $ip)) {
            $visitor = CourseVisitor::query()->where('ip', $ip)
                ->where('course_id', $courseId)
                ->whereDate('updated_at', '!=', c::today())
                ->first();
            if ($visitor) {
                $visitor->update(['clicks'=>$visitor->clicks + 1]);
            }
            return;
        } else {
            $geo = $this->geo->locate($ip);

            $country = array_key_exists('country_code', $geo) ? $geo['country_code'] : null;
            $city = array_key_exists('city', $geo) ? $geo['city'] : null;

            // ip doesnt exist in db
            $data = [
                'ip'         => $ip,
                'country'    => $country,
                'city' => $city,
                'clicks'     => 1,
                'course_id' => $courseId,
                'updated_at' => c::now(),
                'created_at' => c::now(),
            ];
            $this->storage->create($data);
        }

        // Clear the database cache
        $this->cache->destroy('weboap.visitor');
    }

    public function hasCourse($id, $ip) {
        return count(CourseVisitor::query()->where('course_id', $id)->where('ip', $ip)->get()) > 0;
    }
}
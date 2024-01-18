<?php

namespace App\Livewire\Admin\Kbm;

use App\Jobs\SendMeetingRescheduleInfo;
use App\Models\Course;
use App\Models\CourseBase;
use App\Models\Student;
use App\Models\Tutor;
use Illuminate\Support\Carbon;
use Livewire\Component;

class Reschedule extends Component
{
    public $course, $dateOfEvent, $currentDateOfEvent, $dateFormat, $student, $package, $courseBase, $tutor, $topic, $selectedCourse, $lesson, $reference, $endTime, $length = 60, $availability = 'waiting';

    public function mount($id)
    {
        $this->course = Course::with('theTutor', 'theStudent', 'theCourse')
            ->where('id', $id)
            ->firstOrFail();
        $this->student = $this->course->student_id;
        $this->tutor = $this->course->tutor_id;
        $this->selectedCourse = $this->course->course_id;
        $this->currentDateOfEvent = $this->course->date_of_event;

        // dd($this);
    }

    public function updatedDateOfEvent()
    {
        // dd($this->dateOfEvent);
        $this->availability = 'waiting';
        $this->dateFormat = Carbon::createFromFormat('Y-m-d H:i', $this->dateOfEvent);
        $this->endTime = Carbon::createFromFormat('Y-m-d H:i', $this->dateOfEvent)->addMinutes($this->length);
        // dd($this->dateFormat);
    }

    public function checkAvailability()
    {
        $this->validate([
            'dateOfEvent' => 'required',
        ], [
            'dateOfEvent.required' => 'Tanggal tidak boleh kosong',
        ]);

        // $this->dateFormat = Carbon::createFromFormat('Y-m-d H:i', $this->dateOfEvent)->subHour();

        $check = Course::where('student_id', Student::where('nim', $this->student)->select('id'))
            ->where('tutor_id', Tutor::whereHas('userData', function ($q) {
                $q->where('slug', $this->tutor);
            })->select('id'))
            ->selectRaw('*, (date_of_event + INTERVAL `length` MINUTE) AS c')
            ->havingRaw('`c` between "' . $this->dateFormat . '" AND "' . $this->endTime . '" OR `date_of_event` between "' . $this->dateFormat . '" AND "' . $this->endTime . '"')
            // ->toRawSql();
            ->get();

        if ($check->isEmpty()) {
            $this->availability = 'available';
        } else {
            $this->availability = 'not available';
        }
    }

    public function scheduleClass()
    {
        // dd($this);
        $classDateOld = $this->course->date_of_event;
        $this->course->update([
            'date_of_event' => $this->dateFormat,
            'length' => $this->length,
        ]);
        
        $message = 'Perubahan jadwal kelas berhasil. ';
        if ($this->course->theStudent->userData->email !== null) {
            $student = [
                'className' => $this->course->theCourse->name,
                'classID' => $this->course->id,
                'classDate' => $classDateOld->format('d/m/Y H:i T'),
                'classDateNew' => $this->course->date_of_event->format('d/m/Y H:i T'),
                'tutorName' => $this->course->theTutor->userData->name,
                'studentName' => $this->course->theStudent->userData->name,
                'studentNIM' => $this->course->theStudent->nim,
                'email' => $this->course->theStudent->userData->email,
                'role' => 'MURID',
                'meetingLink' => $this->course->meeting_link,
            ];
            SendMeetingRescheduleInfo::dispatch($student);
            $message .= 'Notifikasi murid via email dibuat. ';
        }

        if ($this->course->theStudent->has_guardian == 1) {
            if ($this->course->theStudent->theGuardian->userData->email !== null) {
                $guardian = [
                    'className' => $this->course->theCourse->name,
                    'classID' => $this->course->id,
                    'classDate' => $classDateOld->format('d/m/Y H:i T'),
                    'classDateNew' => $this->course->date_of_event->format('d/m/Y H:i T'),
                    'tutorName' => $this->course->theTutor->userData->name,
                    'studentName' => $this->course->theStudent->userData->name,
                    'guardianName' => $this->course->theStudent->theGuardian->userData->name,
                    'studentNIM' => $this->course->theStudent->nim,
                    'email' => $this->course->theStudent->theGuardian->userData->email,
                    'role' => 'WALI MURID',
                    'meetingLink' => $this->course->meeting_link,
                ];
                SendMeetingRescheduleInfo::dispatch($guardian);
                $message .= 'Notifikasi wali murid via email dibuat. ';
            }
        }

        if ($this->course->theTutor->userData->email !== null) {
            $tutor = [
                'className' => $this->course->theCourse->name,
                'classID' => $this->course->id,
                'classDate' => $classDateOld->format('d/m/Y H:i T'),
                'classDateNew' => $this->course->date_of_event->format('d/m/Y H:i T'),
                'tutorName' => $this->course->theTutor->userData->name,
                'studentName' => $this->course->theStudent->userData->name,
                'studentNIM' => $this->course->theStudent->nim,
                'email' => $this->course->theTutor->userData->email,
                'role' => 'TUTOR',
                'meetingLink' => $this->course->meeting_link,
            ];
            SendMeetingRescheduleInfo::dispatch($tutor);
            $message .= 'Notifikasi tutor via email dibuat. ';
        }

        session()->flash('success', $message);
        return $this->redirect(route('kbm.show', ['id' => $this->course->id]), navigate: false);
    }

    public function render()
    {
        return view('livewire.admin.kbm.reschedule', []);
    }
}

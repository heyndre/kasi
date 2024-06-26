<?php

namespace App\Livewire\Admin\Kbm;

use App\Jobs\SendMeetingInfo;
use App\Models\Course;
use App\Models\CourseBase;
use App\Models\CoursePivot;
use App\Models\Setting;
use App\Models\Student;
use App\Models\Tutor;
use Illuminate\Support\Carbon;
use Livewire\Component;

class Create extends Component
{
    public $dateOfEvent, $dateFormat, $isFreeTrial = 0, $pastStudentClasses, $student, $link, $linkType = 'meetTutor', $package, $courseBase, $tutor, $topic, $selectedCourse = 4, $lesson, $reference, $endTime, $length = 60, $availability = 'waiting';

    public function mount()
    {
        $this->link = Setting::where('key', 'default_link')->first()->value;
    }

    public function updatedTutor()
    {
        $this->availability = 'waiting';

        $this->courseBase = Tutor::whereHas('userData', function ($q) {
            $q->where('slug', $this->tutor);
        })
            ->with('theSkill')
            ->first();

        // dd($this->courseBase);
    }

    public function updatedStudent()
    {
        $this->availability = 'waiting';
    }

    public function updatedDateOfEvent()
    {
        // dd($this->dateOfEvent);
        $this->availability = 'waiting';
        $this->dateFormat = Carbon::createFromFormat('Y-m-d H:i', $this->dateOfEvent);
        $this->endTime = Carbon::createFromFormat('Y-m-d H:i', $this->dateOfEvent)->addMinutes($this->length);
        // dd($this->dateFormat);
    }

    public function updatedLength()
    {
        // dd($this->dateOfEvent);
        $this->availability = 'waiting';
        $this->endTime = Carbon::createFromFormat('Y-m-d H:i', $this->dateOfEvent)->addMinutes($this->length);
    }

    public function checkAvailability()
    {
        $this->validate([
            'dateOfEvent' => 'required',
            'student' => 'required',
            'tutor' => 'required',
        ], [
            'dateOfEvent.required' => 'Tanggal tidak boleh kosong',
            'tutor.required' => 'Tutor tidak boleh kosong',
            'student.required' => 'Murid tidak boleh kosong',
        ]);

        // $this->dateFormat = Carbon::createFromFormat('Y-m-d H:i', $this->dateOfEvent)->subHour();

        $check = Course::where('student_id', Student::where('nim', $this->student)->select('id'))
            ->where('tutor_id', Tutor::whereHas('userData', function ($q) {
                $q->where('slug', $this->tutor);
            })->select('id'))
            // ->selectRaw('select')
            // ->whereBetween('date_of_event', [$this->dateFormat, $this->endTime])
            // ->whereRaw('date_of_event + interval length minutes >= ?', [$today])
            ->selectRaw('*, (date_of_event + INTERVAL `length` MINUTE) AS c')
            ->havingRaw('`c` between "' . $this->dateFormat . '" AND "' . $this->endTime . '" OR `date_of_event` between "' . $this->dateFormat . '" AND "' . $this->endTime . '"')
            // ->orWhereBetween('class_end_time', [$this->dateFormat, $this->endTime])
            // ->toRawSql();
            ->get();

        // dd($this);
        // dd($check);

        if ($check->isEmpty()) {
            $this->availability = 'available';
            // session()->flash('success', 'Jadwal tersedia, silakan isi data kelas');
            // dd($this);
        } else {
            $this->availability = 'not available';
            // session()->flash('warning', 'Jadwal tidak tersedia, cari jadwal lain');
        }

        $this->pastStudentClasses = Course::with('theCourse')
            ->where('student_id', Student::where('nim', $this->student)->select('id'))
            ->where('tutor_id', Tutor::whereHas('userData', function ($q) {
                $q->where('slug', $this->tutor);
            })->select('id'))
            ->orderBy('created_at', 'DESC')
            ->take(6)
            // ->toRawSql();
            ->get();
        // dd($this->pastStudentClasses);
    }

    public function scheduleClass()
    {
        dd($this);

        $base = CourseBase::where('id', $this->selectedCourse)->first();

        $session = Course::create([
            'date_of_event' => $this->dateFormat,
            'length' => $this->length,
            'tutor_id' => Tutor::whereHas('userData', function ($q) {
                $q->where('slug', $this->tutor);
            })
                ->first()
                ->id,
            'student_id' => Student::where('nim', $this->student)
                ->first()
                ->id,
            'status' => 'WAITING',
            'course_id' => $this->selectedCourse,
            'additional_links' => json_encode([]),
            'files' => json_encode([]),
            'meeting_link' => $this->link,
            'price' => $base->price,
            'price_idr' => $base->price_idr,
            'tutor_percentage' => $base->tutor_percentage,

        ]);

        if ($this->isFreeTrial == true) {
            $session->update([
                'free_trial' => 1,
                'length' => 30,
            ]);
        }

        // dd($session->theStudent->has_guardian);

        $message = 'Penjadwalan kelas berhasil. ';
        if ($session->theStudent->userData->email !== null) {
            $student = [
                'className' => $session->theCourse->name,
                'classID' => $session->id,
                'classDate' => $session->date_of_event->format('d/m/Y H:i T'),
                'tutorName' => $session->theTutor->userData->name,
                'studentName' => $session->theStudent->userData->name,
                'guardianName' => '',
                'studentNIM' => $session->theStudent->nim,
                'email' => $session->theStudent->userData->email,
                'role' => 'MURID',
                'meetingLink' => $session->meeting_link,
            ];
            // dd($student);
            SendMeetingInfo::dispatch($student);
            $message .= 'Notifikasi murid via email dibuat. ';
        }

        if ($session->theStudent->has_guardian == 1) {
            if ($session->theStudent->theGuardian->userData->email !== null) {
                $guardian = [
                    'className' => $session->theCourse->name,
                    'classID' => $session->id,
                    'classDate' => $session->date_of_event->format('d/m/Y H:i T'),
                    'tutorName' => $session->theTutor->userData->name,
                    'studentName' => $session->theStudent->userData->name,
                    'guardianName' => $session->theStudent->theGuardian->userData->name,
                    'studentNIM' => $session->theStudent->nim,
                    'email' => $session->theStudent->theGuardian->userData->email,
                    'role' => 'WALI MURID',
                    'meetingLink' => $session->meeting_link,
                ];
                SendMeetingInfo::dispatch($guardian);
                $message .= 'Notifikasi wali murid via email dibuat. ';
            }
        }

        if ($session->theTutor->userData->email !== null) {
            $tutor = [
                'className' => $session->theCourse->name,
                'classID' => $session->id,
                'classDate' => $session->date_of_event->format('d/m/Y H:i T'),
                'tutorName' => $session->theTutor->userData->name,
                'studentName' => $session->theStudent->userData->name,
                'guardianName' => '',
                'studentNIM' => $session->theStudent->nim,
                'email' => $session->theTutor->userData->email,
                'role' => 'TUTOR',
                'meetingLink' => $session->meeting_link,
            ];
            SendMeetingInfo::dispatch($tutor);
            $message .= 'Notifikasi tutor via email dibuat. ';
        }

        session()->flash('success', $message);
        // dd($session);

        return $this->redirect(route('kbm.index'), navigate: true);
    }

    public function updatedLinkType()
    {
        if ($this->linkType == 'meetTutor') {
            $data = Tutor::whereHas('userData', function ($q) {
                $q->where('slug', $this->tutor);
            })->first();
            if ($data !== null) {
                $this->link = $data->meeting_link;
            }
        } elseif ($this->linkType == 'meetMain') {
            $this->link = Setting::where('key', 'gmeet_link')->first()->value;
        } else {
            $this->link = Setting::where('key', 'default_link')->first()->value;
        }
    }

    public function render()
    {
        if ($this->linkType == 'meetTutor') {
            $data = Tutor::whereHas('userData', function ($q) {
                $q->where('slug', $this->tutor);
            })->first();
            if ($data !== null) {
                $this->link = $data->meeting_link;
            }
        } elseif ($this->linkType == 'meetMain') {
            $this->link = Setting::where('key', 'gmeet_link')->first()->value;
        } else {
            $this->link = Setting::where('key', 'default_link')->first()->value;
        }

        $students = Student::whereHas('userData', function ($q) {
            $q->whereIn('exist_status', ['Aktif', 'Reaktivasi']);
        })->get();

        $tutors = Tutor::whereHas('userData', function ($q) {
            $q->whereIn('exist_status', ['Aktif', 'Reaktivasi']);
        })->get();

        // dd($tutors);
        return view('livewire.admin.kbm.create', [
            'students' => $students,
            'tutors' => $tutors,
        ]);
    }
}

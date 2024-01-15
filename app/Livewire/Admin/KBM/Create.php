<?php

namespace App\Livewire\Admin\Kbm;

use App\Models\Course;
use App\Models\CourseBase;
use App\Models\Setting;
use App\Models\Student;
use App\Models\Tutor;
use Illuminate\Support\Carbon;
use Livewire\Component;

class Create extends Component
{
    public $dateOfEvent, $dateFormat, $student, $link, $package, $courseBase, $tutor, $topic, $selectedCourse, $lesson, $reference, $endTime, $length = 60, $availability = 'waiting';

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
    }

    public function scheduleClass()
    {
        // dd($this);

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
            'meeting_link' => $this->link,
            'price' => CourseBase::where('id', $this->selectedCourse)->first()->price
        ]);

        // dd($session);

        session()->flash('success', 'Penjadwalan kelas berhasil.');
        return $this->redirect(route('kbm.index'), navigate: true);
    }

    public function render()
    {
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

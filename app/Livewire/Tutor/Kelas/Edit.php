<?php

namespace App\Livewire\Tutor\Kelas;

use App\Models\Course;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Spatie\Image\Enums\Fit;
use Spatie\Image\Image as Image;

class Edit extends Component
{
    use WithFileUploads;
    public $data, $topic, $lesson, $reference, $links, $files = [], $photo, $recording, $noteStudent, $noteAdmin, $currentPhoto;

    public function updateClass() {
        // dd($this);

        $this->data->update([
            'topic' => $this->topic,
            'lesson_matter' => $this->lesson,
            'recording' => $this->recording,
            // 'additional_links' => json_encode($this->reference),
        ]);
        if ($this->reference != $this->links) {
            // dd($this->reference == $this->links);
            // dd($this);
            $this->data->update([
            'additional_links' => json_encode($this->reference),
            ]);
        }
        
        // dd($this->photo);
        if ($this->photo !== null) {
            if ($this->data->photo != null || $this->data->photo != '') {
                if (File::exists(storage_path('app/classes/photo/') . $this->data->photo)) {
                    // dd('yes');
                    File::delete(storage_path('app/classes/photo/') . $this->data->photo);
                }
            }
            Image::load($this->photo->getRealPath())->fit(Fit::Max, 1280, 720)->optimize()->save();
            $filename = $this->photo->storeAs('', 'Meeting-'.str_pad($this->data->id, 5, '0', STR_PAD_LEFT),'class-photo');
            $this->data->update([
                'photo' => $filename,
            ]);
        }

        session()->flash('success', 'Pembaruan detail kelas berhasil');
        return $this->redirect(route('tutor.classes.show', ['id' => $this->data->id]), navigate: false);
    }

    public function mount($id) {
        $this->data = Course::where('id', $id)->firstOrFail();
        $this->topic = $this->data->topic;
        $this->lesson = $this->data->lesson_matter;
        $this->reference = $this->data->additional_links;
        $this->links = $this->data->additional_links;
        $this->currentPhoto = $this->data->photo;
        $this->noteStudent = $this->data->tutor_notes;
        $this->noteAdmin = $this->data->tutor_notes_to_admin;
        $this->recording =  $this->data->recording_youtube == null ? $this->data->recording : $this->data->recording_youtube;
        
    }
    public function render()
    {
        return view('livewire.tutor.kelas.edit');
    }
}
